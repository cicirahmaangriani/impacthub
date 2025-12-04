<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventService
{
    /**
     * Create Event
     */
    public function createEvent(array $data)
    {
        DB::beginTransaction();

        try {
            $data['slug'] = Str::slug($data['title']) . '-' . Str::random(6);

            if ($data['price'] > 0) {
                $data['platform_fee'] = $data['price'] * 0.10;
            }

            $event = Event::create($data);

            if (isset($data['schedules']) && is_array($data['schedules'])) {
                foreach ($data['schedules'] as $schedule) {
                    $event->schedules()->create($schedule);
                }
            }

            DB::commit();
            return $event->load(['schedules', 'category', 'eventType']);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update Event
     */
    public function updateEvent(Event $event, array $data)
    {
        DB::beginTransaction();

        try {
            if (isset($data['title']) && $data['title'] !== $event->title) {
                $data['slug'] = Str::slug($data['title']) . '-' . Str::random(6);
            }

            $event->update($data);

            if (isset($data['schedules']) && is_array($data['schedules'])) {
                $event->schedules()->delete();
                foreach ($data['schedules'] as $schedule) {
                    $event->schedules()->create($schedule);
                }
            }

            DB::commit();
            return $event->fresh(['schedules', 'category', 'eventType']);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete Event
     */
    public function deleteEvent(Event $event)
    {
        if ($event->registrations()->exists()) {
            throw new \Exception('Cannot delete event with existing registrations');
        }

        return $event->delete();
    }

    /**
     * Publish Event
     */
    public function publishEvent(Event $event)
    {
        if ($event->status !== 'draft') {
            throw new \Exception('Only draft events can be published');
        }

        if (!$event->title || !$event->description || !$event->start_date) {
            throw new \Exception('Event missing required information');
        }

        $event->update(['status' => 'published']);

        return $event;
    }

    /**
     * Cancel Event
     */
    public function cancelEvent(Event $event, string $reason = null)
    {
        DB::beginTransaction();

        try {
            $event->update([
                'status' => 'cancelled',
                'cancellation_reason' => $reason,
            ]);

            $event->registrations()
                ->where('status', 'pending')
                ->update([
                    'status' => 'cancelled',
                    'cancellation_reason' => 'Event cancelled by organizer',
                    'cancelled_at' => now(),
                ]);

            DB::commit();
            return $event;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Get Published Events (Optimized)
     */
    public function getPublishedEvents(array $filters = [])
    {
        $query = Event::query()
            ->published()
            ->with([
                'user:id,name',
                'category:id,name,icon',
                'eventType:id,name'
            ])
            ->select([
                'id', 'title', 'slug', 'start_date', 'end_date',
                'price', 'venue_type', 'category_id', 'event_type_id',
                'user_id', 'is_featured', 'created_at'
            ]);

        // Filter category
        $query->when($filters['category_id'] ?? null, fn ($q, $v) =>
            $q->where('category_id', $v)
        );

        // Filter type
        $query->when($filters['event_type_id'] ?? null, fn ($q, $v) =>
            $q->where('event_type_id', $v)
        );

        // Price range
        $query->when($filters['price_min'] ?? null, fn ($q, $v) =>
            $q->where('price', '>=', $v)
        );

        $query->when($filters['price_max'] ?? null, fn ($q, $v) =>
            $q->where('price', '<=', $v)
        );

        // Venue type
        $query->when($filters['venue_type'] ?? null, fn ($q, $v) =>
            $q->where('venue_type', $v)
        );

        // Search
        $query->when($filters['search'] ?? null, fn ($q, $v) =>
            $q->where('title', 'like', "%{$v}%")
        );

        // Featured only
        $query->when($filters['featured'] ?? null, fn ($q) =>
            $q->where('is_featured', true)
        );

        // Upcoming / Ongoing
        $query->when($filters['status'] ?? null, function ($q, $v) {
            if ($v === 'upcoming') $q->upcoming();
            if ($v === 'ongoing') $q->ongoing();
        });

        /** Allowed sorting columns */
        $allowedSort = [
            'start_date', 'end_date', 'title',
            'price', 'created_at'
        ];

        $sortBy = $filters['sort_by'] ?? 'start_date';
        $sortOrder = $filters['sort_order'] ?? 'asc';

        // Validate sort column
        if (!in_array($sortBy, $allowedSort)) {
            $sortBy = 'start_date';
        }

        $query->orderBy($sortBy, $sortOrder);

        /** Pagination */
        return $query->paginate($filters['per_page'] ?? 12);
    }
}

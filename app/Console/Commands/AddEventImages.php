<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class AddEventImages extends Command
{
    protected $signature = 'events:add-images';
    protected $description = 'Add placeholder images to events';

    public function handle()
    {
        $events = Event::whereNull('image')->orWhere('image', '')->get();
        
        if ($events->isEmpty()) {
            $this->info('All events already have images.');
            return;
        }

        $this->info("Found {$events->count()} events without images.");
        
        $imageMap = [
            'bootcamp' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800&h=600&fit=crop',
            'workshop' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=600&fit=crop',
            'webinar' => 'https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04?w=800&h=600&fit=crop',
            'course' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800&h=600&fit=crop',
            'default' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&h=600&fit=crop'
        ];

        foreach ($events as $event) {
            try {
                $eventTypeSlug = $event->eventType->slug ?? 'default';
                $imageUrl = $imageMap[$eventTypeSlug] ?? $imageMap['default'];
                
                $this->info("Downloading image for: {$event->title}");
                
                // Download image
                $response = Http::timeout(30)->get($imageUrl);
                
                if ($response->successful()) {
                    $filename = 'events/' . uniqid() . '_' . $event->id . '.jpg';
                    Storage::disk('public')->put($filename, $response->body());
                    
                    $event->update(['image' => $filename]);
                    $this->info("✓ Image added to: {$event->title}");
                } else {
                    $this->error("Failed to download image for: {$event->title}");
                }
                
            } catch (\Exception $e) {
                $this->error("Error processing {$event->title}: " . $e->getMessage());
            }
        }

        $this->info('Done!');
    }
}

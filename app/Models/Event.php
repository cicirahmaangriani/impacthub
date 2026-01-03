<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'event_type_id',
        'title',
        'slug',
        'description',
        'objectives',
        'requirements',
        'price',
        'quota',
        'registered_count',
        'location',
        'venue_type',
        'image',
        'gallery',
        'status', // draft | published
        'start_date',
        'end_date',
        'registration_deadline',
        'instructor_info',
        'is_featured',
        'certificate_available',
        'points_reward',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quota' => 'integer',
        'registered_count' => 'integer',

        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_deadline' => 'datetime',

        'is_featured' => 'boolean',
        'certificate_available' => 'boolean',

        // kalau gallery JSON (dan bisa null), amanin jadi array kosong
        'gallery' => 'array',
    ];

    /**
     * Kalau kamu sering pakai route model binding by slug di public routes:
     * Route::get('/events/{event:slug}', ...)
     * Ini bikin default binding pakai slug kalau route pakai {event}
     * (opsional, tapi recommended untuk konsisten)
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Organizer / pembuat event
     */
    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Alias biar kode lama $event->user masih jalan
     */
    public function user(): BelongsTo
    {
        return $this->organizer();
    }

    /**
     * Category relasi (sesuaikan model Category kamu)
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Event Type relasi (sesuaikan model EventType kamu)
     */
    public function eventType(): BelongsTo
    {
        return $this->belongsTo(EventType::class, 'event_type_id');
    }

    /**
     * Registrations / pendaftar
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class, 'event_id');
    }

    /**
     * Scope: published events
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}

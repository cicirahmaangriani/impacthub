<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'event_type_id',
        'title',
        'slug',
        'description',
        'requirements',
        'location',
        'meeting_link',
        'venue_type',
        'price',
        'quota',
        'registered_count',
        'start_date',
        'end_date',
        'registration_deadline',
        'certificate_available',
        'instructor_info',
        'points_reward', 
        'objectives',
        'image',
        'gallery',
        'status',
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
     * Event Schedules
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(EventSchedule::class);
    }

    /**
     * Event Materials
     */
    public function materials(): HasMany
    {
        return $this->hasMany(EventMaterial::class);
    }

    /**
     * Certificates issued for this event
     */
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    /**
     * Scope: published events
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now());
    }

    public function scopeOngoing($query)
    {
        return $query->where('start_date', '<=', now())
                    ->where('end_date', '>=', now());
    }

    public function scopeAvailableForRegistration($query)
    {
        return $query->where('status', 'published')
                    ->where('registration_deadline', '>', now())
                    ->whereColumn('registered_count', '<', 'quota');
    }

    // Accessors & Helpers
    public function getAvailableSlotsAttribute()
    {
        return $this->quota - $this->registered_count;
    }

    public function isFullyBooked()
    {
        return $this->registered_count >= $this->quota;
    }

    public function canRegister()
    {
        return $this->status === 'published' 
            && !$this->isFullyBooked()
            && now()->lt($this->registration_deadline);
    }

    public function isFree()
    {
        return $this->price == 0;
    }
}

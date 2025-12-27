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
        'status', // draft | published (atau sesuai sistem kamu)
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

        // kalau kolom gallery kamu JSON, ini bikin langsung jadi array
        'gallery' => 'array',
    ];

    /**
     * Organizer / pembuat event
     */
    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Alias (biar kalau di kode lama masih pakai $event->user tidak error)
     * Ini opsional, tapi aman kalau kamu sudah terlanjur pakai user() di banyak tempat.
     */
    public function user(): BelongsTo
    {
        return $this->organizer();
    }

    /**
     * Registrations / pendaftar event
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class, 'event_id');
    }

    /**
     * Scope: event yang published
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}

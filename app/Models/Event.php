<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    'start_date',
    'end_date',
    'registration_deadline',
    'certificate_available',
    'instructor_info',
    'image',
    'status',
];


    protected $casts = [
        'price' => 'decimal:2',
        'gallery' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_deadline' => 'datetime',
        'is_featured' => 'boolean',
        'certificate_available' => 'boolean',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function schedules()
    {
        return $this->hasMany(EventSchedule::class);
    }

    public function materials()
    {
        return $this->hasMany(EventMaterial::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    // Scopes
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

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
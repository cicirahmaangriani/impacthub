<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'bio',
        'avatar',
        'is_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_verified' => 'boolean',
        ];
    }

    // Relationships
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function points()
    {
        return $this->hasMany(UserPoint::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Scopes
    public function scopeOrganizers($query)
    {
        return $query->where('role', 'organizer');
    }

    public function scopeParticipants($query)
    {
        return $query->where('role', 'participant');
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    // ✅ OPTIMIZED: Calculate total points with single query
    public function getTotalPointsAttribute()
    {
        // Cache in memory untuk request yang sama
        if (!isset($this->attributes['cached_total_points'])) {
            $points = $this->points()
                ->selectRaw('
                    SUM(CASE WHEN type = "earned" THEN points ELSE 0 END) as earned,
                    SUM(CASE WHEN type = "redeemed" THEN points ELSE 0 END) as redeemed
                ')
                ->first();

            $this->attributes['cached_total_points'] = 
                ($points->earned ?? 0) - ($points->redeemed ?? 0);
        }

        return $this->attributes['cached_total_points'];
    }

    // ✅ NEW: Method untuk calculate points tanpa accessor
    public function calculateTotalPoints(): int
    {
        $points = $this->points()
            ->selectRaw('
                SUM(CASE WHEN type = "earned" THEN points ELSE 0 END) as earned,
                SUM(CASE WHEN type = "redeemed" THEN points ELSE 0 END) as redeemed
            ')
            ->first();

        return ($points->earned ?? 0) - ($points->redeemed ?? 0);
    }

    // Role Checks - Simple & Fast
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isOrganizer(): bool
    {
        return $this->role === 'organizer';
    }

    public function isParticipant(): bool
    {
        return $this->role === 'participant';
    }

    // ✅ Helper: Check if user can manage events
    public function canManageEvents(): bool
    {
        return in_array($this->role, ['admin', 'organizer']);
    }

    // ✅ Helper: Get avatar URL with fallback
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        
        // Fallback to UI Avatars
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&size=200&background=4F46E5&color=ffffff';
    }
}
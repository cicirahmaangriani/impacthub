<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Cache total points for current request lifecycle.
     */
    protected ?int $cachedTotalPoints = null;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',        // admin | organizer | participant
        'phone',
        'bio',
        'avatar',
        'is_verified',
        'is_active',   // disarankan untuk fitur enable/disable akun admin
        'email_verified_at',
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
            'is_active' => 'boolean',
        ];
    }

    /* =========================
     | Relationships
     ========================= */

    /**
     * Events yang dibuat user (organizer).
     * Tabel events kamu menggunakan kolom user_id.
     */
    public function events()
    {
        return $this->hasMany(Event::class, 'user_id');
    }

    /**
     * Registrasi event oleh user (participant).
     * Tabel registrations kamu menggunakan kolom user_id.
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class, 'user_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'user_id');
    }

    public function points()
    {
        return $this->hasMany(UserPoint::class, 'user_id');
    }

    /**
     * IMPORTANT:
     * Jangan buat method notifications() sendiri,
     * karena Notifiable trait sudah menyediakan notifications() untuk database notifications bawaan Laravel.
     *
     * Kalau kamu punya tabel notifications custom buatan sendiri, gunakan nama berbeda:
     */
    public function customNotifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    /* =========================
     | Scopes
     ========================= */

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

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /* =========================
     | Points (optimized)
     ========================= */

    /**
     * Accessor: $user->total_points
     */
    protected function totalPoints(): Attribute
    {
        return Attribute::get(function () {
            if ($this->cachedTotalPoints !== null) {
                return $this->cachedTotalPoints;
            }

            $points = $this->points()
                ->selectRaw('
                    COALESCE(SUM(CASE WHEN type = "earned" THEN points ELSE 0 END),0) as earned,
                    COALESCE(SUM(CASE WHEN type = "redeemed" THEN points ELSE 0 END),0) as redeemed
                ')
                ->first();

            $this->cachedTotalPoints = (int)(($points->earned ?? 0) - ($points->redeemed ?? 0));
            return $this->cachedTotalPoints;
        });
    }

    public function calculateTotalPoints(): int
    {
        $points = $this->points()
            ->selectRaw('
                COALESCE(SUM(CASE WHEN type = "earned" THEN points ELSE 0 END),0) as earned,
                COALESCE(SUM(CASE WHEN type = "redeemed" THEN points ELSE 0 END),0) as redeemed
            ')
            ->first();

        return (int)(($points->earned ?? 0) - ($points->redeemed ?? 0));
    }

    /* =========================
     | Role checks
     ========================= */

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

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

    public function canManageEvents(): bool
    {
        return in_array($this->role, ['admin', 'organizer'], true);
    }

    /* =========================
     | Avatar URL
     ========================= */

    protected function avatarUrl(): Attribute
    {
        return Attribute::get(function () {
            if ($this->avatar) {
                return asset('storage/' . $this->avatar);
            }

            return 'https://ui-avatars.com/api/?name='
                . urlencode($this->name)
                . '&size=200&background=4F46E5&color=ffffff';
        });
    }
}

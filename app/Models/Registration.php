<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'registration_code',
        'status', // pending | confirmed | cancelled (atau sesuai sistem kamu)
        'notes',
        'cancellation_reason',
        'cancelled_at',
    ];

    protected $casts = [
        'cancelled_at' => 'datetime',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class, 'registration_id');
    }

    public function certificate(): HasOne
    {
        return $this->hasOne(Certificate::class, 'registration_id');
    }

    // Generate unique registration code
    public static function generateRegistrationCode(): string
    {
        do {
            $code = 'REG-' . strtoupper(Str::random(8));
        } while (self::where('registration_code', $code)->exists());

        return $code;
    }

    // Scopes (opsional tapi berguna)
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }
}

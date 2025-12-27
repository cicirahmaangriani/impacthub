<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'user_id',
        'transaction_code',
        'amount',
        'platform_fee',
        'organizer_amount',
        'payment_method',
        'status', // pending | paid | failed | expired (sesuai sistem kamu)
        'payment_proof',
        'paid_at',
        'expired_at',
        'payment_response',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'organizer_amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'expired_at' => 'datetime',
        'payment_response' => 'array',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class, 'registration_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * ✅ Scope yang dipakai di blade: Transaction::paid()->count()
     * dan dipakai di DashboardController: Transaction::paid()->sum('amount')
     */
    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'expired');
    }

    // Helpers
    public static function generateTransactionCode(): string
    {
        return 'TRX-' . strtoupper(uniqid());
    }

    public static function calculatePlatformFee(float $amount): float
    {
        return round($amount * 0.10, 2); // 10%
    }
}

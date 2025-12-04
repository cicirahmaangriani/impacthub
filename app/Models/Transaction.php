<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'status',
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

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Helpers
    public static function generateTransactionCode()
    {
        return 'TRX-' . strtoupper(uniqid());
    }

    public static function calculatePlatformFee($amount)
    {
        return $amount * 0.10; // 10% commission
    }
}

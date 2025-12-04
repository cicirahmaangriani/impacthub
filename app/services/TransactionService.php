<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function processPayment(Transaction $transaction, array $paymentData)
    {
        DB::beginTransaction();
        
        try {
            // Validate transaction status
            if ($transaction->status !== 'pending') {
                throw new \Exception('Transaction is not in pending status');
            }
            
            // Check if transaction is expired
            if (now()->gt($transaction->expired_at)) {
                throw new \Exception('Transaction has expired');
            }
            
            // Update transaction
            $transaction->update([
                'payment_method' => $paymentData['payment_method'],
                'status' => 'paid',
                'paid_at' => now(),
                'payment_response' => $paymentData['response'] ?? null,
            ]);
            
            // Confirm registration
            $transaction->registration->update([
                'status' => 'confirmed',
            ]);
            
            DB::commit();
            
            // TODO: Send payment confirmation notification
            // TODO: Send receipt email
            
            return $transaction->fresh();
            
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    
    public function markAsFailed(Transaction $transaction, string $reason = null)
    {
        $transaction->update([
            'status' => 'failed',
            'payment_response' => ['error' => $reason],
        ]);
        
        return $transaction;
    }
    
    public function getOrganizerEarnings(int $userId, array $filters = [])
    {
        $query = Transaction::whereHas('registration.event', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->where('status', 'paid');
        
        if (isset($filters['start_date'])) {
            $query->whereDate('paid_at', '>=', $filters['start_date']);
        }
        
        if (isset($filters['end_date'])) {
            $query->whereDate('paid_at', '<=', $filters['end_date']);
        }
        
        return [
            'total_earnings' => $query->sum('organizer_amount'),
            'total_transactions' => $query->count(),
            'platform_fees' => $query->sum('platform_fee'),
            'transactions' => $query->with(['registration.event'])->latest()->paginate(15),
        ];
    }
}
<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;

class TransactionPolicy
{
    /**
     * Determine if user can view the transaction
     */
    public function view(User $user, Transaction $transaction): bool
    {
        // User can view their own transactions
        // Event organizer can view transactions for their events
        // Admin can view all transactions
        return $user->id === $transaction->user_id
            || $user->id === $transaction->registration->event->user_id
            || $user->isAdmin();
    }

    /**
     * Determine if user can update the transaction (process payment)
     */
    public function update(User $user, Transaction $transaction): bool
    {
        // Only the transaction owner can process payment
        return $user->id === $transaction->user_id;
    }
}
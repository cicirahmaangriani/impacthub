<?php

// app/Policies/RegistrationPolicy.php
namespace App\Policies;

use App\Models\Registration;
use App\Models\User;

class RegistrationPolicy
{
    /**
     * Determine if user can view the registration
     */
    public function view(User $user, Registration $registration): bool
    {
        // User can view their own registrations
        // Organizer can view registrations for their events
        // Admin can view all registrations
        return $user->id === $registration->user_id 
            || $user->id === $registration->event->user_id
            || $user->isAdmin();
    }

    /**
     * Determine if user can cancel the registration
     */
    public function cancel(User $user, Registration $registration): bool
    {
        // Only the participant can cancel their own registration
        // And only if status is not already cancelled
        return $user->id === $registration->user_id 
            && $registration->status !== 'cancelled';
    }

    /**
     * Determine if user can update registration status
     */
    public function updateStatus(User $user, Registration $registration): bool
    {
        // Event organizer or admin can update status
        return $user->id === $registration->event->user_id || $user->isAdmin();
    }
}
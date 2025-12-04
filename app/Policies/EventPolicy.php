<?php

// app/Policies/EventPolicy.php
namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    /**
     * Determine if user can view any events
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine if user can view the event
     */
    public function view(?User $user, Event $event): bool
    {
        // Published events can be viewed by anyone
        if ($event->status === 'published') {
            return true;
        }

        // Draft events can only be viewed by owner and admin
        return $user && ($user->id === $event->user_id || $user->isAdmin());
    }

    /**
     * Determine if user can create events
     */
    public function create(User $user): bool
    {
        // Only organizers and admins can create events
        return $user->isOrganizer() || $user->isAdmin();
    }

    /**
     * Determine if user can update the event
     */
    public function update(User $user, Event $event): bool
    {
        // Event owner or admin can update
        return $user->id === $event->user_id || $user->isAdmin();
    }

    /**
     * Determine if user can delete the event
     */
    public function delete(User $user, Event $event): bool
    {
        // Event owner or admin can delete
        return $user->id === $event->user_id || $user->isAdmin();
    }
}

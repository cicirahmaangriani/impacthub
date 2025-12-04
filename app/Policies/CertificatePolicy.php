<?php

namespace App\Policies;

use App\Models\Certificate;
use App\Models\User;

class CertificatePolicy
{
    /**
     * Determine if user can view the certificate
     */
    public function view(User $user, Certificate $certificate): bool
    {
        // Certificate owner, event organizer, or admin can view
        return $user->id === $certificate->user_id
            || $user->id === $certificate->event->user_id
            || $user->isAdmin();
    }

    /**
     * Determine if user can download the certificate
     */
    public function download(User $user, Certificate $certificate): bool
    {
        // Only certificate owner can download
        return $user->id === $certificate->user_id;
    }
}
<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    public function sendNotification(User $user, string $type, string $title, string $message, array $data = [])
    {
        return Notification::create([
            'user_id' => $user->id,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'data' => $data,
        ]);
    }
    
    public function sendEventReminder(User $user, $event)
    {
        return $this->sendNotification(
            $user,
            'event_reminder',
            'Event Reminder',
            "Don't forget! Your event '{$event->title}' starts tomorrow.",
            ['event_id' => $event->id]
        );
    }
    
    public function sendRegistrationConfirmation(User $user, $registration)
    {
        return $this->sendNotification(
            $user,
            'registration_confirmed',
            'Registration Confirmed',
            "Your registration for '{$registration->event->title}' is confirmed!",
            [
                'registration_id' => $registration->id,
                'registration_code' => $registration->registration_code,
            ]
        );
    }
    
    public function sendPaymentSuccess(User $user, $transaction)
    {
        return $this->sendNotification(
            $user,
            'payment_success',
            'Payment Successful',
            "Your payment of Rp " . number_format($transaction->amount, 0, ',', '.') . " has been received.",
            ['transaction_id' => $transaction->id]
        );
    }
    
    public function markAsRead(Notification $notification)
    {
        return $notification->markAsRead();
    }
    
    public function getUserNotifications(User $user, bool $unreadOnly = false)
    {
        $query = $user->notifications();
        
        if ($unreadOnly) {
            $query->unread();
        }
        
        return $query->latest()->paginate(20);
    }
}
<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Registration;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RegistrationService
{
    public function register(User $user, Event $event, array $data = [])
    {
        DB::beginTransaction();
        
        try {
            // Check if event can be registered
            if (!$event->canRegister()) {
                throw new \Exception('Event is not available for registration');
            }
            
            // Check if user already registered
            if ($event->registrations()->where('user_id', $user->id)->exists()) {
                throw new \Exception('You are already registered for this event');
            }
            
            // Create registration
            $registration = Registration::create([
                'event_id' => $event->id,
                'user_id' => $user->id,
                'registration_code' => Registration::generateRegistrationCode(),
                'status' => $event->isFree() ? 'confirmed' : 'pending',
                'notes' => $data['notes'] ?? null,
            ]);
            
            // Create transaction if event is paid
            if (!$event->isFree()) {
                $platformFee = Transaction::calculatePlatformFee($event->price);
                
                $transaction = Transaction::create([
                    'registration_id' => $registration->id,
                    'user_id' => $user->id,
                    'transaction_code' => Transaction::generateTransactionCode(),
                    'amount' => $event->price,
                    'platform_fee' => $platformFee,
                    'organizer_amount' => $event->price - $platformFee,
                    'status' => 'pending',
                    'expired_at' => now()->addHours(24),
                ]);
            }
            
            // Increment registered count
            $event->increment('registered_count');
            
            DB::commit();
            
            // TODO: Send confirmation notification
            
            return $registration->load(['transaction', 'event']);
            
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    
    public function cancelRegistration(Registration $registration, string $reason = null)
    {
        DB::beginTransaction();
        
        try {
            // Check if registration can be cancelled
            if ($registration->status === 'cancelled') {
                throw new \Exception('Registration is already cancelled');
            }
            
            // Update registration status
            $registration->update([
                'status' => 'cancelled',
                'cancellation_reason' => $reason,
                'cancelled_at' => now(),
            ]);
            
            // Decrement registered count
            $registration->event->decrement('registered_count');
            
            // Process refund if payment was made
            if ($registration->transaction && $registration->transaction->status === 'paid') {
                $registration->transaction->update([
                    'status' => 'refunded',
                ]);
                
                // TODO: Process actual refund via payment gateway
            }
            
            DB::commit();
            
            // TODO: Send cancellation notification
            
            return $registration;
            
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    
    public function confirmRegistration(Registration $registration)
    {
        if ($registration->status !== 'pending') {
            throw new \Exception('Only pending registrations can be confirmed');
        }
        
        $registration->update(['status' => 'confirmed']);
        
        // Award points if event has points reward
        if ($registration->event->points_reward > 0) {
            $this->awardPoints($registration);
        }
        
        // TODO: Send confirmation notification
        
        return $registration;
    }
    
    protected function awardPoints(Registration $registration)
    {
        $registration->user->points()->create([
            'event_id' => $registration->event_id,
            'points' => $registration->event->points_reward,
            'type' => 'earned',
            'description' => "Completed event: {$registration->event->title}",
        ]);
    }
    
    public function getUserRegistrations(User $user, string $status = null)
    {
        $query = $user->registrations()->with(['event', 'transaction']);
        
        if ($status) {
            $query->where('status', $status);
        }
        
        return $query->latest()->paginate(10);
    }
}

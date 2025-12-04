<?php

namespace Database\Factories;

use App\Models\Registration;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        $amount = fake()->randomElement([50000, 100000, 250000, 500000, 1000000]);
        $platformFee = Transaction::calculatePlatformFee($amount);
        
        return [
            'registration_id' => Registration::factory(),
            'user_id' => User::factory(),
            'transaction_code' => Transaction::generateTransactionCode(),
            'amount' => $amount,
            'platform_fee' => $platformFee,
            'organizer_amount' => $amount - $platformFee,
            'payment_method' => fake()->randomElement(['dana', 'ovo', 'gopay', 'bank_transfer']),
            'status' => 'paid',
            'paid_at' => now(),
            'expired_at' => now()->addHours(24),
        ];
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'paid_at' => null,
        ]);
    }

    public function failed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'failed',
            'paid_at' => null,
        ]);
    }
}
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin ImpactHub',
            'email' => 'admin@impacthub.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'bio' => 'Administrator ImpactHub Platform',
            'is_verified' => true,
            'email_verified_at' => now(),
        ]);

        // Organizer 1
        User::create([
            'name' => 'Tech Academy Indonesia',
            'email' => 'organizer1@impacthub.com',
            'password' => Hash::make('password'),
            'role' => 'organizer',
            'phone' => '081234567891',
            'bio' => 'Penyelenggara bootcamp dan workshop teknologi',
            'is_verified' => true,
            'email_verified_at' => now(),
        ]);

        // Organizer 2
        User::create([
            'name' => 'StartUp Hub',
            'email' => 'organizer2@impacthub.com',
            'password' => Hash::make('password'),
            'role' => 'organizer',
            'phone' => '081234567892',
            'bio' => 'Komunitas entrepreneur dan startup enthusiast',
            'is_verified' => true,
            'email_verified_at' => now(),
        ]);

        // Participants
        User::factory(10)->create([
            'role' => 'participant',
            'is_verified' => true,
            'email_verified_at' => now(),
        ]);
    }
}
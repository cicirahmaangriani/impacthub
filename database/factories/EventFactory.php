<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\EventType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(5);
        $startDate = fake()->dateTimeBetween('+1 week', '+3 months');
        $endDate = fake()->dateTimeBetween($startDate, '+4 months');
        $registrationDeadline = fake()->dateTimeBetween('now', $startDate);
        
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'event_type_id' => EventType::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'description' => fake()->paragraphs(3, true),
            'objectives' => fake()->paragraph(),
            'requirements' => fake()->paragraph(),
            'price' => fake()->randomElement([0, 50000, 100000, 250000, 500000, 1000000]),
            'quota' => fake()->numberBetween(20, 100),
            'registered_count' => 0,
            'location' => fake()->address(),
            'venue_type' => fake()->randomElement(['online', 'offline', 'hybrid']),
            'status' => 'published',
            'start_date' => $startDate,
            'end_date' => $endDate,
            'registration_deadline' => $registrationDeadline,
            'instructor_info' => fake()->sentence(8),
            'is_featured' => fake()->boolean(20),
            'certificate_available' => fake()->boolean(80),
            'points_reward' => fake()->numberBetween(50, 500),
        ];
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
        ]);
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }

    public function free(): static
    {
        return $this->state(fn (array $attributes) => [
            'price' => 0,
        ]);
    }

    public function fullyBooked(): static
    {
        return $this->state(function (array $attributes) {
            $quota = fake()->numberBetween(20, 50);
            return [
                'quota' => $quota,
                'registered_count' => $quota,
            ];
        });
    }
}
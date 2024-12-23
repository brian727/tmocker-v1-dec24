<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SummitFactory extends Factory
{
    public function definition(): array
    {
        $startTime = now()->subDays(rand(1, 30));
        return [
            'user_id' => User::factory(),
            'start_time' => $startTime,
            'end_time' => $startTime->copy()->addMinutes(rand(30, 120)),
            'temp' => fake()->numberBetween(60, 90),
        ];
    }
}

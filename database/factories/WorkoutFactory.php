<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Workout>
 */
class WorkoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->text(),
            'workout_duration' => $this->faker->numberBetween(30, 75),
            'difficulty' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->text(),
            'user_id' => User::factory(),
            'published_at' => now()
        ];
    }
}
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Workout;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercise>
 */
class ExerciseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'description' => $this->faker->text(),
            'exercise_duration' => $this->faker->numberBetween(10, 30),
            'ordinal_number' => $this->faker->numberBetween(1, 5),
            'workout_id' => Workout::factory()
        ];
    }
}
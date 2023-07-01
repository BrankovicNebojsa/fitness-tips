<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Workout;
use \App\Models\Exercise;
use \App\Models\Equipment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Workout::truncate();
        Exercise::truncate();
        \App\Models\User::truncate();

        \App\Models\User::factory(5)->create();

        Workout::create([
            'id' => 1,
            'title' => "Push day",
            'workout_duration' => 60,
            'difficulty' => 7,
            'description' => "Ovo je trening na kojem se rade 3 misica na telu: grudi, ramena i triceps",
            'user_id' => 1,
            'published_at' => now()
        ]);

        Workout::create([
            'id' => 2,
            'title' => "Pull day",
            'workout_duration' => 50,
            'difficulty' => 4,
            'description' => "Ovo je trening na kojem se rade 2 misica na telu: ledja i biceps",
            'user_id' => 1,
            'published_at' => now()
        ]);

        Workout::factory(4)->create();
        $workout = Workout::factory()->create();

        Exercise::create([
            'description' => 'Bench press',
            'exercise_duration' => 15,
            'ordinal_number' => 1,
            'workout_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Exercise::create([
            'description' => 'Incline bench',
            'exercise_duration' => 20,
            'ordinal_number' => 2,
            'workout_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Exercise::create([
            'description' => 'Chest flys',
            'exercise_duration' => 10,
            'ordinal_number' => 3,
            'workout_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Exercise::create([
            'description' => 'Triceps pulldown',
            'exercise_duration' => 15,
            'ordinal_number' => 4,
            'workout_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Exercise::create([
            'description' => 'Lat pulldown',
            'exercise_duration' => 15,
            'ordinal_number' => 1,
            'workout_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Exercise::create([
            'description' => 'Pull ups - wide grip',
            'exercise_duration' => 10,
            'ordinal_number' => 2,
            'workout_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Exercise::create([
            'description' => 'Bicep curls',
            'exercise_duration' => 10,
            'ordinal_number' => 3,
            'workout_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Exercise::create([
            'description' => 'Pull ups - close grip',
            'exercise_duration' => 15,
            'ordinal_number' => 4,
            'workout_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Equipment::create([
            'machines' => 'Bench, dumbells, cable',
            'gear' => 'Sports clothes, towel and a bottle of water. Belt if lifting heavy.',
            'workout_id' => 1
        ]);

        Equipment::create([
            'machines' => 'Bar, dumbells',
            'gear' => 'Sports clothes, towel and a bottle of water. Belt if lifting heavy.',
            'workout_id' => 2
        ]);

        Equipment::create([
            'machines' => 'Bench, dumbells, cable',
            'gear' => 'Sports clothes, towel and a bottle of water',
            'workout_id' =>$workout->id
        ]);

        Equipment::factory(3)->create();
    }
}
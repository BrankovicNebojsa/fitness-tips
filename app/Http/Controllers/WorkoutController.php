<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkoutCollection;
use App\Http\Resources\WorkoutResource;
use App\Models\Equipment;
use App\Models\Workout;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new WorkoutCollection(Workout::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required',
                'workout_duration' => 'required',
                'difficulty' => 'required',
                'description' => 'required'
            ]);
        } catch (\Illuminate\Validation\ValidationException $th) {
            return response()->json("There are empty fields. All fields are required.", 400);
        }
        $workoutData = [
            'title' => $request->title,
            'workout_duration' => $request->workout_duration,
            'difficulty' => $request->difficulty,
            'description' => $request->description,
            'user_id' => $request->user_id
        ];
        $newWorkout = Workout::create($workoutData);

        $this->saveEquipment($newWorkout->id, $request);
        $this->saveExercises($newWorkout->id, $request);

        $newWorkout = Workout::find($newWorkout->id);
        return response()->json(new WorkoutResource($newWorkout), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $workout = Workout::find($id);
        if (is_null($workout)) {
            return response()->json("Workout with id $id not found", 404);
        }

        return response()->json(new WorkoutResource($workout));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tempWorkout = Recipe::find($id);
        if (is_null($tempWorkout)) {
            return response()->json("Workout with id $id doesn't exist.");
        }

        $tempWorkout->delete();

        $equipment = Equipment::where('workout_id', '=', $id);
        if (!is_null($equipment)) {
            $equipment->delete();
        }

        $exercises = Exercise::where('workout_id', '=', $id);

        if (!is_null($exercises)) {
            $exercises->delete();
        }

        return response()->json($tempWorkout, 200);
    }


    private function saveEquipment($id, $request)
    {

        $equipment = $request->equipment;
        foreach ($equipment as $eq) {
            $eqData = [
                'machines' => $eq['machines'],
                'gear' => $eq['gear'],
                'workout_id' => $id
            ];

            Equipment::create($eqData);
        }
    }

    private function saveExercises($id, $request)
    {
        $exercises = $request->exercises;
        foreach ($exercises as $exerc) {
            $exercData = [
                'description' => $exerc['description'],
                'exercise_duration' => $exerc['exercise_duration'],
                'ordinal_number' => $exerc['ordinal_number'],
                'workout_id' => $id
            ];

            Exercise::create($exercData);
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workout;

class UserWorkoutController extends Controller
{
    public function index($user_id) {
        $workouts = Workout::get()->where('user_id',$user_id);
        if (is_null($workouts)) {
            return response()->json('Data not found', 404);
        }
        return response()->json($workouts);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new UserCollection(User::all());
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
                'name' => 'required',
                'email' => 'required|email|unique:users',
            ]);
        } catch (\Illuminate\Validation\ValidationException $th) {
            return response()->json("All fields must be filled, bad email or user with that email exists", 400);
        }
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];
        $newUser = User::create($userData);

        return response()->json($newUser, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json("User with id $id not found", 404);
        }

        return response()->json(new UserResource($user));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tempUser = User::find($id);
        if (is_null($tempUser)) {
            return response()->json("User with id $id doesn't exist.");
        }

        try {
            if ($request->has('email') && $request->email != $tempUser->email)
                $this->validate($request, [
                    'email' => 'email|unique:users',
                ]);
        } catch (\Illuminate\Validation\ValidationException $th) {
            return response()->json("Bad email or email exists already", 400);
        }

        if ($request->has('name'))
            $tempUser->name = $request->name;
        if ($request->has('email'))
            $tempUser->email = $request->email;
        if ($request->has('password'))
            $tempUser->password = bcrypt($request->password);

        $tempUser->update();

        return response()->json($tempUser, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tempUser = User::find($id);
        if (is_null($tempUser)) {
            return response()->json("User with id $id doesn't exist.", 400);
        }

        $tempUser->delete();
        return response()->json($tempUser, 200);
    }
}
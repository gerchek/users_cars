<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;

class UserController extends Controller
{
    //
    public function index()
    {
        return User::all();
    }

    public function show(User $user)
    {
        return $user;
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());

        return response()->json($user, 201);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return response()->json($user, 200);
    }

    public function delete(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }


    // ---------------------------------------------------------------------------------BOOK A CAR
    public function bookCar(Request $request)
    {
        $car_id = intval( $request->car_id );
        $user_id = intval( $request->user_id );
        $user = User::where("car_id", '=', $car_id)->get();
        if(count($user) == 0)
        {
            $user_update = User::find($user_id);
            $user_update->car_id = $car_id;
            $user_update->save();
            return response()->json(['success' => 'success'], 200);
        }
        else{
            return response()->json(['error' => 'The car is already booked'], 401);
        }
    }
}

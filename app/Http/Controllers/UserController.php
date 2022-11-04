<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\Car;

class UserController extends Controller
{
    //
    public function index()
    {
        return User::with('car')->get();
    }

    public function show(User $user)
    {
        return $user->with('car')->find($user);
    }

    public function store(Request $request)
    {
        $rules=array(
            'name'  =>"required|min:2|max:30",
            'email' =>"required|email|min:5|max:30",
            'password' =>"required|min:5|max:30",
        );

        $validator=Validator::make($request->all(),$rules);
        
        if($validator->fails())
        {
            return $validator->errors();
        }
        else
        {
            $user = User::create($request->all());

            return response()->json($user, 201);
        }

        
    }

    public function update(Request $request, User $user)
    {
        $rules=array(
            'name'  =>"required|min:2|max:30",
            'email' =>"required|min:5|max:30",
            'password' =>"required|min:5|max:30",
        );

        $validator=Validator::make($request->all(),$rules);
        
        if($validator->fails())
        {
            return $validator->errors();
        }
        else
        {
            $user->update($request->all());

            return response()->json($user, 200);
        }
    }

    public function delete(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }


    // ---------------------------------------------------------------------------------BOOK A CAR
    public function bookCar(Request $request)
    {
        $rules=array(
            'car_id'  =>"required|integer|min:1",
            'user_id' =>"required|integer|min:1",
        );

        $validator=Validator::make($request->all(),$rules);
        
        if($validator->fails())
        {
            return $validator->errors();
        }
        else
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
}

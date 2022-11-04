<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Validator;

class CarController extends Controller
{
    //
    public function index()
    {
        return Car::all();
    }

    public function show(Car $car)
    {
        return $car;
    }

    public function store(Request $request)
    {
        $rules=array(
            'name'  =>"required|min:2|max:30",
        );

        $validator=Validator::make($request->all(),$rules);
        
        if($validator->fails())
        {
            return $validator->errors();
        }
        else
        {
            $cars = Car::create($request->all());

            return response()->json($cars, 201);
        }
       
    }

    public function update(Request $request, Car $car)
    {
        $rules=array(
            'name'  =>"required|min:2|max:30",
        );

        $validator=Validator::make($request->all(),$rules);
        
        if($validator->fails())
        {
            return $validator->errors();
        }
        else
        {
            $car->update($request->all());

            return response()->json($car, 200);
        }
        
    }

    public function delete(Car $car)
    {
        $car->delete();

        return response()->json(['success' => 'deleted successfully'], 200);
    }
}

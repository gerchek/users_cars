<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    //
    public function index()
    {
        return Car::all();
    }

    public function show(Car $cars)
    {
        return $cars;
    }

    public function store(Request $request)
    {
        $cars = Car::create($request->all());

        return response()->json($cars, 201);
    }

    public function update(Request $request, Car $cars)
    {
        $cars->update($request->all());

        return response()->json($cars, 200);
    }

    public function delete(Car $cars)
    {
        $cars->delete();

        return response()->json(null, 204);
    }
}

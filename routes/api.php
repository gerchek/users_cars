<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//  ------------------------------------------------------------------------------------CARS
Route::get('cars',[CarController::class, 'index']);
Route::get('cars/{cars}',[CarController::class, 'show']);
Route::post('cars',[CarController::class, 'store']);
Route::put('cars/{cars}',[CarController::class, 'update']);
Route::delete('cars/{cars}',[CarController::class, 'delete']);
//  ------------------------------------------------------------------------------------USERS
Route::get('users',[UserController::class, 'index']);
Route::get('users/{user}',[UserController::class, 'show']);
Route::post('users',[UserController::class, 'store']);
Route::put('users/{user}',[UserController::class, 'update']);
Route::delete('users/{user}',[UserController::class, 'delete']);

Route::post('bookCar',[UserController::class, 'bookCar']);
<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::resource('/orders', OrderController::class);

Route::get('/count-all-except-five', [Controller::class, 'countAllExceptFive']);
Route::get('/alpha-to-int', [Controller::class, 'alphaToInt']);
Route::get('/min-steps', [Controller::class, 'minSteps']);

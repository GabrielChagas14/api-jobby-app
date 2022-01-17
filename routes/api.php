<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('job', 'App\Http\Controllers\JobController'); rotas com create e edit
Route::prefix('v1')->middleware('jwt.auth')->group(function(){
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
    Route::apiResource('user', 'App\Http\Controllers\UserController');
    Route::apiResource('job', 'App\Http\Controllers\JobController');
    Route::apiResource('Allocations', 'App\Http\Controllers\AllocationsController');
});


Route::post('login', 'App\Http\Controllers\AuthController@login');

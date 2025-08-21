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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/api/login', '\App\Http\Controllers\ApiController@login');
Route::post('/api/activation', '\App\Http\Controllers\ApiController@activation');
Route::post('/api/logs', '\App\Http\Controllers\ApiController@logs');


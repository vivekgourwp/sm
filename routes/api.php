<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\StudentController;
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


Route::post('signup',[AuthController::class, 'signup']);
Route::post('login',[AuthController::class, 'login']);

Route::apiResource('students', StudentController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout',[AuthController::class, 'logout']);
    Route::apiResource('posts', PostController::class);
});



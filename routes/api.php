<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiUserController;
use App\Http\Controllers\apiCourseController;
use App\Http\Controllers\apiUserCourseController;
use App\Models\Courses;

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

// User
Route::apiResource('users', apiUserController::class);

// Courses
Route::apiResource('courses', apiCourseController::class);

// User Course
Route::apiResource('userCourse', apiUserCourseController::class);

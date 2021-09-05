<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\ModuleController;

//Courses
Route::get('/courses', [CourseController::class, 'index']);
Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses/{uuid}', [CourseController::class, 'show']);
Route::put('/courses/{course}', [CourseController::class, 'update']);
Route::delete('/courses/{uuid}', [CourseController::class, 'destroy']);

//Modules
Route::post('/courses/{course}/modules', [ModuleController::class, 'store']);
Route::get('/modules', [ModuleController::class, 'index']);
Route::get('/modules/{module}', [ModuleController::class, 'show']);
Route::put('/modules/{module}', [ModuleController::class, 'update']);
Route::delete('/modules/{module}', [ModuleController::class, 'destroy']);

Route::get('/', function () {
    return response()->json(['message' => 'Ok']);
});


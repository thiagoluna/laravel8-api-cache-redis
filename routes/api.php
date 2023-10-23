<?php

use App\Http\Controllers\Api\EmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\ModuleController;
use App\Http\Controllers\Api\LessonController;

Route::get('/', function () {
    return response()->json(['message' => 'Ok']);
});

Route::prefix('api')->group(function () {

    Route::prefix('v1')->group(function () {

        //Courses
        Route::get('/courses', [CourseController::class, 'index']);
        Route::get('/cached-courses', [CourseController::class, 'getCachedAllCourses']);
        Route::get('/only-courses', [CourseController::class, 'getOnlyCourses']);
        Route::post('/courses', [CourseController::class, 'store']);
        Route::get('/courses/{uuid}', [CourseController::class, 'show']);
        Route::put('/courses/{course}', [CourseController::class, 'update']);
        Route::delete('/courses/{uuid}', [CourseController::class, 'destroy']);

        //Modules
        Route::post('/modules', [ModuleController::class, 'store']);
        Route::get('/modules', [ModuleController::class, 'index']);
        Route::get('/modules/{module}', [ModuleController::class, 'show']);
        Route::put('/modules/{module}', [ModuleController::class, 'update']);
        Route::delete('/modules/{module}', [ModuleController::class, 'destroy']);

        //Lessons
        Route::post('/lessons', [LessonController::class, 'store']);
        Route::get('/modules/{module}/lessons', [LessonController::class, 'index']);
        Route::get('/modules/{module}/lessons/{lesson}', [LessonController::class, 'show']);
        Route::put('modules/{module}/lessons/{lesson}', [LessonController::class, 'update']);
        Route::delete('/modules/{module}/lessons/{lesson}', [LessonController::class, 'destroy']);

        //Email
        Route::post('/email/welcome', [EmailController::class, 'sendWelcomeEmail']);
    });
});


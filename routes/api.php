<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('workouts', WorkoutController::class);

    Route::post('/logout', [AuthController::class, 'logout']);
});

// Admin-only routes
Route::middleware('auth:sanctum', 'admin')->group(function () {
    Route::get('/admin/users', [AdminController::class, 'getAllUsers']);
    Route::get('/admin/users/{user}', [AdminController::class, 'getUser']);
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser']);
    Route::get('/admin/users/{user}/workouts', [AdminController::class, 'getUserWorkouts']);
    Route::post('/admin/users/{user}/workouts', [AdminController::class, 'createUserWorkout']);
});

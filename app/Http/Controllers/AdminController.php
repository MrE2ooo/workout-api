<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Get all users (admin only).
     */
    public function getAllUsers()
    {
        // Fetch all users
        $users = User::all();

        // Return the users
        return response($users, 200);
    }

    /**
     * Get a single user by ID (admin only).
     */
    public function getUser(User $user)
    {
        // Return the user
        return response($user, 200);
    }

    /**
     * Delete a user (admin only).
     */
    public function deleteUser(User $user)
    {
        // Delete the user
        $user->delete();

        // Return a success message
        return response(['message' => 'User deleted successfully'], 200);
    }

    /**
     * Get all workouts for a specific user (admin only).
     */
    public function getUserWorkouts(User $user)
    {
        // Fetch all workouts for the specified user
        $workouts = $user->workouts()->with('exercises')->get();

        // Return the workouts
        return response($workouts, 200);
    }

    /**
     * Create a workout for a specific user (admin only).
     */
    public function createUserWorkout(Request $request, User $user)
    {
        // Validate the request
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'exercises' => 'required|array', // Array of exercises
            'exercises.*.name' => 'required|string|max:255',
            'exercises.*.weight' => 'required|string',
            'exercises.*.reps' => 'required|string',
            'exercises.*.sets' => 'required|string',
        ]);

        // Create the workout and associate it with the specified user
        $workout = $user->workouts()->create([
            'name' => $fields['name'],
        ]);

        // Create the exercises for the workout
        foreach ($fields['exercises'] as $exerciseData) {
            $workout->exercises()->create($exerciseData);
        }

        // Return the created workout with exercises
        return response($workout->load('exercises'), 201);
    }
}
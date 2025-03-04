<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class WorkoutController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum') // Apply to all methods
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // If the user is an admin, return all workouts with their associated exercises
        if ($request->user()->is_admin) {
            return Workout::with('exercises')->get();
        }

        // If the user is not an admin, return only their workouts with associated exercises
        return $request->user()->workouts()->with('exercises')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        // Create the workout and associate it with the authenticated user
        $workout = $request->user()->workouts()->create([
            'name' => $fields['name'],
        ]);

        // Create the exercises for the workout
        foreach ($fields['exercises'] as $exerciseData) {
            $workout->exercises()->create($exerciseData);
        }

        // Return the created workout with exercises
        return response($workout->load('exercises'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workout $workout)
    {
        return $workout->load('exercises');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workout $workout)
    {
        // Allow admins to bypass the Gate check
        if (!$request->user()->is_admin) {
            Gate::authorize('modify', $workout);
        }

        // Validate the request
        $fields = $request->validate([
            'name' => ['required', 'max:255'],
        ]);

        $workout->update($fields);
        return $workout->load('exercises');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Workout $workout)
    {
        // Allow admins to bypass the Gate check
        if (!$request->user()->is_admin) {
            Gate::authorize('modify', $workout);
        }

        $workout->delete();
        return ['message' => 'the workout was deleted'];
    }
}

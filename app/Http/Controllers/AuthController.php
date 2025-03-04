<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function register(Request $request)
    {
        // Validate the request
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'is_admin' => 'boolean', // Optional: Allow setting is_admin during registration
        ]);

        // Create the user
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'is_admin' => $fields['is_admin'] ?? false, // Default to false if not provided
        ]);

        // Create a token for the user
        $token = $user->createToken('authToken')->plainTextToken;

        // Return the user and token
        return response([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        // Validate the request
        $fields = $request->validate([
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string',
        ]);

        // Find the user
        $user = User::where('email', $fields['email'])->first();

        // Check if the user exists and the password is correct
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Invalid credentials',
            ], 401);
        }

        // Generate a token for the user
        $token = $user->createToken($user->name)->plainTextToken;

        // Return the user and token
        return response([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        // Revoke the user's current token
        $request->user()->currentAccessToken()->delete();

        // Return a success message
        return response([
            'message' => 'Logged out successfully',
        ], 200);
    }
}

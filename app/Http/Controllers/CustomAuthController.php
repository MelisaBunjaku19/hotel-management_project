<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str; // Import here

class CustomAuthController extends Controller
{
    // Handle user login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('YourAppName')->plainTextToken;
            $refreshToken = $user->generateRefreshToken(); // Ensure this method exists on your User model
    
            // Set the tokens in the session if needed
            session(['access_token' => $token, 'refresh_token' => $refreshToken]);
    
            // Redirect to home page or any other route after successful login
            return redirect()->route('home'); // Assuming you have a 'home' route
        }
    
        return redirect()->back()->withErrors(['error' => 'Unauthorized']);
    }
    

    // Method to refresh access token using refresh token
    public function refresh(Request $request)
    {
        $request->validate(['refresh_token' => 'required|string']);

        $user = User::where('refresh_token', $request->refresh_token)->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid refresh token'], 401);
        }

        $token = $user->createToken('YourAppName')->plainTextToken;
        $newRefreshToken = $user->generateRefreshToken();

        return response()->json([
            'access_token' => $token,
            'refresh_token' => $newRefreshToken,
            'token_type' => 'Bearer',
        ]);
    }

    // Method to logout and revoke refresh token
    public function logout(Request $request)
    {
        $user = Auth::user();
        
        if ($user) {
            $user->revokeRefreshToken(); // Revoke the refresh token
            Auth::logout(); // Logout the user
            $request->session()->invalidate(); // Invalidate the session
            $request->session()->regenerateToken(); // Regenerate CSRF token
        }
    
        // Redirect to the login page after logout
        return redirect()->route('login')->with('message', 'Logged out successfully');
    }
    

}

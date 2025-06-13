<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MapDevice;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Retrieve the email and password from the request
        $email = $request->input('email');
        $password = $request->input('password');

        // Fetch the user by email from the MapDevice model
        $user = MapDevice::where('customer_email', $email)->first();

        // Check if the user exists and the password matches
        if ($user !== null && Hash::check($password, $user->password)) {
            // Authenticate the user explicitly by setting it in the auth guard
            Auth::login($user); // Explicitly authenticate the user

            // Issue a Sanctum token
            $token = $user->createToken('wemis')->plainTextToken;

            // Return the token and user details
            return response()->json([
                'message' => 'User authenticated successfully',
                'token' => $token,
                // 'user' => auth('api')->user(), // Now this should work as the user is logged in
            ]);
        }

        // If user is not found or password doesn't match, return an error
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);

    }
}

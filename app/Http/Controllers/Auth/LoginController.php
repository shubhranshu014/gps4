<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /**
     * Handle the login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request): \Illuminate\Http\RedirectResponse
    { 
      
        // Validate the incoming request data
        $validated = $request->validate([
            'email' => 'required|email',  // Validate email format
            'password' => 'required|min:8', // Password should be at least 8 characters
        ]);

        // Attempt to login as a regular user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect to the intended page after successful login
            return redirect()->route('super.dashboard');  // Replace '/dashboard' with your intended page
        }
        // Attempt to login as an admin user
        elseif (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect to the admin dashboard after successful login
           
            return redirect()->route('admin.dashboard');  // Replace 'admin.dashboard' with your admin route name
        }elseif (Auth::guard('wlp')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect to the admin dashboard after successful login
            return redirect()->route('wlp.dashboard');  // Replace 'admin.dashboard' with your admin route name
        } elseif (Auth::guard('manufacturer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect to the admin dashboard after successful login
            return redirect()->route('manufacturer.dashboard');  // Replace 'admin.dashboard' with your admin route name
        } 
        elseif (Auth::guard('distributor')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect to the admin dashboard after successful login
            return redirect()->route('distributor.dashboard');  // Replace 'admin.dashboard' with your admin route name
        }
        elseif (Auth::guard('dealer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect to the admin dashboard after successful login
            return redirect()->route('dealer.dashboard');  // Replace 'admin.dashboard' with your admin route name
        }
        elseif (Auth::guard('technician')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect to the admin dashboard after successful login
            return redirect()->route('technician.dashboard');  // Replace 'admin.dashboard' with your admin route name
        } else {
            // Redirect back with error message if credentials are invalid
            return redirect()->route('login-form')
                             ->with('error', 'Credentials do not match!');
        }
    }
}




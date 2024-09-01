<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show Login Form
    public function login()
    {
        return view('users.login');
    }

    // Authenticate User
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (Auth::attempt($formFields)) {
            $request->session()->regenerate();

            // Redirect based on the user's role
            $user = Auth::user();
            if ($user->role === 'Owner') {
                return redirect()->route('owners.index')->with('message', 'Welcome back, Owner!');
            } else {
                return redirect('/')->with('message', 'You are now logged in');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    // Logout User
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'You have been logged out');
    }
}

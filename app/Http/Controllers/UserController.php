<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create() 
    {
        return view('users.register');
    }

    // Create New User
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'role' => ['required', Rule::in(['Owner', 'Customer'])],
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
            'user_tags' => 'required|string'
        ]);

        // Hash Password
        $formFields['password'] = Hash::make($formFields['password']);

        // Create User
        $user = User::create($formFields);

        // Login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    public function show()
    {
        $user = Auth::user();
        return view('users.show', compact('user'));
    }

    public function owner_show()
    {
        $user = Auth::user();
        return view('users.owner_show', compact('user'));
    }

    // Show Edit Form
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    // Update User Information
    public function update(Request $request, User $user)
    {
        $formFields = $request->validate([
            'role' => ['required'],
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'user_tags' => ['nullable', 'string']
        ]);

        // Update the user with the validated data
        $user->update($formFields);

        // Redirect back with a success message
        return redirect('/')->with('message', 'User updated successfully.');
    }

    public function updatePassword(Request $request, User $user)
    {
        $formFields = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        if (!Hash::check($formFields['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->password = Hash::make($formFields['password']);
        $user->save();

        return redirect('/')->with('message', 'Password updated successfully!');
    }

    public function showChangePasswordForm()
    {
        return view('users.change_password');
    }

    public function owner_showChangePasswordForm()
    {
        return view('users.owner_change_password');
    }

    // Delete User
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/')->with('message', 'User deleted successfully');
    }
}

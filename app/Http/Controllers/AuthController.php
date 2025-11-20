<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // added
use App\Models\User; // added

class AuthController extends Controller
{

    public function showRegisterForm()
{
    return view('auth.register'); // make sure ang file name kay resources/views/register.blade.php
}
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Check if user exists
        $user = User::where('email', $request->email)->first();

        // Validate credentials (no hashing per your preference)
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid email or password']);
        }

        // Log the user in
        auth()->login($user);

        // Redirect based on role
        if ($user->role == 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role == 'instructor') {
            return redirect('/instructor/dashboard');
        } else {
            return redirect('/student/dashboard');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,student,instructor'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // use hash
        $user->role = $request->role;
        $user->save();

        return redirect()->route('login')->with('success', 'Account created!');
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    

}
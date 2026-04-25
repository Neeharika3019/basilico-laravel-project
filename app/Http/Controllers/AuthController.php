<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ================= LOGIN =================
    public function loginProcess(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email not found')->withInput();
        }

        if (!Hash::check($request->password, $user->password_hash)) {
            return back()->with('error', 'Incorrect password')->withInput();
        }

        // Store user session
        $request->session()->put([
            'user_id'    => $user->user_id,
            'first_name' => $user->first_name,
            'role'       => $user->role
        ]);

        // Regenerate session for security
        $request->session()->regenerate();

        // Redirect user if they were forced to login before accessing a page
        if ($request->session()->has('redirect_to')) {
            $redirectPage = $request->session()->get('redirect_to');
            $request->session()->forget('redirect_to');
            return redirect($redirectPage);
        }

        // Redirect admin
        if ($user->role === 'admin') {
            return redirect('/admin')->with('success', 'Admin login successful!');
        }

        // Redirect normal user
        return redirect()->route('home')->with('success', 'Login successful!');
    }

    // ================= REGISTER =================
    public function registerProcess(Request $request)
    {
        $request->validate([
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email',
            'phone'            => ['required', 'regex:/^[0-9]{8}$/'],
            'password'         => ['required', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            'confirm_password' => 'required|same:password'
        ]);

        $user = new User();
        $user->first_name    = $request->first_name;
        $user->last_name     = $request->last_name;
        $user->email         = $request->email;
        $user->phone         = $request->phone;
        $user->password_hash = Hash::make($request->password);
        $user->role          = 'customer';
        $user->save();

        return redirect()->route('login')->with('success', 'Account created successfully! Please login.');
    }

    // ================= LOGOUT =================
    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
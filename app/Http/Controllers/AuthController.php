<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

 public function doRegister(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20|unique:users', // use phone instead of email
        'password' => 'required|string|min:8|confirmed',
        'user_type' => 'required|in:client,merchant',
    ]);

    $user = User::create([
        'name' => $request->name,
        'phone' => $request->phone, // save phone
        'password' => Hash::make($request->password),
    ]);

    // Assign role based on user type
    $roleName = $request->user_type;
    $role = Role::firstOrCreate(['name' => $roleName]);
    $user->assignRole($role);

    // Auto login
    Auth::login($user);

    // Redirect based on user type
    if ($request->user_type === 'merchant') {
        return redirect()->route('store.setup'); // Redirect to store setup for merchants
    }

    return redirect()->route('home');
}

    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $phone = $request->phone;

        // Attempt to authenticate using phone
        if (Auth::attempt(['phone' => $phone, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->intended()->withInput();
        }

        return back()->withErrors([
            'phone' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function profile()
    {
        return view('auth.profile');
    }

    public function doUpdateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}

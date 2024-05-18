<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signupPage()
    {
        return view('auth.signup');
    }

    public function storeData(AuthRequest $request)
    {
        $data = new User;
        $data->full_name = $request->fullName;
        $data->user_name = $request->userName;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->mobile_number = $request->mobileNumber;
        $data->date_of_birth = $request->DateOfBirth;
        echo $data->save();

        return redirect()->route('signup')->with('success', 'User registered successfully. Please log in.');
    }

    public function loginPage()
    {
        return view('auth.login');
    }
    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('profile')->with('success', 'You are logged in!');
        }

        return redirect()->route('login')->with('error', 'The provided credentials do not match our records.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}

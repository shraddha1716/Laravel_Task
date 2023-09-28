<?php

// ----------we take our code in Auth folder that why some change to import controller class ---------------------
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
// -----------------------------------------end ----------------------------------------

// ---------------------- we used Auth facade to used authentication ----------------------
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.custom_login'); // Create this view in the next step
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect('/home'); // Replace with your desired redirect URL
        }

        return back()->withErrors(['email' => 'Login failed.']); // Redirect back with an error message
    }

    public function dashboard(){
        return view('auth.home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login'); // Redirect to the login page after logout
    }
}

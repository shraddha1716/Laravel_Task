<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:8',
        ];

        $request->validate($rules);

        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return redirect('/login')->with('success', 'Registration Successfully');
    }

    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $rules = [
            'mobile' => 'required|string|max:20',
            'password' => 'required|string',
        ];
        $request->validate($rules);

        if (auth()->attempt(['mobile' => $request->input('mobile'), 'password' => $request->input('password')])) {
            return redirect('/blogs');
        }
        return redirect()->back()->withInput()->withErrors(['login' => 'Invalid credentials.']);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}

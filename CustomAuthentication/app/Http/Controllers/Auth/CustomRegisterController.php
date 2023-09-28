<?php
// ----------we take our code in Auth folder that why some change to import controller class ---------------------
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
// -----------------------------------------end ----------------------------------------
use Illuminate\Http\Request;
use App\Models\User;



class CustomRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest'); // if any user is allready autneticated so to register la jau nahi shakt karan tyach registration allready jhalel aast
    }
    public function showRegistrationForm()
    {
        return view('auth.custom_register'); // Create this view in the next step
    }

    public function register(Request $request)
    {
        // Validate the user input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
        ]);

        // Create a new user record
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
        ]);

        // Redirect to the login page or another appropriate location
        return redirect('/login'); // Replace with your desired redirect URL
    }
}

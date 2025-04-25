<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showlogin()
    {
        return view('Auth.login');
    }



    public function showRegister()
    {
        return view('Auth.registration');
    }


    public function Register(Request $request)
    {

        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);


         $user = User::create([

              'name'=>$request->name,
              'email'=>$request->email,
              'password'=>Hash::make($request->password),
              'role'=>'user'


         ]);


        

         Session::flash('success','Registration successful! Please login.');
         return redirect()->route('login');

    }

    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to login
         $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            
            $user = Auth::user();

            // Redirect based on role
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'user') {
                return redirect()->route('user.dashboard');
            } else {
                Auth::logout();
                return back()->with('error', 'Unauthorized role.');
            }
        }

        // If login fails
        return back()->with('error', 'Invalid email or password.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * show login form
     *
     * @return view
     */
    public function loginForm(){
        // check if user is not logged in, redirects to home page if user is logged in
        if(!Auth::check()){
            return view('login.form');
        } else {
            return redirect(route('home'));
        }
    }

    /**
     * Authenticate login
     *
     * @param Request $request
     * @return redirect
     */
    public function authenticate(Request $request){
        // validate form input posted to login route
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // attempt login with provided data from input fieds from login form
        if (Auth::attempt($credentials)) {
            // if login was a success create a session and redirect to home page
            $request->session()->regenerate();
            return redirect(route('home'));
        }else {
            // if login failed return to login page and show error message
            return back()->withErrors([
                                        'login' => 'The provided credentials do not match our records.',
                                        ])->onlyInput('login');
        }

    }

    /**
     * Log the user out of the application.
     * 
     * @return redirect
     */
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect(route('login.form'));
    }
}

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
    public function LoginForm(){
        //check if user is not logged in, redirects to home page if user is logged in
        if(!Auth::check()){
            return view('login.form');
        } else {
            return redirect('home');
        }
    }

    /**
     * Authenticate login
     *
     * @param Request $request
     * @return redirect
     */
    public function Authenticate(Request $request){
        //validate form input posted to login route
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        //attempt login with provided data from input fieds from login form
        if (Auth::attempt($credentials)) {
            // if login was a success create a session and redirect to home page
            $request->session()->regenerate();
            return redirect()->intended('home');
        }else {
            //if login failed return to login page and show error message
            return back()->withErrors([
                                        'login' => 'The provided credentials do not match our records.',
                                        ])->onlyInput('login');
        }

    }
}

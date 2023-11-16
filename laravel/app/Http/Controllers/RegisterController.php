<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * show registration form
     *
     * @return view
     */
    public function registerForm(){
        // check if user is not logged in, redirects to home page if user is logged in
        if(!Auth::check()){
            return view('register.form');
        } else {
            return redirect(route('home'));
        }
    }

    /**
     * validate and process values send from the registration form
     *
     * @param Request $request
     * @return redirect
     */
    public function register(Request $request){
        
        // validate form input posted to register route
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // create a new user with validated input
        User::create($credentials);

        // redirect to login route with a success message
        return redirect(route('login.form'))->with('success', 'Success you have been registered');
    }
}

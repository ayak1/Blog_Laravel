<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(){
        return view('auth.login');
    }
    public function store(){
        // validate
        $validatedAttributes = request()->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        // attempt to login the user
        if(!Auth::attempt($validatedAttributes)){
            throw ValidationException::withMessages(([
                'email'    => 'sorry this credentials do not match',
                'password' => 'please enter a valid password'
            ]));
        }
        // regenerate the session token
        request()->session()->regenerate();
        // redirect
        return redirect('/posts');

    }

    public function destroy(){
       Auth::logout();
       return redirect('/');
    }
}

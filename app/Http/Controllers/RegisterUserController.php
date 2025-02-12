<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterUserController extends Controller
{
    public function create(){
        return view('auth.register');
    }
    public function store(){
        // validate
        $validatedAttributes = request()->validate([
            'name'    =>['required'],
            'email'   =>['required','email'],
            'password'=>['required',Password::min(6),'confirmed'], //confirmed will look for field password_confirmation
        ]);
        // create user
        $user = User::create($validatedAttributes);
        // login 
        Auth::login($user);
        // redirect to page...
        return redirect('/posts');

    }
}

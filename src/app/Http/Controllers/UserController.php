<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getLogin()
    {
        $user = auth()->user();

        return view('login', ['user' => $user]);
    }

    public function forgotPassword()
    {
        return view('forgotPassword');
    }

    public function register()
    {
        return view('users.register');
    }

    public function doLogin(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            echo "You did it!";
        } else {
            dd($request->validated());
        }
        // redirect to desired page
    }
}

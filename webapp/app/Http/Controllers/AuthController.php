<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Gebruiker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function loginView()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $gebruiker = Gebruiker::where('email', $request['email'])->first();

        if (Hash::check($request['password'], $gebruiker['wachtwoord'])) {
            Auth::login($gebruiker);

            return redirect()->route('dashboard')->with('welcome', 'Welkom, Succesvol ingelogd!');
        }else{
            return redirect()->route('login')->with('error', 'Combinatie is niet correct!');
        }
    }
}

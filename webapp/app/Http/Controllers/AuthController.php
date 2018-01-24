<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Gebruiker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    public function loginView()
    {
        if(Auth::check()){
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $gebruiker = Gebruiker::where('email', strtolower($request['email']))->first();

        if (Hash::check($request['password'], $gebruiker['wachtwoord'])) {
            Auth::login($gebruiker);

            if(isset($gebruiker['tussenvoegsel'])) {
                $name = $gebruiker['voornaam'] . ' ' . $gebruiker['tussenvoegsel'] . ' ' .  $gebruiker['achternaam'];
            }else{
                $name = $gebruiker['voornaam'] . ' ' .  $gebruiker['achternaam'];
            }
            return redirect()->route('dashboard')->with('success', 'Welkom terug ' . $name . '!');
        }else{
            return redirect()->route('login')->with('error', 'Combinatie is niet correct!');
        }
    }

    public function logout()
    {
        Auth::logout();

        Session::forget('sudosu.original_id');
        Session::forget('sudosu.has_sudoed');

        return redirect()->route('login')->with('error', 'U bent uitgelogd!');
    }
}

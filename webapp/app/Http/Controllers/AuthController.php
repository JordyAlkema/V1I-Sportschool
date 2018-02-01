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
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function loginView()
    {
        if(Auth::check() && !session('error')){
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();

        Session::forget('sudosu.original_id');
        Session::forget('sudosu.has_sudoed');

        return redirect()->route('login')->with('error', 'U bent uitgelogd!');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registerView()
    {
        return view('register');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $gebruiker = new Gebruiker();
        $gebruiker->email = $request['email'];
        $gebruiker->wachtwoord = Hash::make($request['password']);
        $gebruiker->rol_id = 1;
        $gebruiker->pasnummer = rand(10000000000, 99999999999);
        $gebruiker->save();

        Auth::login($gebruiker);

        return redirect()->route('dashboard')->with('success', "Welkom bij sportschool Benno's!");
    }
}

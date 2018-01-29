<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\Gebruiker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function profileView()
    {
        $gebruiker = Auth::user();
        return view('dashboard.pages.user')->with('gebruiker', $gebruiker);
    }

    public function profileUpdate(UserUpdateRequest $request)
    {
        $gebruiker = Gebruiker::find(Auth::id());

        $gebruiker['voornaam'] = $request['voornaam'];
        $gebruiker['tussenvoegsel'] = $request['tussenvoegsel'];
        $gebruiker['achternaam'] = $request['achternaam'];
        $gebruiker['email'] = $request['email'];
        $gebruiker['geboortedatum'] = $request['geboortedatum'];

        $gebruiker->save();

        return redirect()->route('dashboard')->with('success','Profiel is opgeslagen!');
    }
}

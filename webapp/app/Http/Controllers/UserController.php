<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\Gebruiker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @return $this
     */
    public function profileView()
    {
        $gebruiker = Auth::user();
        return view('dashboard.pages.user')->with('gebruiker', $gebruiker);
    }

    /**
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * @param UserUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profileUpdateMedewerker(UserUpdateRequest $request, $id)
    {
        $gebruiker = Gebruiker::find($id);

        $gebruiker['voornaam'] = $request['voornaam'];
        $gebruiker['tussenvoegsel'] = $request['tussenvoegsel'];
        $gebruiker['achternaam'] = $request['achternaam'];
        $gebruiker['email'] = $request['email'];
        $gebruiker['geboortedatum'] = $request['geboortedatum'];

        $gebruiker->save();

        return redirect()->route('medewerker.dashboard')->with('success','Profiel is opgeslagen!');
    }

    /**
     * @return $this
     */
    public function profileViewMedewerker()
    {
        $gebruiker = Auth::user();
        return view('dashboard.pages.medewerker.self')->with('gebruiker', $gebruiker);
    }
}

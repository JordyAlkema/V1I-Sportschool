<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMessageRequest;
use App\Models\Afspraak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalCoachController extends Controller
{
    //
    public function sendMessage(SendMessageRequest $request)
    {
        $user = Auth::user();
        $afspraak = new Afspraak();

        $afspraak->bericht = $request['message'];
        $afspraak->user_id = $user['id'];
        $afspraak->medewerker_id = $request->medewerker;
        $afspraak->email_verstuurd = null;

        $afspraak->save();

        return redirect()->route('dashboard')->with('success','Bericht naar personal coach is verstuurd!');

    }
}

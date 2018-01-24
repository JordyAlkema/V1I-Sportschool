<?php

namespace App\Http\Controllers;

use App\Models\Activiteiten;
use App\Models\Gebruiker;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function checkIn(Request $request, $user, $automaat)
    {
        
    }

    public function checkOut(Request $request, $user, $automaat)
    {
        
    }

    public function user(Request $request)
    {
        $cardnummer = $request['cardnummer'];
        $user = Gebruiker::where('pasnummer', $cardnummer)->first();

        if(!isset($user)){
            return response('', 404);
        }

        $activeActiviteit = Activiteiten::where('user_id', $user->id)
            ->where('eind_datum', null)
            ->first();

        $response = [
            'user' => $user,
            'activeActiviteit' => $activeActiviteit
        ];

        return response($response);
    }
}

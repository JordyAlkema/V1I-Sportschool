<?php

namespace App\Http\Controllers;

use App\Models\Activiteiten;
use App\Models\Automaat;
use App\Models\Gebruiker;
use App\Models\Transactie;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Requests\CheckRequest;

class ApiController extends Controller
{
    /**
     * @param CheckRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function checkIn(CheckRequest $request)
    {
        $user = Gebruiker::find($request['user_id']);
        $automaat = Automaat::where('api_key', $request['api_key'])->first();

        $activeActiviteit = Activiteiten::where('user_id', $user->id)
            ->where('eind_datum', null)
            ->first();

        if($user->balance < 4){
            return response('The users balance is too low', 410);
        }

        if($activeActiviteit){
            return response('User is already checked in', 409);
        }

        if(isset($automaat)) {
            $activiteit = new Activiteiten();

            $activiteit->user_id = $user->id;
            $activiteit->automaat_id = $automaat->id;
            $activiteit->begin_datum = Carbon::now();

            $activiteit->save();

            return response('', 200);
        }else{
            return response('Invalid API key', 403);
        }
    }

    /**
     * @param CheckRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function checkOut(CheckRequest $request)
    {
        $user = Gebruiker::find($request['user_id']);
        $automaat = Automaat::where('api_key', $request['api_key'])->first();

        if(!isset($automaat)){
            return response('Invalid API key', 403);
        }

        $activiteit = Activiteiten::where('user_id', $user->id)
            ->where('automaat_id', $automaat->id)
            ->where('eind_datum', null)->first();

        if(isset($activiteit)){
            $activiteit->eind_datum = Carbon::now();
            $activiteit->save();

            $price = $activiteit->begin_datum->diffInMinutes($activiteit->eind_datum) * $automaat->bedrag_per_minuut;


            if(!$user->abonnement){
                $transactie = new Transactie();

                $transactie->user_id = $user->id;
                $transactie->transactieType_id = 1;
                $transactie->bedrag = $price;
                $transactie->datum = Carbon::now();
                $transactie->activiteit_id = $activiteit->id;

                $transactie->save();
            }

            return response('', 200);
        }else{
            return response('No activity to check out', 404);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function user(Request $request)
    {
        $cardnummer = $request['cardnumber'];
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

    /**
     * @return array
     */
    public function trafficIndicator()
    {
        $activiteiten  = Activiteiten::where('eind_datum', null)->get();

        $peopleActive = ($activiteiten);

        if($peopleActive == 0){
            $color = 'green';
        }elseif($peopleActive == 1){
            $color = 'orange';
        }else{
            $color = 'red';
        }

        return [
          'indicator' => $color
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Models\GebruikerAbonnement;
use App\Models\Transactie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    //
    public function addBalance($add)
    {
        $user = Auth::user();
        $transaction = new Transactie();

        $transaction['user_id'] = $user['id'];
        $transaction['transactieType_id'] = 2;
        $transaction['bedrag'] = $add;
        $transaction['datum'] = Carbon::now();

        $transaction->save();

        return redirect()->route('dashboard')->with('success', $add . ' Euro is bijgeschreven');
    }

    public function BuyAbonnement($id)
    {
        $user = Auth::user();
        $abonnement = Abonnement::find($id);

        if($user->balance > $abonnement->prijs){

            $transactie = new Transactie();
            $transactie->user_id = $user->id;
            $transactie->transactieType_id = 1;
            $transactie->bedrag = -$abonnement->prijs;
            $transactie->datum = Carbon::now();
            $transactie->save();

            $newAbonnement = new GebruikerAbonnement();
            $newAbonnement->gebruiker_id = $user->id;
            $newAbonnement->abonnement_id = $abonnement->id;

            $abonnementenGebruiker = GebruikerAbonnement::where('gebruiker_id', $user->id)
                                        ->orderby('eind_datum', 'DESC')
                                        ->first();

            if($user->abonnement){
                $newAbonnement->begin_datum = $abonnementenGebruiker->eind_datum->addDay();
                $newAbonnement->eind_datum = $newAbonnement->begin_datum->addMonth($abonnement->aantal_maanden);

                $newAbonnement->save();

                return redirect()->route('dashboard')->with('success','Abonnement is gekocht en gaat in nadat het huidige abonnement is verlopen');
            }else{
                $newAbonnement->begin_datum = Carbon::now();
                $newAbonnement->eind_datum = Carbon::now()->addMonth($abonnement->aantal_maanden);

                $newAbonnement->save();

                return redirect()->route('dashboard')->with('success','Abonnement is gekocht en gaat nu in');
            }

        }else{
            return redirect()->route('dashboard')->with('error','U heeft niet genoeg geld op uw kaart om dit abonnement te kopen.');
        }
        
    }
}

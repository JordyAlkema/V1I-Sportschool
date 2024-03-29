<?php

namespace App\Http\Controllers;

use App\Models\Activiteiten;
use App\Models\Gebruiker;
use App\Models\Transactie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * @return $this
     */
    public function homeView()
    {
        $gebruiker = Auth::user();

        $transacties = Transactie::where('user_id', $gebruiker['id'])->orderby('datum', 'DESC')->limit(3)->get();
        $activiteiten = Activiteiten::where('user_id', $gebruiker['id'])->orderby('begin_datum', 'DESC')->limit(3)->get();
        $latestTransaction = Transactie::where('user_id', $gebruiker['id'])->orderby('datum', 'DESC')->first();

        $motivation = [
            'Goed bezig ga zo door!',
            'Kom je morgen weer?',
            'Je hebt vandaag '. $gebruiker->kcalToday .' kcal verbrand.'
        ];

        $motivation = $motivation[array_rand($motivation)];

        if($latestTransaction){
            $latestTransaction = $latestTransaction->datum->toDateString();
        }else{
            $latestTransaction = '';
        }

        return view('dashboard.pages.home')
            ->with('user', $gebruiker)
            ->with('transacties', $transacties)
            ->with('activiteiten', $activiteiten)
            ->with('motivation', $motivation)
            ->with('latestTransaction', $latestTransaction);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homeViewMedewerker()
    {
        return view('dashboard.pages.medewerker.home');
    }

    /**
     * @return $this
     */
    public function gebruikersViewMedewerker()
    {
        $gebruikers = Gebruiker::where('rol_id', 1)
                        ->get();

        return view('dashboard.pages.medewerker.users')
            ->with('gebruikers', $gebruikers);
    }

    /**
     * @return $this
     */
    public function gymCardView()
    {
        $gebruiker = Auth::user();

        $latestTransaction = Transactie::where('user_id', $gebruiker['id'])->orderby('datum', 'DESC')->first();

        if($latestTransaction){
            $latestTransaction = $latestTransaction->datum->toDateString();
        }else{
            $latestTransaction = '';
        }

        return view('dashboard.pages.gymcard')
            ->with('user', Auth::user())
            ->with('latestTransaction', $latestTransaction);
    }

    /**
     * @return $this
     */
    public function activitiesView()
    {
        $gebruiker = Auth::user();
        $activiteiten = Activiteiten::where('user_id', $gebruiker['id'])->orderby('begin_datum', 'DESC')->get();

        return view('dashboard.pages.activities')->with('activiteiten', $activiteiten);
    }

    /**
     * @return $this
     */
    public function transactionsView()
    {
        $gebruiker = Auth::user();
        $transacties = Transactie::where('user_id', $gebruiker['id'])->orderby('datum', 'DESC')->get();

        return view('dashboard.pages.transactions')->with('transacties', $transacties);
    }

    /**
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function activityTransaction($id)
    {
        $gebruiker = Auth::user();
        $transaction = Transactie::where('id', $id)->first();

        if(!$transaction or $transaction['user_id'] != $gebruiker['id']){
            return redirect()->route('dashboard');
        }

        return view('dashboard.pages.ActivityTransaction')->with('transaction', $transaction);

    }

    /**
     * @return $this
     */
    public function personalCoachView()
    {
        $medewerkers = Gebruiker::where('rol_id', 2)
                                ->get();

        return view('dashboard.pages.contactPersonalCoach')
            ->with('medewerkers', $medewerkers);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function locationsView()
    {
        return view('dashboard.pages.locations');
    }

    /**
     * @param $id
     * @return $this
     */
    public function gebruikerViewMedewerker($id)
    {
        $gebruiker = Gebruiker::find($id);

        return view('dashboard.pages.medewerker.user')->with('gebruiker', $gebruiker);

    }
}

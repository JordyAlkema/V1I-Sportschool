<?php

namespace App\Http\Controllers;

use App\Models\Activiteiten;
use App\Models\Transactie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function homeView()
    {
        $gebruiker = Auth::user();

        $transacties = Transactie::where('user_id', $gebruiker['id'])->orderby('datum', 'DESC')->limit(3)->get();
        $activiteiten = Activiteiten::where('user_id', $gebruiker['id'])->orderby('begin_datum', 'DESC')->limit(3)->get();
        $latestTransaction = Transactie::where('user_id', $gebruiker['id'])->orderby('datum', 'DESC')->first();

        if($latestTransaction){
            $latestTransaction = $latestTransaction->datum->toDateString();
        }else{
            $latestTransaction = '';
        }

        return view('dashboard.pages.home')
            ->with('user', $gebruiker)
            ->with('transacties', $transacties)
            ->with('activiteiten', $activiteiten)
            ->with('latestTransaction', $latestTransaction);
    }

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

    public function activitiesView()
    {
        $gebruiker = Auth::user();
        $activiteiten = Activiteiten::where('user_id', $gebruiker['id'])->orderby('begin_datum', 'DESC')->get();

        return view('dashboard.pages.activities')->with('activiteiten', $activiteiten);
    }

    public function transactionsView()
    {
        $gebruiker = Auth::user();
        $transacties = Transactie::where('user_id', $gebruiker['id'])->orderby('datum', 'DESC')->get();

        return view('dashboard.pages.transactions')->with('transacties', $transacties);
    }

    public function activityTransaction($id)
    {
        $gebruiker = Auth::user();
        $transaction = Transactie::where('id', $id)->first();

        if(!$transaction or $transaction['user_id'] != $gebruiker['id']){
            return redirect()->route('dashboard');
        }

        return view('dashboard.pages.ActivityTransaction')->with('transaction', $transaction);

    }

    public function personalCoachView()
    {
        return view('dashboard.pages.contactPersonalCoach');
    }

    public function locationsView()
    {
        return view('dashboard.pages.locations');
    }
}

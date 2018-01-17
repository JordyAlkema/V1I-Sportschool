<?php

namespace App\Http\Controllers;

use App\Models\Activiteiten;
use App\Models\Transactie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function homeView()
    {
        $gebruiker = Auth::user();

        $transacties = Transactie::where('user_id', $gebruiker['id'])->orderby('datum')->limit(3)->get();
        $activiteiten = Activiteiten::where('user_id', $gebruiker['id'])->orderby('begin_datum')->limit(3)->get();

        return view('dashboard.pages.home')
            ->with('user', $gebruiker)
            ->with('transacties', $transacties)
            ->with('activiteiten', $activiteiten);
    }

    public function gymCardView()
    {
        return view('dashboard.pages.gymcard')->with('user', Auth::user());
    }
}

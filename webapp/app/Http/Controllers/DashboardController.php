<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function homeView()
    {
        return view('dashboard.pages.home')->with('user', Auth::user());
    }

    public function gymCardView()
    {
        return view('dashboard.pages.gymcard')->with('user', Auth::user());
    }
}
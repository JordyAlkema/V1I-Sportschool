<?php

namespace App\Http\Controllers;

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

    public function profileUpdate()
    {
        
    }
}

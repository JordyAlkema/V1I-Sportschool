<?php

namespace App\Http\Controllers;

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
}

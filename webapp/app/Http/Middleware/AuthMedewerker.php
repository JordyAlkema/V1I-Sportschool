<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthMedewerker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            $user = Auth::user();

            if($user->rol->beheerder == 1){
                return $next($request);
            }else{
                return redirect()->route('loginView')->with('error', 'U bent een gebruiker, ga AUB naar het gebruiker paneel.');
            }
        }else{
            return redirect()->route('loginView')->with('error', 'Je moet ingelogd zijn om dit te mogen doen');
        }

    }
}

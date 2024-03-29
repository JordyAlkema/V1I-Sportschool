<?php

namespace App\Http\Middleware;

use App\Models\Rol;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthGebruiker
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

            if($user->rol->beheerder == 0){
                return $next($request);
            }else{
                return redirect()->route('loginView')->with('error', 'U bent een medewerker, ga AUB naar het medewerker paneel.');
            }
        }else{
            return redirect()->route('loginView')->with('error', 'Je moet ingelogd zijn om dit te mogen doen');
        }

    }
}

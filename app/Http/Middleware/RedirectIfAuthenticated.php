<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // dd($request);                       //Request{}
        // dd($guard);                         //null
        // dd(Auth::guard($guard));            //SessionGuard{}の中にrequest: Request{}入ってる
        // dd(Auth::guard($guard)->check());   //false
        if (Auth::guard($guard)->check()) {    //ログイン済みの人を弾いている　ログイン済みならtrueでhome行き 
            return redirect('/home');
        }
        
        // dd($next);                            //Closure($passable) {#183 ▶}
        // dd($next($request));                  //Response {#236 ▶}
        return $next($request);
    }
}

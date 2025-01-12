<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

<<<<<<<< HEAD:app/Http/Middleware/User/UserMiddleware.php
class UserMiddleware
========
class AdminMiddleware
>>>>>>>> master:app/Http/Middleware/AdminMiddleware.php
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && Auth::user()->role == 1){
            return $next($request);
<<<<<<<< HEAD:app/Http/Middleware/User/UserMiddleware.php
        }else{
            return redirect()->route('auth.index');
        }
========
        }
        return redirect()->route('auth.index');
       
>>>>>>>> master:app/Http/Middleware/AdminMiddleware.php
    }
}

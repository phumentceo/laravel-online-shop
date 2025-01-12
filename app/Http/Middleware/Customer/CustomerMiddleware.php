<?php

<<<<<<<< HEAD:app/Http/Middleware/Admin/AdminMiddleware.php
namespace App\Http\Middleware\Admin;
========
namespace App\Http\Middleware\Customer;
>>>>>>>> master:app/Http/Middleware/Customer/CustomerMiddleware.php

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

<<<<<<<< HEAD:app/Http/Middleware/Admin/AdminMiddleware.php
class AdminMiddleware
========
class CustomerMiddleware
>>>>>>>> master:app/Http/Middleware/Customer/CustomerMiddleware.php
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
<<<<<<<< HEAD:app/Http/Middleware/Admin/AdminMiddleware.php
        if(Auth::check() && Auth::user()->role == 1){
========
        if(Auth::check() && Auth::user()->role == 2){
>>>>>>>> master:app/Http/Middleware/Customer/CustomerMiddleware.php
            return $next($request);
        }
        return redirect()->route('customer.login');
    }
}

<?php
<<<<<<< HEAD

use App\Http\Middleware\Admin\AdminMiddleware;
use App\Http\Middleware\Admin\AdminRedirect;
=======
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AdminMiddlewareRedirect;
use App\Http\Middleware\Customer\CustomerMiddleware;
use App\Http\Middleware\Customer\CustomerRedirect;
>>>>>>> master
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Router;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        function (Router $router){
          $router->middleware('web')->group(base_path('routes/admin.php'));
          $router->middleware('web')->group(base_path('routes/front.php'));  
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
<<<<<<< HEAD
        $middleware->alias([
            'guest.admin' => AdminRedirect::class,
            'auth.admin'  => AdminMiddleware::class
        ]);
=======
          $middleware->alias([
            'guest.admin' => AdminMiddlewareRedirect::class,
            'auth.admin'  => AdminMiddleware::class,
            'guest.customer' => CustomerRedirect::class,
            'auth.customer'  => CustomerMiddleware::class
          ]);
>>>>>>> master
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

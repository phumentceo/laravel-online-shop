<?php

use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class,'homePage'])->name('home.index');

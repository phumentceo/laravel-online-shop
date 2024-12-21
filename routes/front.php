<?php

use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class,'homePage'])->name('home.index');
Route::get('/product/view',[HomeController::class,'viewProduct'])->name('product.view');
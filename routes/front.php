<?php

use App\Http\Controllers\Front\CustomerAuthController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\SingleProductController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class,'homePage'])->name('home.index');
Route::get('/product/shop/{id}',[HomeController::class,'productCategory'])->name('product.category');
Route::get('/product/view',[HomeController::class,'viewProduct'])->name('product.view');
Route::get('/product/single/{id}',[SingleProductController::class,'singleProduct'])->name('product.single');



//Customer Auth 
Route::middleware('guest.customer')->group(function(){
    Route::get('/login',[CustomerAuthController::class,'loginShow'])->name('customer.login');
});
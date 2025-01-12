<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Front\CustomerAuthController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\SingleProductController;
use Illuminate\Support\Facades\Route;




//Customer Auth 
Route::middleware('guest.customer')->group(function(){

    Route::get('/login',[CustomerAuthController::class,'loginShow'])->name('customer.login');
    Route::post('/login/process',[CustomerAuthController::class,'loginProcess'])->name('customer.login.process');
    Route::get('/register',[CustomerAuthController::class,'registerShow'])->name('customer.register');
    Route::post('/register/process',[CustomerAuthController::class,'registerProcess'])->name('customer.register.process');

    Route::get('/',[HomeController::class,'homePage'])->name('home.index');
    Route::get('/product/shop/{id}',[HomeController::class,'productCategory'])->name('product.category');
    Route::get('/product/view',[HomeController::class,'viewProduct'])->name('product.view');
    Route::get('/product/single/{id}',[SingleProductController::class,'singleProduct'])->name('product.single');

    Route::get('/send',[CustomerAuthController::class,'sendEmail'])->name('send.emai.show');
    Route::post('/send/process',[CustomerAuthController::class,'sendEmailProcess'])->name('send.email.process');

    Route::get('/verify/{token}',[CustomerAuthController::class,'codeVerify'])->name('code.verify');

    Route::post('/verify/process',[CustomerAuthController::class,'codeVerifyProcess'])->name('code.verify.process');

    Route::get('/reset/{code}/{token}',[CustomerAuthController::class,'resetPassword'])->name('reset.password.show');


    Route::post('/reset/proccess',[CustomerAuthController::class,'resetPasswordProcess'])->name('reset.password.process');
    

});


Route::middleware('auth.customer')->group(function(){


    //router of cart
    Route::name('cart.')->group(function () {
        // Display the cart
        Route::get('/cart', [CartController::class, 'index'])->name('index');
    
        // Add item to the cart
        Route::post('/cart/add', [CartController::class, 'add'])->name('add');
    
        // Update item quantity in the cart
        Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('update');
    
        // Remove item from the cart
        Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('remove');
    
        // Clear the entire cart
        Route::post('/cart/clear', [CartController::class, 'clear'])->name('clear');
        
    });


});
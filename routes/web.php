<?php

use App\Http\Controllers\Dashboard\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Dashboard\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ColorController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ImageController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware('guest.admin')->group(function(){
        Route::get('/',[AdminAuthController::class,'login'])->name('login.show');
        Route::post('/login',[AdminAuthController::class,'authenticate'])->name('login.process');
    });

    Route::middleware('auth.admin')->group(function(){

        #-----Dashboard Router start---------
        Route::get('/dashboard',[AdminDashboardController::class,'index'])->name('dashboard.index');
        #-----Dashboard Router end-----------

        #-----------User Routers start----------
        Route::get("/user",[UserController::class,'index'])->name("user.index");
        Route::post("/user/list",[UserController::class,'list'])->name("user.list");
        Route::post("/user/store",[UserController::class,'store'])->name("user.store");
        Route::post("/user/destory",[UserController::class,'destory'])->name("user.destory");
        #-----------User Routers end----------

        #--------Profile Routers start-----------
        Route::get('/profile',[ProfileController::class,'index'])->name('profile.index');
        Route::post('/profile/change/password',[ProfileController::class,'changePassword'])->name('profile.change.password');
        Route::post('/profile/update',[ProfileController::class,'updateProfile'])->name('profile.update');
        Route::post('/profile/change/image',[ProfileController::class,'changeProfileImage'])->name('profile.change.image');

        //Image Routers
        Route::post('/product/upload',[ImageController::class,'uploads'])->name('product.uploads');
        Route::post('/product/cancel',[ImageController::class,'cancel'])->name('product.cancel');

        #--------Profile Routers end-----------

        #-------Logout start------------
        Route::get('/logout',[AuthController::class,'logout'])->name('auth.logout');
        #-------Logout end--------------

    });


});

Route::prefix('user')->group(function(){

    Route::middleware('guest.user')->group(function(){
        Route::get('/',[AuthController::class,'login'])->name('user.login.show');
        Route::post('/login',[AuthController::class,'authenticate'])->name('user.login.process');
    });

    Route::middleware('auth.user')->group(function(){

        #---------Category Routers start---------------
        Route::get("/category",[CategoryController::class,'index'])->name("category.index");
        Route::post("/category/list",[CategoryController::class,'list'])->name("category.list");
        Route::post("/category/store",[CategoryController::class,'store'])->name("category.store");
        Route::post("/category/edit",[CategoryController::class,'edit'])->name("category.edit");
        Route::post("/category/update",[CategoryController::class,'update'])->name("category.update");
        Route::post("/category/destroy",[CategoryController::class,'destroy'])->name("category.destroy");
        Route::post("/category/upload",[CategoryController::class,'upload'])->name('category.upload');
        Route::post("/category/cancel",[CategoryController::class,'cancel'])->name('category.cancel');
        #---------Category Routers end---------------


        #------------Brand Routers start---------------
        Route::get("/brand",[BrandController::class,'index'])->name("brand.index");
        Route::post("/brand/list",[BrandController::class,'list'])->name("brand.list");
        Route::post("/brand/store",[BrandController::class,'store'])->name("brand.store");
        Route::post("/brand/edit",[BrandController::class,'edit'])->name("brand.edit");
        Route::post("/brand/update",[BrandController::class,'update'])->name("brand.update");
        Route::post("/brand/destroy",[BrandController::class,'destroy'])->name("brand.destroy");
        #-----------Brand Router end ------------------

        #---------------Color Routers start-------------
        Route::get("/color",[ColorController::class,'index'])->name("color.index");
        Route::post("/color/list",[ColorController::class,'list'])->name("color.list");
        Route::post("/color/store",[ColorController::class,'store'])->name("color.store");
        Route::post("/color/edit",[ColorController::class,'edit'])->name("color.edit");
        Route::post("/color/update",[ColorController::class,'update'])->name("color.update");
        Route::post("/color/destroy",[ColorController::class,'destroy'])->name("color.destroy");
        #---------------Color Routers end-------------

        #-----------Product Routers start--------------
        Route::get("/product",[ProductController::class,'index'])->name("product.index");
        Route::post("/product/list",[ProductController::class,'list'])->name("product.list");
        Route::post("/product/store",[ProductController::class,'store'])->name("product.store");
        Route::post('/product/data',[ProductController::class,'data'])->name('product.data');
        Route::post("/product/edit",[ProductController::class,'edit'])->name("product.edit");
        Route::post("/product/update",[ProductController::class,'update'])->name("product.update");
        Route::post("/product/destroy",[ProductController::class,'destroy'])->name("product.destroy");
        #-----------Product Routers end--------------


        #--------Profile Routers start-----------
        Route::get('/profile',[ProfileController::class,'index'])->name('profile.index');
        Route::post('/profile/change/password',[ProfileController::class,'changePassword'])->name('profile.change.password');
        Route::post('/profile/update',[ProfileController::class,'updateProfile'])->name('profile.update');
        Route::post('/profile/change/image',[ProfileController::class,'changeProfileImage'])->name('profile.change.image');

        //Image Routers
        Route::post('/product/upload',[ImageController::class,'uploads'])->name('product.uploads');
        Route::post('/product/cancel',[ImageController::class,'cancel'])->name('product.cancel');
        #--------Profile Routers end-----------

        #-------Logout start------------
        Route::get('/logout',[AuthController::class,'logout'])->name('auth.logout');
        #-------Logout end--------------
    });
});

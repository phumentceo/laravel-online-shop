<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;



//User Routers
Route::get("/user",[UserController::class,'index'])->name("user.index");
Route::post("/user/list",[UserController::class,'list'])->name("user.list");
Route::post("/user/store",[UserController::class,'store'])->name("user.store");
Route::post("/user/destory",[UserController::class,'destory'])->name("user.destory");


//Category Routers
Route::get("/category",[CategoryController::class,'index'])->name("category.index");
Route::post("/category/list",[CategoryController::class,'list'])->name("category.list");
Route::post("/category/store",[CategoryController::class,'store'])->name("category.store");
Route::post("/category/edit/{id}",[CategoryController::class,'edit'])->name("category.edit");
Route::post("/category/update",[CategoryController::class,'update'])->name("category.update");
Route::post("/category/destory",[CategoryController::class,'destory'])->name("category.destory");
Route::post("/category/upload",[CategoryController::class,'upload'])->name('category.upload');
Route::post("/category/cancel",[CategoryController::class,'cancel'])->name('category.cancel');

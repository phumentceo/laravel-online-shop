<?php
use Illuminate\Support\Facades\Route;
Route::get('/front',function(){
    return view('front-end.index');
});


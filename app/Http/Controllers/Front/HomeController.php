<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homePage(){

        // Get latest 3 categories
        $categories = Category::limit(3)->get();


        $data['categories'] = $categories;

       

        // Load home page view with categories and products data
        return view('front-end.index',$data);

    }
}

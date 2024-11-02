<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploads(Request $request){

        if($request->hasFile('image')){

            $files = $request->file('image');

            $images = [];
            foreach($files as $file){
                $fileName = rand(0,999999999) .'.'. $file->getClientOriginalExtension();
                $images[] = $fileName;
                $file->move(public_path("uploads/temp"),$fileName);
            }

            return response([
                'status' => 200,
                'message' => 'Image uploaded successful',
                'images'  => $images,
            ]);

        }

        
    }
}

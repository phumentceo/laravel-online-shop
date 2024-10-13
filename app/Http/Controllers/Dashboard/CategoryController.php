<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
   
    public function index()
    {
        
        return view('back-end.category');

    }


    public function upload(Request $request){

        $validator = Validator::make($request->all(),[
            'image' =>'required'
        ]);

        if($validator->passes()){
            
            $file = $request->file('image');
               
            $imageName = rand(0,999999999) .'.'. $file->getClientOriginalExtension();
            $file->move('uploads/temp', $imageName);

            return response()->json([
                'status' => 200,
                'message' => 'Image Uploaded success',
                'image' => $imageName
            ]);
           
        }else{
            return response()->json([
                'status' => 500,
                'error' => $validator->errors(),
            ]);
        }

        

    }

    public function cancel(Request $request){
        if($request->image){
            $tempDir = public_path("uploads/temp/$request->image");
            if(File::exists($tempDir)){
                File::delete($tempDir);
                return response()->json([
                   'status' => 200,
                   'message' => 'Image Cancelled Successfully',
                ]);
            }
        }
    }
   
   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required'
        ]);

        if($validator->passes()){
            //store to db
            $category = new Category();
            $category->name = $request->name;
            $category->status = $request->status;

            $tempDir = public_path("uploads/temp/".$request->input('category-image'));
            $cateDir = public_path("uploads/category/".$request->input('category-image'));

            if(File::exists($tempDir)){
                File::copy($tempDir,$cateDir);
                File::delete($tempDir);
            }

            $category->save();

            return response([
                'status' => 200,
                'message' => "Category created successful"
            ]);
        }else{
            return response()->json([
               'status' => 500,
                'error' => $validator->errors(),
            ]);
        }

        
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

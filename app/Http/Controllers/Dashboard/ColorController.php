<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function index(){

        $colors = Color::orderBy("id","DESC")->get();
        return view('back-end.colors',compact('colors'));
    }

    public function list(Request $request){

        //pagination form
        $limit = 5;
        $page  = $request->page;  

        $offset = ($page - 1) * $limit;

        if(!empty($request->search)){
            $brands = Color::where('name','like','%'.$request->search.'%')
                            ->limit($limit)
                            ->offset($offset)
                            ->get();
            $totalRecord = Color::where('name','like','%'.$request->search.'%')->count();
        }else{
            $brands = Color::orderBy("id","DESC")
                            ->limit($limit)
                            ->offset($offset)
                            ->get();
            $totalRecord = Color::count();
        }

        
       
        //totalRecord 
         
        
        $totalPage   = ceil($totalRecord / 5);  // 2.1 => 3

        return response([
            'status' => 200,
            'page' => [
                'totalRecord' => $totalRecord,
                'totalPage'  => $totalPage,
                'currentPage' => $page,
            ],
            'colors' => $brands
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:colors,name'
        ]);

        if($validator->passes()){
            $color = new Color();
            $color->name = $request->name;
            $color->color_code = $request->color_code;
            $color->status = $request->status;
            $color->save();

            return response([
                'status' => 200,
                'message' => "Brand created successful"
            ]);

        }else{
            return response()->json([
                'status' => 500,
                'error' => $validator->errors(),
            ]);
        }
    }


    public function edit(){

    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:brands,name,'.$request->color_id,
        ]);

        if($validator->passes()){
            $color = Color::find($request->color_id);

            //checking brand not found
            if($color == null){
                return response([
                   'status' => 404,
                   'message' => "color not found with id "+$request->color_id
                ]);
            }

            $color->name = $request->name;
            $color->color_code = $request->color_code;
            $color->status = $request->status;
            $color->save();

            return response([
                'status' => 200,
                'message' => "Color updated successful"
            ]);

        }else{
            return response()->json([
                'status' => 500,
                'error' => $validator->errors(),
            ]);
        }
    }

    public function destroy(Request $request){
        $color = Color::find($request->id);

        //checking brand not found
        if($color == null){
            return response([
               'status' => 404,
               'message' => "Color not found with id "+$request->id
            ]);
        }else{
            $color->delete();
            return response([
               'status' => 200,
               'message' => "Color deleted successful",
            ]);
        }

        
    }
}

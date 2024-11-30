<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
<<<<<<< HEAD
    public function index(){

        $colors = Color::orderBy("id","DESC")->get();
        return view('back-end.colors',compact('colors'));
    }

=======
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back-end.color');
    }


>>>>>>> master
    public function list(Request $request){

        //pagination form
        $limit = 5;
<<<<<<< HEAD
        $page  = $request->page;  
=======
        $page  = $request->page;  //2
>>>>>>> master

        $offset = ($page - 1) * $limit;

        if(!empty($request->search)){
<<<<<<< HEAD
            $brands = Color::where('name','like','%'.$request->search.'%')
=======
            $colors = Color::where('name','like','%'.$request->search.'%')
                            ->orderBy("id","DESC")
>>>>>>> master
                            ->limit($limit)
                            ->offset($offset)
                            ->get();
            $totalRecord = Color::where('name','like','%'.$request->search.'%')->count();
        }else{
<<<<<<< HEAD
            $brands = Color::orderBy("id","DESC")
=======
            $colors = Color::orderBy("id","DESC")
>>>>>>> master
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
<<<<<<< HEAD
            'colors' => $brands
        ]);
    }

    public function store(Request $request){
=======
            'colors' => $colors
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
>>>>>>> master
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:colors,name'
        ]);

        if($validator->passes()){
            $color = new Color();
            $color->name = $request->name;
<<<<<<< HEAD
            $color->color_code = $request->color_code;
=======
            $color->color_code = $request->color;
>>>>>>> master
            $color->status = $request->status;
            $color->save();

            return response([
                'status' => 200,
<<<<<<< HEAD
                'message' => "Brand created successful"
=======
                'message' => "Color created successful"
>>>>>>> master
            ]);

        }else{
            return response()->json([
                'status' => 500,
                'error' => $validator->errors(),
            ]);
        }
    }

<<<<<<< HEAD

    public function edit(){

    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:brands,name,'.$request->color_id,
=======
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:colors,name,'.$request->color_id,
>>>>>>> master
        ]);

        if($validator->passes()){
            $color = Color::find($request->color_id);

<<<<<<< HEAD
            //checking brand not found
            if($color == null){
                return response([
                   'status' => 404,
                   'message' => "color not found with id "+$request->color_id
=======
            //checking color not found
            if($color == null){
                return response([
                   'status' => 404,
                   'message' => "Color not found with id "+$request->color_id
>>>>>>> master
                ]);
            }

            $color->name = $request->name;
<<<<<<< HEAD
            $color->color_code = $request->color_code;
=======
            $color->color_code = $request->color;
>>>>>>> master
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

<<<<<<< HEAD
    public function destroy(Request $request){
        $color = Color::find($request->id);

        //checking brand not found
=======
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $color = Color::find($request->id);

        //checking color not found
>>>>>>> master
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
<<<<<<< HEAD

        
=======
>>>>>>> master
    }
}

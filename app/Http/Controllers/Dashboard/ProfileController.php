<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){

        $user = User::find(Auth::user()->id);
        return view('back-end.profile',[
            'user' => $user
        ]);
    }

    public function changePassword(Request $request){
       

        $validator = Validator::make($request->all(),[
            'current_pass' => 'required',
            'new_pass'    => 'required',
            'c_password' => 'required|same:new_pass'
        ]);


        session()->flash('password');
        

        if($validator->passes()){
            $current_password = $request->current_pass;
            $user = User::find(Auth::user()->id);
            if(password_verify($current_password, $user->password)){
                $user->password =  Hash::make($request->new_pass);
                $user->save();
                session()->flash('success', 'Password changed successfully.');
                return redirect()->back();
            }
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    public function updateProfile(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users,email,'.Auth::user()->id],
            'phone' => ['required','string','max:20','unique:users,phone,'.Auth::user()->id],
        ]);

        session()->flash('profile');

        if($validator->passes()){
            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;


            if(!empty($request->image_name)){
                $imageName = $request->image_name;
                $image_path = public_path('uploads/temp/'.$imageName);
                $user_path  = public_path('uploads/user/'.$imageName);
                if(File::exists($image_path)){
                    File::copy($image_path,$user_path);
                    File::delete($image_path);
                }

                $user->image = $imageName;
            }

            $user->save();

            return redirect()->back()->with('success','Profile update successfully.');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    public function changeProfileImage(Request $request){
       
        session()->flash('profile');

        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $image->move("uploads/temp/", $name);

            return response([
                'status' => 200,
                'image' => $name,
                'message' => 'Image uploaded successfully.'
            ]);
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Failed to upload image.'
            ]);
        }

        



    }
}

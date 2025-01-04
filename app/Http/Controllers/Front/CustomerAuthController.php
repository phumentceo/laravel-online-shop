<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    public function loginShow(){
        return view('front-end.auth.login');
    }

    public function loginProcess(Request $request){
        // Validate the request data
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password],$request->filled('remember_me'))){
            return redirect()->route('home.index'); 
        }

        return redirect()->back()->with('error', 'Invalid email or password');
    }

    public function registerShow(){
        return view('front-end.auth.register');
    }

    public function registerProcess(Request $request){

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|min:9|unique:users,phone',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
        ]);

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone'   => $request->phone,
            'role'    => 2
        ]);

        return redirect()->route('customer.login')->with('success', 'Account created successfully!');

    }


    public function sendEmail(){
        return view('front-end.auth.send-email');
    }

    public function sendEmailProcess(Request $request){
        // Validate the request data
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Send email to user
        

        return redirect()->route('customer.login')->with('success', 'Email sent successfully!');
    }

}

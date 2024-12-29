<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    public function loginShow(){
        return view('front-end.auth.login');
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

}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\Customer\CustomerEmail;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $code = mt_rand(100000, 999999); // This generates a random 5-digit number
        $token = hash('sha256', random_bytes(30));
        
        PasswordResetToken::updateOrCreate(
            ['email' => $request->email],
            [
                     'token' => $token,
                     'code' => $code, 
                     'expires_at' => now()->addMinutes(20)
                    ]
        );

        $customer = User::where('email', $request->email)->first();


        $data = [
            'name' => $customer->name,
            'code' => $code,
            'token' => $token,
            'email' => $request->email
        ];
        

        Mail::to($request->email)->send(new CustomerEmail($data));
        

        return redirect()->route('code.verify',[
            'token' => $token
        ])->with('success','send code to email sucessful');
        

    }

    public function codeVerify(string $token){

        return view('front-end.auth.code-verify');
    }


    

}

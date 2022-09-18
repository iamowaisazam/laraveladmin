<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserEmailVerification;


class AuthController extends Controller
{

    /*
    * Show the profile for a given user.
    */
    public function login(Request $request)
    {
        if(Auth::check()){
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }


   /*
    * Show the profile for a given user.
    */
    public function login_submit(Request $request)
    {
        if(Auth::check()){
            return redirect()->route('admin.dashboard')->with('warning','You Are Already Logged in');
        }

         $request->validate([
            'email' => ['required','string','email','exists:users,email','min:3','max:100'],
            'password' => ['required','string','min:6','max:100'],
        ]);

        $user = User::where('email',$request->email)->first();
        if(Hash::check($request->password, $user->password)){
            if (Auth::attempt($request->only(['email','password']))) {
                return redirect()->route('admin.dashboard')->with('success','Logged in Successfully');
            }
        }

        return back()->withInput()->withErrors([
            'email' => 'Wrong Email Or Password',
            'password' => 'Wrong Email Or Password'
        ]);
    }



    /*
    * Show the profile for a given user.
    */
    public function register()
    {
        if(Auth::check()){
            return redirect()->route('admin.dashboard')->with('warning','You Are Already Logged in');
            
        }

        return view('admin.register');
    }


    /*
    * Show the profile for a given user.
    */
    public function register_submit(Request $request)
    {

        if(Auth::check()){
            return redirect()->route('admin.dashboard')->with('warning','You Are Already Logged in');
        }

        $request->validate([
            'name' => ['required','string','unique:users,name','min:3','max:100'],
            'email' => ['required','string','email','unique:users,email','min:3','max:100'],
            'password' => ['required','string','min:6','max:100'],
        ]);

         try {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified' => 1,
                'type' => 'guest',
            ]);

            return redirect()->route('admin.login')->with('success','Registeration Successfully');
            
        } catch (\Exception) {
            return back()->withInput()->withErrors([
                'name' => 'Registeration Failed',
                'email' => 'Registeration Failed',
                'password' => 'Registeration Failed'
            ]);
        }

    }


   /*
    * Show the profile for a given user.
    */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('success','Logged Out Successfully');
    }






    public function resend_email_verification($email)
    {
        $user = User::where('email',$email)->first();
        if($user == null){
             return response()->json([
                "message" => 'Email Not Found',
             ],401);
        }

        if($user->email_verified == 1){
            return response()->json([
               "message" => 'Email Already Verified',
            ],401);
        }

        $code =  rand(100000, 999999);
        $emailVerification = UserEmailVerification::create([
            'email' => $user->email,
            'token' => $code,
            'user_id' => $user->id
        ]);

        $data = [
            'email' => $user->email,
            'name' => $user->name,
            'verification_code' => $code,
            'verify_button' => route('auth.verify_email',['email' => $user->email,'token' => $code]),
        ];

        Mail::send('emails.emailVerification',$data,function ($mesage) use($data) {
            $mesage->from(env('MAIL_USERNAME'),env('MAIL_FROM_NAME')); 
            $mesage->to($data['email'],$data['name'])->subject('Email Verification');
        });

        return response()->json([
            "message" => 'Email Sent',
         ],200);  

    }








    public function verify_email($email,$token)
    {

        $user = User::where('email',$email)->first();
        if($user == null){
             return response()->json([
                "message" => 'Email Not Found',
             ],401);
        }

        if($user->email_verified == 1){
            return response()->json([
               "message" => 'Email Already Verified',
            ],401);
        }

        if($user->verification_email && $user->verification_email->token != $token){
            return response()->json([
                "message" => 'Verification Failed',
            ],401);
        }

        $user->verification_email->verified_at = Carbon::now()->toDateTimeString();
        $user->verification_email->save();
        $user->email_verified = 1;
        $user->save();

        return response()->json([
            "message" => 'Email Successfully Verified',
            "data"=> [
                "user_id" => $user->id,
            ]
        ],200);
    }


  




}
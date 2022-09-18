<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\UserEmailVerification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    
     /**
     * Show the profile for a given user.
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'title' => ['string','min:2','max:30'],
            'name' => ['required','string','unique:users,name','min:2','max:30'],
            'email' => ['required','string','email','unique:users,email','max:100'],
            'phone' => ['required','string','max:50'],
            'password' => ['required','min:6','string','max:50','required_with:password_confirmation','same:password_confirmation'],
            'password_confirmation' => ['required','min:6','max:50'],
            'image' => ['image','mimes:jpeg,png,jpg','max:2048'],
            'terms' => ['integer'],
            'notification' => ['integer'],
        ]);
        
        if($validator->fails()){
            return response()->json([
                "message" => "Validation Failed",
                "data" => ["validations" => $validator->messages()],
            ],403);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'title' => $request->has('title') ? $request->title : null,
            'phone' => $request->has('phone') ? $request->phone : null,
            'terms' => $request->has('terms') ? $request->terms : null,
            'notification' => $request->has('notification') ? $request->notification : null,
        ]);

        $token = $user->createToken('tokens')->plainTextToken;
        $code =  rand(100000, 999999);
        UserEmailVerification::create([
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
         "message" => 'User Created Successfully Please Check Your Email',
         "data" => [
              'token' => $token,   
           ]  
        ],200);

    }
    

}
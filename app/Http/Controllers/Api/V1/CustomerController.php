<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{

    /**
     * Show the profile for a given user.
     */
    public function list(Request $request)
    { 
        $data = User::query()->where('type','customer');
        if($request->has('search')){
            $search = $request->search;
            $data->where('name', 'like', '%'.$search.'%');
        }

        $data = $data->limit(5)->get();
        return response()->json([
           "message" => "Get All Customers Successfully",
           "data" =>  $data,
        ],200);
    }




    /**
     * Show the profile for a given user.
     */
    public function index(Request $request)
    { 
        $per_page = 10;
        $order_by = 'date';
        $assending = 'asc';
   
        $data = User::query()->where('type','customer');

        if($request->has('search')){
            $search = $request->search;
            $data->where('name', 'like', '%'.$search.'%')
            ->orWhere('email', 'like', '%'.$search.'%')
            ->orWhere('details', 'like', '%'.$search.'%')
            ->orWhere('country', 'like', '%'.$search.'%')
            ->orWhere('state', 'like', '%'.$search.'%')
            ->orWhere('city', 'like', '%'.$search.'%');
        }

        if($request->has('ascending')){
            $assending = $request->ascending;
        }

        if($request->has('order_by')){
            $order_by = $request->order_by;
        }

        if($request->has('per_page') && is_numeric($request->per_page)){
            $per_page = $request->per_page;
        }

        switch ($order_by) {

            case 'name':
                $data->orderBy('name',$assending);
                break;

            case 'date':
                $data->orderBy('created_at',$assending);
                break;

            case 'id':
                $data->orderBy('id',$assending);
                break;        

            default:

               $data->orderBy('created_at',$assending);
            break;
        }

        return response()->json([
            "message" => "Get All Customers Successfully",
            "data" =>  $data->paginate($per_page),
        ],200);
    }


    /*
     * Show the profile for a given user.
     */
    public function store(Request $request)
    {

    
        $validator = Validator::make($request->all(),[
            'name' => ['required','unique:users,name','string','max:100'],
            'email' =>['required','unique:users,email','max:100'],
            'password' => ['required','min:5'],
            'phone' => ['nullable','string','max:50'],
            'country' => ['nullable','string','max:50'],
            'state' => ['nullable','string','max:50'],
            'city' => ['nullable','string','max:50'],
            'zip_code' => ['nullable','string','max:30'],
            'details' => ['nullable','string','max:200'],
        ]);
        
        if($validator->fails()){
            return response()->json([
                "message" => "Validation Failed",
                "data" => ["validations" => $validator->messages()],
            ],403);
        }

        $customer = User::create([        
            "name" => $request->name,
            "email" =>  $request->email,
            'password' => Hash::make($request->password),
            'type' => 'customer',
            'email_verified' => 1,
            "phone" =>  $request->has('phone') ? $request->phone: null,
            "country" =>  $request->has('country') ? $request->country : null,
            "state" =>  $request->has('state') ? $request->state : null,
            "city" =>  $request->has('city') ? $request->city : null,
            "street_address" =>  $request->has('street_address') ? $request->street_address : null,
            "zip_code" =>  $request->has('zip_code') ? $request->zip_code : null,
            "details" =>  $request->has('details') ? $request->details : null,
        ]);

        return response()->json([
            "message" => "Customer Created Successfully",
            "data" => $customer,
        ],200);

    }



     /*
     * Show the profile for a given user.
     */
    public function show($id)
    {  
        
        $customer = User::where('id',$id)->where('type','customer')->first();
        if(!$customer){
            return response()->json([
                "message" => 'Customer Not Found'
            ],422);
        }
        
        return response()->json([
            "message" => 'Customer Get Successfully',
            "data" => $customer,
        ],200);
    }
    

    /*
     * Show the profile for a given user.
     */
    public function update(Request $request,$id)
    {

        $customer = User::where('id',$id)->where('type','customer')->first();
        if(!$customer){
            return response()->json([
                "message" => 'Customer Not Found'
            ],422);
        }

        $validator = Validator::make($request->all(),[
            'name' => ['required','unique:users,name,'.$customer->id,'string','max:30'],
            'email' =>['required','unique:users,email,'.$customer->id,'max:30'],
            'phone' => ['nullable','string','max:50'],
            'country' => ['nullable','string','max:30'],
            'state' => ['nullable','string','max:30'],
            'city' => ['nullable','string','max:30'],
            'zip_code' => ['nullable','string','max:30'],
            'details' => ['nullable','string','max:300'],
        ]);
        
        if($validator->fails()){
            return response()->json([
                "message" => "Validation Failed",
                "data" => ["validations" => $validator->messages()],
            ],403);
        }

        $customer->name = $request->name;
        $customer->email = $request->email;
        $request->has('phone') ? $customer->phone = $request->phone : '';
        $request->has('country') ? $customer->country = $request->country : '';
        $request->has('street_address') ? $customer->street_address = $request->street_address : '';
        $request->has('city') ? $customer->city = $request->city : '';
        $request->has('state') ? $customer->state = $request->state : '';
        $request->has('zip_code') ? $customer->zip_code = $request->zip_code : '';
        $request->has('details') ? $customer->details = $request->details : '';
        $customer->save();
    
        return response()->json([
            "message" => 'Customer Update Successfully',
            "data" => $customer,
        ],200);
    }


    /**
     * Show the profile for a given user.
     */
    public function destroy($id)
    {

        $customer = User::where('id',$id)->where('type','customer')->first();
        if(!$customer){
            return response()->json([
                "message" => 'Customer Not Found'
            ],422);
        }

        $customer->delete();
 
        
        return response()->json([
            "message" => 'Customer Deleted Successfully',
            "data" => ['id' => $id]
        ],200);
    }

}
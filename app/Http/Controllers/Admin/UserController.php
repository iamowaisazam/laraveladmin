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

class UserController extends Controller
{

    /*
    * Show the profile for a given user.
    */
    public function index(Request $request)
    {       

        $per_page = 3;
        $order_by = 'date';
        $assending = 'asc';
   
        $data = User::query();

        if($request->has('search')){
            $search = $request->search;
            $data->where('title', 'like', '%'.$search.'%')
            ->orWhere('name', 'like', '%'.$search.'%');
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

            case 'title':
                $data->orderBy('title',$assending);
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

        $data = User::paginate($per_page);
        return view('admin.users.index',compact('data'));
    }



    /*
    * Show the profile for a given user.
    */
    public function create()
    {       
        return view('admin.users.create');
    }


    /*
    * Show the profile for a given user.
    */
    public function store(Request $request)
    {  
        $request->validate([
            'name' => ['required','string','unique:users,name','min:3','max:100'],
            'email' => ['required','string','email','unique:users,email','min:3','max:100'],
            'password' => ['required','string','min:6','max:100'],
            'status' => ['required','string','min:1','max:100'],
        ]);

         try {

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified' => 1,
                'type' => 'guest',
                'status' => $request->status,
            ]);

            return redirect()->route('admin.users.index')->with('success','User Created Success');
            
        } catch (\Exception) {
            return back()->withInput()->with('error','User Not Created');
        }
        
        return view('admin.dashboard');
    }


    /*
    * Show the profile for a given user.
    */
    public function edit($id)
    {   
        $data = User::find($id);
        if(!$data){
            return back()->with('error','User Not Found');
        }
        

        return view('admin.users.edit',compact('data'));
    }

    /*
    * Show the profile for a given user.
    */
    public function update(Request $request,$id)
    { 
        $data = User::find($id);
        if(!$data){
            return back()->withInput()->with('error','User Not Found');
        }
        
        $request->validate([
            'name' => ['required','string','unique:users,name,'.$data->id,'min:3','max:100'],
            'email' => ['required','string','email','unique:users,email,'.$data->id,'min:3','max:100'],
            'status' => ['required','string','min:1','max:100'],
        ]);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->status = $request->status;

        if($request->has('password') && $request->password != ''){
            $request->validate([
                'password' => ['string','min:6','max:100'],
            ]);
            $data->password =  Hash::make($request->password);
        }

        if($data->save()){
            return back()->with('success','Record Updated');   
        }else{
            return back()->with('error','Record Not Updated');   
        }
    }


    /*
    * Show the profile for a given user.
    */
    public function show()
    {       
        return view('admin.dashboard');
    }

    /*
    * Show the profile for a given user.
    */
    public function delete($id)
    {
        try {
             User::destroy($id);
             return back()->with('success','Record Deleted');   
        } catch (\Exception) {
            return back()->with('error','Record Not Deleted');   
        }
    }



}
<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BrandController extends Controller
{

    /**
     * Show the profile for a given user.
     */
    public function list(Request $request)
    { 
        $data = Brand::query();
        if($request->has('search')){
            $search = $request->search;
            $data->where('title', 'like', '%'.$search.'%');
        }

        $data = $data->limit(5)->get();
        
        return response()->json([
           "message" => "Get All Brand Successfully",
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

        $data = Brand::query();

        if($request->has('search')){
            $search = $request->search;
            $data->where('title', 'like', '%'.$search.'%')
            ->orWhere('slug', 'like', '%'.$search.'%');
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

        return response()->json([
            "message" => "Get All Brand Successfully",
            "data" =>  $data->paginate($per_page),
        ],200);
    }


    /*
     * Show the profile for a given user.
     */
    public function store(Request $request)
    {
        
        if(request()->has('slug')){
            request()->merge(['slug' => Str::slug( request()->slug)]);
        } 

        $validator = Validator::make($request->all(),[
            'name' => ['required','string','min:5','max:30'],
            'slug' =>['required','string','unique:brands,slug','min:5','max:30'],
            'status' => ['required','string','max:50'],
            'ordering' => ['required','integer','max:10'],
            'featured' => ['required','integer','max:1'],
            'excerpt' => ['nullable','string','max:100'],
            'thumbnail' => ['image','mimes:jpeg,png,jpg','max:2048'],
        ]);
        
        if($validator->fails()){
            return response()->json([
                "message" => "Validation Failed",
                "data" => ["validations" => $validator->messages()],
            ],403);
        }

        $brand = Brand::create([        
            "name" => $request->name,
            "slug" =>  $request->slug,
            "status" =>  $request->status,
            "ordering" =>  $request->ordering,
            "featured" =>  $request->featured,
            "excerpt" =>  $request->has('excerpt') ? $request->excerpt : null,
        ]);

        return response()->json([
            "message" => 'Brand Created Successfully',
            "data" => $brand,
        ],200);

    }


     /*
     * Show the profile for a given user.
     */
    public function show($id)
    {       

        $brand = Brand::where('id',$id)->first();
        if(!$brand){
            return response()->json([
                'message' => 'Brand Not Found',
            ],422);
        }

        return response()->json([
            "message" => 'Brand Get Successfully',
            "data" => $brand,
        ],200);
    }
    

    /*
     * Show the profile for a given user.
     */
    public function update(Request $request,$id)
    {

        $brand = Brand::where('id',$id)->first();
        if(!$brand){
            return response()->json([
                'message' => 'Brand Not Found',
            ],422);
        }

        if(request()->has('slug')){
            request()->merge(['slug' => Str::slug( request()->slug)]);
        } 

        $validator = Validator::make($request->all(),[
            'name' => ['required','string','min:5','max:30'],
            'slug' =>['required','unique:brands,slug,'.$brand->id,'min:3','max:30'],
            'status' => ['required','string','max:50'],
            'ordering' => ['required','integer','max:10'],
            'featured' => ['required','integer','max:1'],
            'excerpt' => ['nullable','string','max:100'],
            'thumbnail' => ['image','mimes:jpeg,png,jpg','max:2048'],
        ]);
        
        if($validator->fails()){
            return response()->json([
                "message" => "Validation Failed",
                "data" => ["validations" => $validator->messages()],
            ],403);
        }

        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->status = $request->status;
        $brand->ordering = $request->ordering;
        $brand->featured = $request->featured;
        $brand->excerpt = $request->has('excerpt') ? $request->excerpt : null;

        if($request->has('thumbnail')){
            $brand->thumbnail = $request->thumbnail;
        } 
        $brand->save();

        return response()->json([
            "message" => 'Brand Update Successfully',
            "data" => $brand,
        ],200);
    }


    /**
     * Show the profile for a given user.
     */
    public function destroy($id)
    {
        $brand = Brand::where('id',$id)->first();
        if(!$brand){
            return response()->json([
                'message' => 'Brand Not Found',
            ],422);
        }
        $brand->delete();
      
        return response()->json([
            "message" => 'Brand Deleted Successfully',
            "data" => ['id' => $id]
        ],200);
    }


}
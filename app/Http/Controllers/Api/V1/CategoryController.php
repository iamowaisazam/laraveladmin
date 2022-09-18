<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    /**
     * Show the profile for a given user.
     */
    public function list(Request $request)
    { 
        $data = Category::query();
        if($request->has('search')){
            $search = $request->search;
            $data->where('title', 'like', '%'.$search.'%');
        }

        $data = $data->limit(5)->get();
        
        return response()->json([
           "message" => "Get All Category Successfully",
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

        $data = Category::query()->with('subcategories');

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
            "message" => "Get All Category Successfully",
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
            'title' => ['required','string','min:5','max:30'],
            'slug' =>['required','string','unique:categories,slug','min:5','max:30'],
            'description' => ['nullable','string','max:300'],
            'excerpt' => ['nullable','string','max:100'],
            'thumbnail' => ['image','mimes:jpeg,png,jpg','max:2048'],
        ]);
        
        if($validator->fails()){
            return response()->json([
                "message" => "Validation Failed",
                "data" => ["validations" => $validator->messages()],
            ],403);
        }

        $category = Category::create([        
            "title" => $request->title,
            "slug" =>  $request->slug,
            "description" =>  $request->has('description') ? $request->description: null,
            "excerpt" =>  $request->has('excerpt') ? $request->excerpt : null,
        ]);

        $category->subcategories;

        return response()->json([
            "message" => 'Category Created Successfully',
            "data" => $category,
        ],200);

    }


     /*
     * Show the profile for a given user.
     */
    public function show(Category $category)
    {       
        $category->subcategories;

        return response()->json([
            "message" => 'Category Get Successfully',
            "data" => $category,
        ],200);
    }
    

    /*
     * Show the profile for a given user.
     */
    public function update(Request $request,Category $category)
    {
        if(request()->has('slug')){
            request()->merge(['slug' => Str::slug( request()->slug)]);
        } 

        $validator = Validator::make($request->all(),[
            'title' => ['required','string','min:5','max:30'],
            'slug' =>['required','unique:categories,slug,'.$category->id,'min:3','max:30'],
            'description' => ['nullable','string','max:300'],
            'excerpt' => ['nullable','string','max:100'],
            'thumbnail' => ['image','mimes:jpeg,png,jpg','max:2048'],
        ]);
        
        if($validator->fails()){
            return response()->json([
                "message" => "Validation Failed",
                "data" => ["validations" => $validator->messages()],
            ],403);
        }

        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->description = $request->has('description') ? $request->description : null;
        $category->excerpt = $request->has('excerpt') ? $request->excerpt : null;

        if($request->has('thumbnail')){
            $category->thumbnail = $request->thumbnail;
        } 
        
        $category->save();
        $category->subcategories;
    
        return response()->json([
            "message" => 'Category Update Successfully',
            "data" => $category,
        ],200);
    }


    /**
     * Show the profile for a given user.
     */
    public function destroy(Category $category)
    {
        $id = $category->id;
        $category->delete();
      
        return response()->json([
            "message" => 'Category Deleted Successfully',
            "data" => ['id' => $id]
        ],200);
    }



}
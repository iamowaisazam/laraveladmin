<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    /**
     * Show the profile for a given user.
     */
    public function list(Request $request)
    { 

        $data = Product::query();
        if($request->has('search')){
            $search = $request->search;
            $data->where('title', 'like', '%'.$search.'%');
        }

        $data = $data->limit(5)->get();
        return response()->json([
           "message" => "Get All Product Successfully",
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
   
        $data = Product::query();

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
            "message" => "Get All Product Successfully",
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
            'slug' =>['required','unique:products,slug','min:5','max:30'],
            'sku' => ['required','string','unique:products,sku','min:1','max:30'],
            'description' => ['nullable','string','max:300'],
            'excerpt' => ['nullable','string','max:100'],
            'price' => ['required','integer','min:0','max:10'],
            'thumbnail' => ['image','mimes:jpeg,png,jpg','max:2048'],
            'category_id' => ['required','integer','exists:categories,id'],
            'sub_category_id' => ['nullable','integer','exists:categories,id'],
        ]);
        
        if($validator->fails()){
            return response()->json([
                "message" => "Validation Failed",
                "data" => ["validations" => $validator->messages()],
            ],403);
        }

        $product = Product::create([        
            "title" => $request->title,
            "slug" =>  $request->slug,
            "price" =>  $request->price,
            "sku" =>  $request->sku,
            "category_id" => $request->category_id,
            "description" =>  $request->has('description') ? $request->description: null,
            "excerpt" =>  $request->has('excerpt') ? $request->excerpt : null,
            "sub_category_id" =>  $request->has('sub_category_id') ? $request->sub_category_id : null,
        ]);


        return response()->json([
            "message" => 'Product Created Successfully',
            "data" => $product,
        ],200);
    }


     /*
     * Show the profile for a given user.
     */
    public function show(Product $product)
    {       
        return response()->json([
            "message" => 'Product Get Successfully',
            "data" => $product,
        ],200);
    }
    

    /*
     * Show the profile for a given user.
     */
    public function update(Request $request,Product $product)
    {
        if(request()->has('slug')){
            request()->merge(['slug' => Str::slug( request()->slug)]);
        } 

        $validator = Validator::make($request->all(),[
            'title' => ['required','string','min:5','max:30'],
            'slug' =>['required','unique:products,slug,'.$product->id,'min:3','max:30'],
            'description' => ['nullable','string','max:300'],
            'excerpt' => ['nullable','string','max:100'],
            'price' => ['required','integer','min:1','max:10'],
            'sku' => ['required','string','unique:products,sku,'.$product->id,'min:2','max:30'],
            'thumbnail' => ['image','mimes:jpeg,png,jpg','max:2048'],
            'category_id' => ['required','integer','exists:categories,id'],
            'sub_category_id' => ['nullable','integer','exists:categories,id'],
        ]);
        
        if($validator->fails()){
            return response()->json([
                "message" => "Validation Failed",
                "data" => ["validations" => $validator->messages()],
            ],403);
        }

        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->price = $request->price;
        $product->sku = $request->sku;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->excerpt = $request->excerpt;
        $product->sub_category_id = $request->sub_category_id;

        if($request->has('thumbnail')){
            $product->thumbnail = $request->thumbnail;
        } 

        $product->save();
    
        return response()->json([
            "message" => 'Product Update Successfully',
            "data" => $product,
        ],200);
    }


    /**
     * Show the profile for a given user.
     */
    public function destroy(Product $product)
    {
        $id = $product->id;
        $product->delete();
      
        return response()->json([
            "message" => 'Product Deleted Successfully',
            "data" => ['id' => $id]
        ],200);
    }


}
<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Con;
use App\Models\Order;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $data = Order::With('Customer')->where('user_id',$request->user()->id)->paginate(5);
        return response()->json(['data' => $data],200);
    }


    /**
     * Show the profile for a given user.
     */
    public function create()
    {
        return view('orders.create');
    }

    /*
     * Show the profile for a given user.
     */
    public function store(Request $request)
    {
        if(! $request->has('items')){
            return back()->with('warning','Please Select Items'); 
        }

        $order = [
            "id" => uniqid(),
            "ref" => $request->ref,
            "status" => $request->status,
            "date" => $request->date,
            "customer" =>$request->customer,
            "items" => $request->items,
            "subtotal" => $request->subtotal,
            "discount" => $request->discount,
            "tax" => $request->tax,
            "total" => $request->total,
            "notes" => $request->notes,
        ];


        $orders->push($order);
        if(Con::set('orders',$orders)){
            return redirect()->route('orders.index')->with('success','Order Created');
        }else{
            return back()->with('error','Error Found Order Not Created Please Contact Your Software'); 
        }

    }

    /*
     * Show the profile for a given user.
     */
    public function update(Request $request,$id)
    {

      

        $orders = Con::get('orders');
        $order = $orders->where('id',$id);
        if(count($order) == 0){
             return back()->with('error','Record Not Found');
        }

        $new_collection = $orders->map(function ($item) use ($id,$request) {
            if($item['id'] == $id ){

                $item = [
                    "id" => $id,
                    "ref" => $request->ref,
                    "status" => $request->status,
                    "date" => $request->date,
                    "customer" =>$request->customer,
                    "items" => $request->items,
                    "subtotal" => $request->subtotal,
                    "discount" => $request->discount,
                    "tax" => $request->tax,
                    "total" => $request->total,
                    "notes" => $request->notes,
                ];
            }
            return $item;
        });

        // dd($new_collection);
        if(Con::set('orders',$new_collection)){
            return back()->with('success','Order Update');
        }else{
            return back()->with('error','Error Found Order Not Updated Please Contact Your Software'); 
        }
        
    }


     /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
       $orders = Con::get('orders');
       $order = $orders->where('id',$id);
       
       if(count($order) == 0){
            return back()->with('error','Record Not Found');
       }

        $order = $orders->first();
        
        return view('orders.edit',compact('order'));
    }



    /**
     * Show the profile for a given user.
     */
    public function delete($id)
    {
       $orders = Con::get('orders');
       $order = $orders->where('id',$id);
       
       if(count($order) == 0){
            return back()->with('error','Record Not Found');
       }
       
       $newData = $orders->where('id','!=',$id);

       if(Con::set('orders',$newData)){
          return back()->with('success','Order Delete');
        }else{
            return back()->with('error','Error Found Order Not Deleted Please Contact Your Software'); 
        }

    }

}
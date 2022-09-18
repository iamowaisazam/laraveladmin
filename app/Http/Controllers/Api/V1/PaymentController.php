<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Con;

class PaymentController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        
        if($request->ajax()) {

                $payments = Con::get('payments');
                return Datatables::of($payments->toArray())
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = "<a href=".route('payments.edit',$row['id'])." title='Edit'><i class='fas fa-edit fa-2x' aria-hidden='true'></i></a><a href=".route('payments.delete',$row['id'])." class='px-1' title='Delete'><i class='px-1 text-danger fa-2x fas fa-window-close'></i></a>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('payments.index');
    }


    /**
     * Show the profile for a given user.
     */
    public function create()
    {

        return view('payments.create');
    }

    /*
     * Show the profile for a given user.
     */
    public function store(Request $request)
    {
            $payments = Con::get('payments');
            $payment = [
                "id" => uniqid(),
                "order_id" => $request->order_id,
                "date" => $request->date,
                "payment_method" => $request->payment_method,
                "amount" => $request->amount,
                "description" => $request->description,
            ];

            $payments->push($payment);
            if(Con::set('payments',$payments)){
                return redirect()->route('payments.index')->with('success','Payment Created');
            }else{
                return back()->with('error','Error Found Payment Not Created Please Contact Your Software'); 
            }
    }

    /*
     * Show the profile for a given user.
     */
    public function update(Request $request,$id)
    {

        $payments = Con::get('payments');
        $payment = $payments->where('id',$id);
        if(count($payment) == 0){
             return back()->with('error','Record Not Found');
        }

        $new_collection = $payments->map(function ($item) use ($id,$request) {
            if($item['id'] == $id ){

                $item = [
                    "id" => $id,
                    "order_id" => $request->order_id,
                    "date" => $request->date,
                    "payment_method" => $request->payment_method,
                    "amount" => $request->amount,
                    "description" => $request->description,
                ];
            }
            return $item;
        });

        // dd($new_collection);
        if(Con::set('payments',$new_collection)){
            return back()->with('success','Payment Update');
        }else{
            return back()->with('error','Error Found Payment Not Updated Please Contact Your Software'); 
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
       $payments = Con::get('payments');
       $payment = $payments->where('id',$id);
       
       if(count($payment) == 0){
            return back()->with('error','Record Not Found');
       }

        $payment = $payments->first();
        return view('payments.edit',compact('payment'));
    }



    /**
     * Show the profile for a given user.
     */
    public function delete($id)
    {
       $payments = Con::get('payments');
       $payment = $payments->where('id',$id);
       
       if(count($payment) == 0){
            return back()->with('error','Record Not Found');
       }
       
       $newData = $payments->where('id','!=',$id);

       if(Con::set('payments',$newData)){
          return back()->with('success','Payment Delete');
        }else{
            return back()->with('error','Error Found Payment Not Deleted Please Contact Your Software'); 
        }

    }

}
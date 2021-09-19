<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\customer\Order;
use App\Models\customer\OrderItem;
use App\Traits\CommonTrait;
use DataTables;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

        //import trait
        use CommonTrait;  
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index(Request $request)
        {
            $list=Order::orderBy('id','DESC')->with('vendor','customer','status')->get();
            if ($request->ajax()) {
                return Datatables::of($list)
                    ->addIndexColumn()
    
                      // for customer name 
                      ->addColumn('customer', function($row){
                          $customer=$row->customer->first_name.'&nbsp'.$row->customer->last_name;  
                          return $customer;
                        })
    
                       //for customer mobile  
                        ->addColumn('mobile', function($row){
                          $mobile=$row->customer->mobile;  
                          return $mobile;
                        })
    
                       //for customer email  
                        ->addColumn('email', function($row){
                            $email=$row->customer->email;  
                            return $email;
                         })

                          //for customer mobile  
                        ->addColumn('vendor', function($row){
                            $vendors=$row->vendor->first_name.'&nbsp'.$row->vendor->last_name;  
                            return $vendors;
                          })
    
                        //for order status  
                        ->addColumn('status', function($row){
                            $status=optional($row->status)->status_name;  
                            return $status;
                         })
    
                       //for action column
                        ->addColumn('action', function($row){
                         $btn = '<a class="btn btn-primary btn-sm" title="Edit Order" href="'.route('order.page.edit',$row->id).'"> <i class="fa fa-edit"></i></a>';
                         return $btn;
                        })
    
                       ->rawColumns(['customer','mobile','email','vendor','status','action'])
    
                       ->make(true);
                  }
            return view('admin.order.index',compact('list'));
        }


        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order=Order::findOrFail($id);

        $totalItem=$order->totalItem($id);

        $totalQty=$order->totalQuantity($id);

        $defaultPrice=$order->defaultProductPrice($id);

        $attributePrice=$order->attributeProductPrice($id);
      
        return view('admin.order.edit',compact('order','totalItem','defaultPrice','attributePrice','totalQty'));
    }
}

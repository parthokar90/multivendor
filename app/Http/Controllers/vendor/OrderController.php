<?php

namespace App\Http\Controllers\vendor;

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
        $this->middleware('auth:vendor');
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
        $list=Order::where('vendor_id',auth()->user()->id)->orderBy('id','DESC')->with('customer','status')->get();
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

                    //for order status  
                    ->addColumn('status', function($row){
                        $status=optional($row->status)->status_name;  
                        return $status;
                     })

                   //for action column
                    ->addColumn('action', function($row){
                     $btn = '<a class="btn btn-primary btn-sm" title="Edit Order" href="'.route('orders.edit',$row->id).'"> <i class="fa fa-edit"></i></a>';
                     return $btn;
                    })

                   ->rawColumns(['customer','mobile','email','status','action'])

                   ->make(true);
              }
        return view('vendor.order.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
      
        return view('vendor.order.orderDetails',compact('order','totalItem','defaultPrice','attributePrice','totalQty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $qty=$request->quantity;
        $orderItem=OrderItem::findOrFail($id);
        $this->updateOrderItem($request->action,$id,$orderItem->product_id,$orderItem->attribute_value_id,$qty); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

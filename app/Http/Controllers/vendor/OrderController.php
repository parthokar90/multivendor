<?php

namespace App\Http\Controllers\vendor;
date_default_timezone_set("Asia/Dhaka");
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
        $list=OrderItem::where('vendor_id',auth()->user()->id)
        ->leftjoin('orders','orders.id','=','order_items.order_id')
        ->leftjoin('system_statuses','system_statuses.id','=','orders.status_id')
        ->select('order_items.id','order_items.order_id','system_statuses.status_name','order_items.created_at')
        ->orderBy('order_items.id','DESC')
        ->groupBy('order_items.order_id')
        ->get();
        if ($request->ajax()) {
            return Datatables::of($list)
                ->addIndexColumn()

                    //for order invoice  
                    ->addColumn('invoice', function($row){
                        $invoice='# Invoice'.$row->order_id;  
                        return $invoice;
                     })

                    //for order time  
                    ->addColumn('created_at', function($row){
                        $created_at=date('Y-m-d h:i:a',strtotime($row->created_at));  
                        return $created_at;
                     })

                   //for action column
                    ->addColumn('action', function($row){
                     $btn = '<a class="btn btn-primary btn-sm" title="Edit Order" href="'.route('orders.edit',$row->order_id).'"> <i class="fa fa-edit"></i></a>';
                     return $btn;
                    })

                   ->rawColumns(['invoice','created_at','action'])

                   ->make(true);
              }
        return view('vendor.order.index',compact('list'));
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

    //status update
    public function statusUpdate(Request $request,$id){
        $order=Order::findOrFail($id);
        $order->status_id=$request->status_id;
        $order->save();
        return redirect()->route('orders.index')->with('success','Order Status has been update successfully');
    }
}

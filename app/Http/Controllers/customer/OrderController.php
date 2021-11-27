<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\customer\Order;
use App\Models\customer\OrderItem;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
     //import trait
     use CommonTrait;  

    public function order(Request $request)
    {
        $list=Order::where('user_id',auth()->user()->id)->orderBy('id','DESC')->with('status')->get();
        return view('customer.order.index',compact('list'));
    }

    public function orderDetails($id){
        $order=Order::findOrFail($id);

        $totalItem=$order->totalItem($id);

        $totalQty=$order->totalQuantity($id);

        $defaultPrice=$order->defaultProductPrice($id);

        $attributePrice=$order->attributeProductPrice($id);
      
        return view('customer.order.orderDetails',compact('order','totalItem','defaultPrice','attributePrice','totalQty'));
    }

}

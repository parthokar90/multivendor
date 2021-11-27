<?php

namespace App\Http\Controllers\customer;
date_default_timezone_set("Asia/Dhaka");
use App\Http\Controllers\Controller;
use App\Models\admin\District;
use App\Models\vendor\DeliveryCharge;
use App\Models\vendor\Product;
use App\Models\vendor\ProductAttribute;
use App\Models\customer\Order;
use App\Models\customer\OrderItem;
use App\Models\customer\OrderCoupon;
use App\Models\customer\ProductCart;
use App\Models\customer\OrderCharge;
use App\Traits\CartTrait;
use App\Models\customer\CouponUser;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;



class CheckoutController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    
    //import trait
    use CommonTrait,CartTrait;

    //checkout index method
    public function index(){
        $subTotal=0;
        $item=$this->cartItem();
        $subTotal=$this->cartSubTotal();
        $country=$this->activeCountry();
        $district=$this->activeDistrict();
        $coupon=CouponUser::where('user_id',auth()->user()->id)
        ->leftjoin('coupons','coupons.id','=','coupon_users.coupon_id')
        ->sum('amount');
        if($item->count()>0){
            return view('customer.checkout.index',compact('subTotal','coupon','country','district'));
        }else{
            return view('front.error.cartEmpty');
        }
    }

    //order placed
    public function orderPlaced(Request $request){
       //check if ship address differeny then auth address
    if($request->ship_first_name==''){
        $ship_first_name=$request->auth_ship_first_name;
    }
    else{
        $ship_first_name=$request->ship_first_name;
    }

    if($request->ship_last_name==''){
        $ship_last_name=$request->auth_ship_last_name;
    }else{
        $ship_last_name=$request->ship_last_name;
    }

    if($request->ship_phone==''){
    $ship_phone=$request->auth_ship_phone;
    }
    else{
    $ship_phone=$request->ship_phone;
    }

    if($request->ship_country==''){
        $ship_country=$request->auth_ship_country;
    }
    else{
        $ship_country=$request->ship_country;
    }

    if($request->ship_city==''){
    $ship_city=$request->auth_ship_country;
    }
    else{
    $ship_city=$request->ship_city;
    }

    if($request->ship_zipcode==''){
    $ship_zipcode=$request->auth_ship_zipcode;
    }
    else{
    $ship_zipcode=$request->ship_zipcode;
    }

    if($request->ship_district==''){
        $ship_district=$request->auth_ship_district;
     }
      else{
      $ship_district=$request->ship_district;
    }

    $order = new Order;
    $order->user_id=auth()->user()->id;
    $order->ship_first_name=$ship_first_name;
    $order->ship_last_name=$ship_last_name;
    $order->ship_location='Bangladesh';
    $order->ship_country=$ship_country;
    $order->ship_city=$ship_city;
    $order->ship_district=$ship_district;
    $order->ship_zipcode=$ship_zipcode;
    $order->ship_phone=$ship_phone;
    $order->ship_note=$request->ship_note;
    $order->order_date=date('Y-m-d h:i:s');
    $order->status_id=1;
    $order->payment_type=$request->payment_type;
    $order->save();

    //delivery charge
    $charge=DeliveryCharge::where('district_id',$ship_district)
    ->join('product_carts','product_carts.vendor_id','=','delivery_charges.vendor_id')
    ->select('product_carts.vendor_id','delivery_charges.id as charge_id')
    ->groupBy('product_carts.vendor_id')
   ->get();
    foreach($charge as $charges){
        $store = new OrderCharge;
        $store->order_id = $order->id;
        $store->user_id = auth()->user()->id;
        $store->vendor_id = $charges->vendor_id;
        $store->charge_id = $charges->charge_id;
        $store->save();
    }
    
    $cartItem = ProductCart::where('user_id',auth()->user()->id)->get();
    foreach($cartItem as $item){
    //stock minus default product
     $product_current_stock=Product::where('id',$item->product_id)->sum('quantity');
     $cart_product_qty=ProductCart::where(['product_id'=>$item->product_id,'attribute_type_id'=>0,'attribute_value_id'=>0])->sum('quantity');
     $update_product_stock=$product_current_stock-$cart_product_qty;
     Product::where('id',$item->product_id)
     ->update([
       'quantity'=>$update_product_stock
     ]);  
  
    //stock minus attribute product
     $product_current_stock_attribute=ProductAttribute::where(['product_id'=>$item->product_id,'type_id'=>$item->attribute_type_id,'value_id'=>$item->attribute_value_id])->sum('quantity');
     $cart_product_qty_att=ProductCart::where(['product_id'=>$item->product_id,'attribute_type_id'=>$item->attribute_type_id,'attribute_value_id'=>$item->attribute_value_id])->sum('quantity');
     $update_product_stock_att=$product_current_stock_attribute-$cart_product_qty_att;
     ProductAttribute::where(['product_id'=>$item->product_id,'type_id'=>$item->attribute_type_id,'value_id'=>$item->attribute_value_id])
     ->update([
      'quantity'=>$update_product_stock_att
     ]); 
  
      $itemData = new OrderItem;
      $itemData->order_id =  $order->id;
      $itemData->product_id = $item->product_id;
      $itemData->vendor_id = $item->vendor_id;
      $itemData->shop_id = $item->shop_id;
      $itemData->attribute_id = $item->attribute_type_id;
      $itemData->attribute_value_id = $item->attribute_value_id;
      $itemData->quantity = $item->quantity;
      $itemData->status_id = 1;
      $itemData->save();
   }

    //coupon data
    $couponData=CouponUser::where('user_id',auth()->user()->id)
    ->get();

    foreach($couponData as $coupons){
    $orderCoupon = new OrderCoupon;
    $orderCoupon->order_id = $order->id;
    $orderCoupon->user_id = auth()->user()->id;
    $orderCoupon->coupon_id = $coupons->coupon_id;
    $orderCoupon->vendor_id = $coupons->vendor_id;
    $orderCoupon->save();
    }

    //delete table
    ProductCart::where('user_id',auth()->user()->id)->delete();
    CouponUser::where('user_id',auth()->user()->id)->delete();
    return redirect()->route('home.page');
    }
}

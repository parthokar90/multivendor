<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\vendor\Product;
use App\Models\customer\CouponUser;
use App\Models\vendor\Coupon;
use App\Traits\CartTrait;
use App\Models\vendor\ProductAttribute;
use App\Models\customer\ProductCart;



class CartController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth:web');
    }
        //import trait
    use CartTrait;
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $subTotal=0;
        $item=$this->cartItem();
        $subTotal=$this->cartSubTotal();
        $coupon=CouponUser::where('user_id',auth()->user()->id)
        ->leftjoin('coupons','coupons.id','=','coupon_users.coupon_id')
        ->sum('amount');
        if($item->count()>0){
            return view('customer.cart.cartItem',compact('item','subTotal','coupon'));
        }else{
            return view('front.error.cartEmpty');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check product quantity must be greater then 0
          $qty=$request->quantity;
          if($qty==0){
            return back()->with('error','Quantity must not be zero');
          }
          $product_id   = $request->product_id;
          $attribute_id = $request->attribute;
          $type_id=$request->type_id;
          $qty=$request->quantity;
          $productDetails=Product::findOrFail($product_id);
          //check if product has not out of stock
          if($productDetails->stock_status==0){
            return back()->with('error','Product Out Of Stock');
          }
          $attributeDetails=ProductAttribute::where('product_id',$product_id)->where('type_id',$type_id)->where('value_id',$attribute_id)->first();
  
          //check product has attribute or not
          $productAttribute=ProductAttribute::where('product_id',$product_id)->first();
          if(isset($productAttribute)){
             if($attribute_id==''){
               return back()->with('error','Select attribute');
             }
             //check product has duplicate attribute
             $count=ProductCart::
             where('user_id',auth()->user()->id)
             ->where('attribute_type_id',$type_id)
             ->where('attribute_value_id',$attribute_id)
             ->count();
  
             //if same attribute found than update qty
             if($count>0){
               $exists_qty=ProductCart::
               where('user_id',auth()->user()->id)
               ->where('attribute_type_id',$type_id)
               ->where('attribute_value_id',$attribute_id)
               ->sum('quantity');
               $totalQty = $exists_qty+$qty;
               $subTotal=$attributeDetails->sale_price*$totalQty;
         
               $update = ProductCart::where('user_id',auth()->user()->id)
               ->where('attribute_type_id',$type_id)
               ->where('attribute_value_id',$attribute_id)
               ->update([
                'user_id'=>auth()->user()->id,
                'product_id'=>$productDetails->id,
                'vendor_id'=>$productDetails->vendor_id,
                'shop_id'=>$productDetails->shop_id,
                'attribute_type_id'=>$type_id,
                'attribute_value_id'=>$attribute_id,
                'image'=> $attributeDetails->image,
                'quantity'=>$totalQty,
                'price'=>$attributeDetails->sale_price,
                'sub_total'=>$subTotal
                ]);
             }else{
                $store=new ProductCart;
                $store->user_id=auth()->user()->id;
                $store->product_id=$productDetails->id;
                $store->vendor_id=$productDetails->vendor_id;
                $store->shop_id=$productDetails->shop_id;
                $store->attribute_type_id=$type_id;
                $store->attribute_value_id=$attribute_id;
                $store->image=$attributeDetails->image;
                $store->quantity=$qty;
                $store->price=$attributeDetails->sale_price;
                $store->sub_total=$qty*$attributeDetails->sale_price;
                $store->save();
             }
          }else{
          //check product has duplicate without attribute
          $count=ProductCart::
          where('user_id',auth()->user()->id)
          ->where('product_id',$product_id)
          ->where('attribute_type_id','=',0)
          ->where('attribute_value_id','=',0)
          ->count();
          if($count>0){
              $exists_qty=ProductCart::
               where('user_id',auth()->user()->id)
               ->where('attribute_type_id','=',0)
               ->where('attribute_value_id','=',0)
               ->sum('quantity');
               $totalQty = $exists_qty+$qty;
               $subTotal=$productDetails->sale_price*$totalQty;
               $update = ProductCart::where('user_id',auth()->user()->id)
               ->where('attribute_type_id','=',0)
               ->where('attribute_value_id','=',0)
               ->update([
                'user_id'=>auth()->user()->id,
                'product_id'=>$productDetails->id,
                'vendor_id'=>$productDetails->vendor_id,
                'shop_id'=>$productDetails->shop_id,
                'attribute_type_id'=>$type_id,
                'attribute_value_id'=>$attribute_id,
                'image'=> $productDetails->image,
                'quantity'=>$totalQty,
                'price'=>$productDetails->sale_price,
                'sub_total'=>$subTotal
                ]);
          }else{
                $store=new ProductCart;
                $store->user_id=auth()->user()->id;
                $store->product_id=$productDetails->id;
                $store->vendor_id=$productDetails->vendor_id;
                $store->shop_id=$productDetails->shop_id;
                $store->image=$productDetails->image;
                $store->quantity=$qty;
                $store->price=$productDetails->sale_price;
                $store->sub_total=$qty*$productDetails->sale_price;
                $store->save();
          }
      }
       
        return back()->with('success','Product has been added to cart'); 
    }


    //for customer cart update
    public function cartUpdate($id,$qty){
        $cart=ProductCart::findOrFail($id);
        $cart->quantity=$qty;
        $cart->sub_total=$cart->price*$qty;
        $cart->save();
        return response()->json($cart);
    }

    //for customer coupon
    public function cartCoupon(Request $request){
      $coupon=$request->coupon_code;
        $checkCoupon=Coupon::where('status',1)
        ->where('coupon_code',$coupon)
        ->where('expire_date','>=',date('Y-m-d'))
        ->count(); 
        
        $vendorCoupon=Coupon::where('status',1)
        ->where('coupon_code',$coupon)
        ->where('expire_date','>=',date('Y-m-d'))
        ->join('product_carts','product_carts.vendor_id','=','coupons.vendor_id')
        ->count();
        if($vendorCoupon==0){
            return back()->with('error','Code does not exists');
        }
        
        if($checkCoupon==0){  
           return back()->with('error','Code does not exists');
        }else{
          $coupon_data=Coupon::where('status',1)
          ->where('coupon_code',$coupon)
          ->where('expire_date','>=',date('Y-m-d'))
          ->first(); 
          $count=CouponUser::where('user_id',auth()->user()->id)->where('coupon_id',$coupon_data->id)->count();
          if($count>0){
              CouponUser::where('user_id',auth()->user()->id)->where('coupon_id',$coupon_data->id)->delete();
              $insert= new CouponUser;
              $insert->user_id=auth()->user()->id;
              $insert->coupon_id=$coupon_data->id;
              $insert->vendor_id=$coupon_data->vendor_id;
              $insert->save();
          }else{
              $insert= new CouponUser;
              $insert->user_id=auth()->user()->id;
              $insert->coupon_id=$coupon_data->id;
              $insert->vendor_id=$coupon_data->vendor_id;
              $insert->save();
          }   
        }
        return redirect()->route('cart.index');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        $delete=ProductCart::findOrFail($id);
        $delete->delete();
        return back()->with('error','Item has been removed');
    } 
}

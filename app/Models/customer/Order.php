<?php

namespace App\Models\customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\admin\SystemStatus;
use App\Models\customer\OrderItem;
use App\Models\vendor\Coupon;
use App\Models\vendor\Vendor;
use App\Models\vendor\DeliveryCharge;
use App\Models\admin\Country;
use App\Models\admin\District;
use App\Models\admin\PostCode;

class Order extends Model
{
    use HasFactory;

    //this function show order customer name
    public function customer(){
        return $this->belongsTo(User::class,'user_id');
    }

    //this function show order customer name
    public function vendor(){
        return $this->belongsTo(Vendor::class,'vendor_id');
    }

    //this function show order status name
    public function status(){
        return $this->belongsTo(SystemStatus::class,'status_id');
    }

    //this function show multiple order item 
    public function orderItem(){
        return $this->hasMany(OrderItem::class,'order_id');
    }

    //this function show order coupon details
    public function coupon(){
        return $this->belongsTo(Coupon::class,'coupon_id');
    }

    //this function show order delivery charge details
    public function deliveryCharge(){
        return $this->belongsTo(DeliveryCharge::class,'charge_id');
    }

    //this function show total item of order
    public function totalItem($id){
       return OrderItem::where('order_id',$id)->count();
    }

    //this function show order total quantity
    public function totalQuantity($id){
      return OrderItem::where('order_id',$id)->sum('quantity');
    }

    //this function show order default product price
    public function defaultProductPrice($id){
      return OrderItem::where(['order_id'=>$id,'attribute_id'=>0])
      ->leftjoin('products','products.id','=','order_items.product_id')
      ->sum('sale_price');
    }

     //this function show order default product price
     public function attributeProductPrice($id){
        return OrderItem::where('order_id',$id)
        ->leftjoin('product_attributes','product_attributes.value_id','=','order_items.attribute_value_id')
        ->sum('sale_price');
     }

     //this function show order shipping country
     public function shippingCountry(){
       return $this->belongsTo(Country::class,'ship_country');
     }

     //this function show order shipping district
     public function shippingDistrict(){
        return $this->belongsTo(District::class,'ship_district');
     }

     //this function show order shipping zipcode
    public function shippingZipcode(){
        return $this->belongsTo(PostCode::class,'ship_zipcode');
    }

     



}

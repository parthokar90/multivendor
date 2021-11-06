<?php

namespace App\Models\customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\vendor\Product;
use App\Models\admin\AttributeValue;
use App\Models\vendor\ProductAttribute;
use App\Models\vendor\Shop;

class OrderItem extends Model
{
   //this function show order product name
    public function Product(){
        return $this->belongsTo(Product::class,'product_id');
    }


    //this function show order product attribute name
    public function Attribute(){
        return $this->belongsTo(AttributeValue::class,'attribute_value_id');
    }

    //this function show order product attribute details
    public function AttributeDetails($id){
        return ProductAttribute::where('value_id',$id)->first();
    }

}

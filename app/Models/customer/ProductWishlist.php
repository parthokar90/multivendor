<?php

namespace App\Models\customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\vendor\Product;
use App\Models\User;

class ProductWishlist extends Model
{
   //this function show product name
   public function product(){
    return $this->belongsTo(Product::class,'product_id');
   }

   //this function show customer name
   public function customer(){
    return $this->belongsTo(User::class,'user_id');
   }
}

<?php

namespace App\Models\vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\vendor\Product;

class Shop extends Model
{
    use HasFactory;

    //shop product
    public function products(){
        return $this->hasMany(Product::class,'shop_id');
    } 


    //count shop product
    public function shopProduct($id){
       return Product::where('shop_id',$id)->count();
    }

    //this function show average rating
    public function averageRating($id){
        return ProductReview::where('product_id',$id)->avg('rating');
    }
}

<?php

namespace App\Models\vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\vendor\ProductGallry;
use App\Models\vendor\Shop;
use App\Models\vendor\Vendor;
use App\Models\admin\Brand;
use App\Models\vendor\ProductCategory;
use App\Models\vendor\ProductBrand;
use App\Models\vendor\ProductAttribute;
use App\Models\vendor\ProductGallery;
use App\Models\customer\ProductReview;


class Product extends Model
{
    
    protected $fillable = ['product_name','product_slug','quantity','alert_quantity','regular_price','sale_price',
    'cost_price','image','tag','is_featured','stock_status','dimension','short_description',
    'long_description','brand_id','vendor_id','shop_id','created_by','status'];

    use HasFactory;

    //this function shows product gallery
    public function gallery(){
        return $this->hasMany(ProductGallry::class,'product_id');
    }

    // this function shows product vendor name
    public function vendor(){
        return $this->belongsTo(Vendor::class,'vendor_id');
    }

    // this function shows product shop name
    public function shop(){
        return $this->belongsTo(Shop::class,'shop_id');
    }

    //this function shows product category
    public function category(){
        return $this->hasMany(ProductCategory::class,'product_id');
    }

     //this function shows product multiple attribute type
    public function productAttributeType($id){
        return ProductAttribute::where('product_id',$id)
      ->where('product_attributes.status',1)
      ->leftjoin('attributes','attributes.id','=','product_attributes.type_id')
      ->groupBy('product_attributes.type_id')
      ->get();
    }

    //this function show product multiple attribute value
    public function productAttributeValue(){
        return $this->hasMany(ProductAttribute::class,'product_id');
    }

    //this function show product brand name
    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    } 

    //this function show all product category in edit product page
    public function productCategorys($id){
        return ProductCategory::where('product_id',$id)->get();
    }
  
    //this function show product shop in edit product page
    public function productShop($id){
        
    }

    //this function show product shop in edit product page
    public function productGallery(){
        return $this->hasMany(ProductGallery::class,'product_id');
    }

    //this function show related brand product
    public function relatedProduct($id){
        return Product::where('brand_id',$id)->get();
    }

    //this function show product review in single product page
    public function productReview($id){
        return ProductReview::where(['product_id'=>$id,'status'=>1])->get();
    }

    //this function show product review count in single product page
    public function productReviewCount($id){
        return ProductReview::where(['product_id'=>$id,'status'=>1])->count();
    }

    //this function show average rating
    public function averageRating($id){
      return ProductReview::where('product_id',$id)->avg('rating');
    }

    
}

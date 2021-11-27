<?php
namespace App\Traits;
use App\Models\customer\ProductCart;
use App\Models\vendor\ProductCategory;
use App\Models\vendor\ProductAttribute;
use App\Models\vendor\TempAttribute;
use Auth;

trait ProductCreate{

    //this function insert product multiple category
    public function productCategory($id,$catId){
       for($i=0;$i<count($catId);$i++){
         $category = new ProductCategory;
         $category->product_id=$id;
         $category->category_id=$catId[$i];
         $category->status=7;
         $category->save();
       }
    }

    //this function update product multiple category
    public function updateProductcategory($id,$catId){
       ProductCategory::where('product_id',$id)->delete();
       for($i=0;$i<count($catId);$i++){
        $category = new ProductCategory;
        $category->product_id=$id;
        $category->category_id=$catId[$i];
        $category->status=7;
        $category->save();
      }
    }

    //this function insert product multiple attribute
    public function productAttribute($vendorId,$productId){
       $data = TempAttribute::where('vendor_id',$vendorId)->get();
       foreach($data as $item){
         $store = new ProductAttribute;
         $store->product_id=$productId;
         $store->type_id=$item->type_id;
         $store->value_id=$item->value_id;
         $store->quantity=$item->quantity;
         $store->alert_quantity=$item->alert_quantity;
         $store->regular_price=$item->regular_price;
         $store->sale_price=$item->sell_price;
         $store->cost_price=$item->cost_price;
         $store->created_by=$vendorId;
         $store->status=7;
         $store->save();
       }
       TempAttribute::where('vendor_id',$vendorId)->delete();
    }

}
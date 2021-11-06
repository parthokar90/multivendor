<?php 

namespace App\Traits;
use App\Models\admin\Category;
use App\Models\admin\Country;
use App\Models\admin\Brand;
use App\Models\admin\Attribute;
use App\Models\vendor\Shop;
use App\Models\vendor\Product;
use App\Models\vendor\Vendor;
use App\Models\customer\Order;
use App\Models\customer\OrderItem;
use App\Models\admin\District;
use App\Models\vendor\ProductAttribute;

trait CommonTrait {

     //this function show all active category list
     public function activeCategory() {
          return Category::where(['category_type'=>1,'status'=>1])->orderBy('id','DESC')->get();
     }

      //this function show all parent category list
      public function parentCategory() {
          return Category::where(['parent_id'=>0,'category_type'=>1,'status'=>1])->orderBy('id','DESC')->limit(20)->get();
     }

       //this function show all parent category list
       public function allParentCategory() {
          return Category::where(['parent_id'=>0,'category_type'=>1,'status'=>1])->orderBy('id','DESC')->get();
     }

     //this function show latest ten category
     public function latestCategory() {
          return Category::where(['parent_id'=>0,'category_type'=>1,'status'=>1])->orderBy('id','DESC')->limit(10)->get();
     }

     //all active country list
     public function activeCountry() {
          return Country::where('status',1)->orderBy('id','DESC')->get();
     }

   //limited active brand list
     public function activeBrand() {
          return Brand::where('status',1)->orderBy('id','DESC')->limit(20)->get();
     }

      //all active brand list
      public function allActiveBrand() {
          return Brand::where('status',1)->orderBy('id','DESC')->get();
     }

   //all active attribute type list
    public function activeType() {
       return Attribute::where('status',1)->orderBy('id','DESC')->get();

     }

     //all limit shop list
    public function activeShop() {
      return Shop::where('status',1)->orderBy('id','DESC')->limit(10)->get();
    }

     //all active shop list
      public function allActiveShop() {
          return Shop::where('status',1)->orderBy('id','DESC')->get();
     }

     //all active shop list
     public function activeVendor() {
          return Vendor::where('status',1)->orderBy('id','DESC')->get();
     }

     //all active district
     public function activeDistrict(){
        return District::where('status',1)->get();
     }

     //update order item
     public function updateOrderItem($action,$orderId,$productId,$attributeId,$quantity){
          $orderItem=OrderItem::findOrFail($orderId);
          if($action=='minus'){
          OrderItem::where('id',$orderId)->update([
            'quantity'=> $orderItem->quantity-$quantity,
          ]);

          if($orderItem->attribute_id==0){
             //stock increase from default product
             $stock=Product::where('id',$productId)->sum('quantity');
             Product::where('id',$productId)->update([
               'quantity'=>$stock+$quantity
             ]);
          }else{
             //stock increase from attribute product 
             $stock=ProductAttribute::where(['product_id'=>$productId,'value_id'=>$attributeId])->sum('quantity');
             ProductAttribute::where(['product_id'=>$productId,'value_id'=>$attributeId])->update([
               'quantity'=>$stock+$quantity
             ]);
          }
        }else{
           //stock decrease
            //update order item table 
          OrderItem::where('id',$orderId)->update([
            'quantity'=> $orderItem->quantity+$quantity,
          ]);
           //check default or attribute product
           if($orderItem->attribute_id==0){
            //stock increase from default product
            $stock=Product::where('id',$productId)->sum('quantity');
            Product::where('id',$productId)->update([
              'quantity'=>$stock-$quantity
            ]);
         }else{
            //stock increase from attribute product 
            $stock=ProductAttribute::where(['product_id'=>$productId,'value_id'=>$attributeId])->sum('quantity');
            ProductAttribute::where(['product_id'=>$productId,'value_id'=>$attributeId])->update([
              'quantity'=>$stock-$quantity
            ]);
         }
             
        }
         return back()->with('success','Item quantity has been update successfully.')->send();
     }
}
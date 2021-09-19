<?php 

namespace App\Traits;
use App\Models\admin\Category;
use App\Models\admin\Country;
use App\Models\admin\Brand;
use App\Models\admin\Attribute;
use App\Models\vendor\Shop;
use App\Models\vendor\Vendor;
use App\Models\customer\Order;
use App\Models\customer\OrderItem;
use App\Models\vendor\ProductAttribute;

trait CommonTrait {

     //this function show all active category list
     public function activeCategory() {
          $data = Category::where(['category_type'=>1,'status'=>1])->orderBy('id','DESC')->get();
          return $data;
     }

      //this function show all parent category list
      public function parentCategory() {
          $data = Category::where(['parent_id'=>0,'category_type'=>1,'status'=>1])->orderBy('id','DESC')->limit(20)->get();
          return $data;
     }

       //this function show all parent category list
       public function allParentCategory() {
          $data = Category::where(['parent_id'=>0,'category_type'=>1,'status'=>1])->orderBy('id','DESC')->get();
          return $data;
     }

     //this function show latest ten category
     public function latestCategory() {
          $data = Category::where(['parent_id'=>0,'category_type'=>1,'status'=>1])->orderBy('id','DESC')->limit(10)->get();
          return $data;
     }

     //all active country list
     public function activeCountry() {
          $data = Country::where('status',1)->orderBy('id','DESC')->get();
          return $data;
     }

   //limited active brand list
     public function activeBrand() {
          $data = Brand::where('status',1)->orderBy('id','DESC')->limit(20)->get();
          return $data;
     }

      //all active brand list
      public function allActiveBrand() {
          $data = Brand::where('status',1)->orderBy('id','DESC')->get();
          return $data;
     }

   //all active attribute type list
    public function activeType() {
          $data = Attribute::where('status',1)->orderBy('id','DESC')->get();
          return $data;
     }

     //all limit shop list
    public function activeShop() {
         $data = Shop::where('status',1)->orderBy('id','DESC')->limit(10)->get();
         return $data;
    }

     //all active shop list
      public function allActiveShop() {
          $data = Shop::where('status',1)->orderBy('id','DESC')->get();
          return $data;
     }

     //all active shop list
     public function activeVendor() {
          $data = Vendor::where('status',1)->orderBy('id','DESC')->get();
          return $data;
     }

     //update order item
     public function updateOrderItem($action,$orderId,$productId,$attributeId,$quantity){
          $orderItem=OrderItem::findOrFail($orderId);
          if($action=='minus'){
             
        //    //stock increase  
        //   //update order item table 
          OrderItem::where('id',$orderId)->update([
            'quantity'=> $orderItem->quantity-$quantity,
          ]);

        //   //check default or attribute product
          if($orderItem->attribute_id==0){
             //stock increase from default product
             $stock=Product::where('id',$productId)->sum('quantity');
             Product::where('product_id',$productId)->update([
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
            Product::where('product_id',$productId)->update([
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
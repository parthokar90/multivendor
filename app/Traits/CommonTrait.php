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
}
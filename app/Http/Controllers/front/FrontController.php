<?php

namespace App\Http\Controllers\front;
use App\Http\Controllers\Controller;


use App\Models\User;
use App\Models\admin\Blog;
use App\Models\admin\Slider;
use App\Models\vendor\Shop;
use App\Models\vendor\Product;
use App\Traits\CommonTrait;
use App\Traits\CartTrait;
use App\Models\vendor\ProductCategory;
use App\Models\customer\ProductReview;
use App\Models\vendor\ProductBrand;
use App\Models\vendor\ProductAttribute;
use App\Models\customer\ProductCart;
use App\Models\customer\CouponUser;
use App\Models\vendor\Coupon;
use App\Models\admin\District;
use App\Models\vendor\DeliveryCharge;
use App\Models\customer\Order;
use App\Models\customer\OrderCharge;
use App\Models\vendor\ProductGallery;
use App\Models\customer\OrderItem;
use App\Models\customer\OrderCoupon;
use Session;
use Illuminate\Http\Request;


class FrontController extends Controller
{
 
 //import trait
    use CommonTrait;
    //home page method
    public function index(){
     $shop=$this->activeShop();
        $brand=$this->activeBrand();
        $slider=Slider::where('status',1)->orderBy('id','DESC')->get();
        $featured=Product::where(['status'=>6,'is_featured'=>1])->orderBy('id','DESC')->get();
        $blog=Blog::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $topCatPro=Product::orderBy('id','DESC')
        ->where('status',6)
        ->take(4)
        ->get();
        return view('front.index',compact('shop','brand','slider','featured','blog','topCatPro'));
    }

    //contact method view
    public function contact(){
      return view('front.page.contact');
    } 

    //shop single method
    public function shopSingle($id){
      if(isset($_GET['amount1'])){
            $price_one=$_GET['amount1'];
            $price_two=$_GET['amount2'];
            $shopPrice=Product::where('shop_id',$id)->whereBetween('sale_price',[$price_one,$price_two])->get();
            $shop=Shop::findOrFail($id);
            return view('front.shop.shopDetails',compact('shop','shopPrice'));
        }else{
            $shopPrice=[];
            $shop=Shop::findOrFail($id);
            return view('front.shop.shopDetails',compact('shop','shopPrice'));
        }
    }

    //product single method
    public function productSingle($id){
      $product=Product::findOrFail($id);
        $attributeType=$product->productAttributeType($id);
        $relatedProduct=$product->relatedProduct($product->brand_id);
        $productReviewCount=$product->productReviewCount($id);
        $review=$product->productReview($id);
        $gallery=ProductGallery::where('product_id',$id)->get();
        return view('front.product.productDetails',
        compact('product',
        'attributeType',
        'relatedProduct',
        'productReviewCount',
        'review',
        'gallery'
       ));
    }

    //product review
    public function productReview(Request $request,$productid){
    $productDetails=Product::findOrFail($productid);
        $store = new ProductReview;
        $store->user_id=auth()->user()->id; 
        $store->vendor_id=$productDetails->vendor_id; 
        $store->product_id=$productid; 
        $store->shop_id=$productDetails->shop_id;; 
        $store->rating=5; 
        $store->message=$request->message; 
        $store->status=0; 
        $store->save(); 
        return back()->with('success','Thanks for your review'); 
    }

    //product search
    public function search(Request $request){
      if($request->cat_id==''){
          $products=Product::where('status',1)
          ->where('product_name', 'like', '%'.$request->search.'%')
          ->select('products.id','products.product_name','products.image','products.product_slug')
          ->get();
        }else{
          $products=ProductCategory::
           where('category_id',$request->cat_id)
          ->leftjoin('products','products.id','=','product_categories.product_id')
          ->select('products.id','products.product_name','products.image','products.product_slug')
          ->get();
        }
        return view('front.product.search',compact('products'));
    }

    //category product method
    public function categoryProduct($id){
      $category=ProductCategory::where(['category_id'=>$id,'status'=>7])->get();
        return view('front.product.categoryProduct',compact('category'));
    }

    //all active category
    public function allCategory(){
      $category=$this->activeCategory();
      return view('front.category.allCategory',compact('category'));
    }

    //all active shop
    public function allShop(){
      $allShop=$this->allActiveShop();
        return view('front.shop.allShop',compact('allShop'));
    }

    //all active brand
     public function allBrand(){
        $allbrand=$this->allActiveBrand();
        return view('front.brand.allBrand',compact('allbrand'));
     }

    //brand product method
    public function brandProduct($id){
        $brand=Product::where(['brand_id'=>$id,'status'=>6])->get();
        return view('front.product.brandProduct',compact('brand'));
    }

    //all blog
    public function blog(){
      $blog=Blog::orderBy('id','DESC')->get();
      return view('front.blog.blog',compact('blog'));
    }

    //blog single method
    public function blogSingle($id){
      $blog=Blog::findOrFail($id);
       return view('front.blog.blogSingle',compact('blog'));
    }

}

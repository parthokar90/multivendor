<?php

namespace App\Repository\Front;
use App\Models\vendor\Shop;
use App\Models\vendor\Product;
use App\Models\admin\Slider;
use App\Models\admin\Blog;
use App\Models\vendor\ProductCategory;
use App\Models\customer\ProductReview;
use App\Models\User;
use App\Models\vendor\ProductBrand;
use App\Traits\CommonTrait;

class HomePageRepository{

    //import trait
    use CommonTrait;

    //this is for home page index method
    public function index(){
        $shop=$this->activeShop();
        $brand=$this->activeBrand();
        $slider=Slider::where('status',1)->orderBy('id','DESC')->get();
        $featured=Product::where(['status'=>6,'is_featured'=>1])->orderBy('id','DESC')->get();
        $blog=Blog::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $toCat=ProductCategory::
        leftjoin('categories','categories.id','=','product_categories.category_id')
        ->orderBy('product_categories.id','DESC')
        ->take(4)
        ->groupBy('product_categories.category_id')
        ->get();
        $topCatPro=Product::orderBy('id','DESC')
        ->take(4)
        ->get();
        return view('front.index',compact('shop','brand','slider','featured','blog','toCat','topCatPro'));
    }

    //single shop details
    public function shopSingle($id){
        $shop=Shop::findOrFail($id);
        return view('front.shop.shopDetails',compact('shop'));
    }

   //product single method
    public function productSingle($id){
        $product=Product::findOrFail($id);
        $attributeType=$product->productAttributeType($id);
        $relatedProduct=$product->relatedProduct($product->brand_id);
        $productReviewCount=$product->productReviewCount($id);
        $review=$product->productReview($id);
        return view('front.product.productDetails',
        compact('product',
        'attributeType',
        'relatedProduct',
        'productReviewCount',
        'review'
       ));
    }

    //brand product method
    public function brandProduct($id){
        $brand=Product::where(['brand_id'=>$id,'status'=>6])->get();
        return view('front.product.brandProduct',compact('brand'));
    }

    //product search
    public function search($request){
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

    //product review
    public function productReview($request,$productid){
        $productDetails=Product::findOrFail($productid);
        $store = new ProductReview;
        $store->user_id=auth()->user()->id; 
        $store->vendor_id=$productDetails->vendor_id; 
        $store->product_id=$productid; 
        $store->shop_id=$productDetails->shop_id;; 
        $store->rating=3; 
        $store->message=$request->message; 
        $store->status=0; 
        $store->save(); 
        return back()->with('success','Thanks for your review'); 
    }

    //all active brand
    public function allBrand(){
        $allbrand=$this->allActiveBrand();
        return view('front.brand.allBrand',compact('allbrand'));
    }

    //category product method
    public function categoryProduct($id){
        $category=ProductCategory::where(['category_id'=>$id,'status'=>7])->get();
        return view('front.product.categoryProduct',compact('category'));
    }

    //all active shop
    public function allShop(){
        $allShop=$this->allActiveShop();
        return view('front.shop.allShop',compact('allShop'));
    }

    //all active category
    public function allCategory(){
        $category=$this->activeCategory();
        return view('front.category.allCategory',compact('category'));
    }

    //blog single method
    public function blogSingle($id){
       $blog=Blog::findOrFail($id);
       return view('front.blog.blogSingle',compact('blog'));
    }

    //top collection three category 
    public function topCollection(){
        return $this->HomePageService->topCollection();
    }


}

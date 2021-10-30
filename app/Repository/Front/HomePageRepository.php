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
use App\Models\vendor\ProductAttribute;
use App\Models\customer\ProductCart;
use App\Traits\CommonTrait;
use App\Traits\CartTrait;

class HomePageRepository{

    //import trait
    use CommonTrait,CartTrait;

    //this is for home page index method
    public function index(){
        $shop=$this->activeShop();
        $brand=$this->activeBrand();
        $slider=Slider::where('status',1)->orderBy('id','DESC')->get();
        $featured=Product::where(['status'=>6,'is_featured'=>1])->orderBy('id','DESC')->get();
        $blog=Blog::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $topCatPro=Product::orderBy('id','DESC')
        ->take(4)
        ->get();
        return view('front.index',compact('shop','brand','slider','featured','blog','topCatPro'));
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

    //all blog method
    public function blog(){
        $blog=Blog::orderBy('id','DESC')->get();
        return view('front.blog.blog',compact('blog'));
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

    //cart index method 
    public function cartIndex(){
        $subTotal=0;
        $item=$this->cartItem();
        $subTotal=$this->cartSubTotal();
        if($item->count()>0){
            return view('customer.cart.cartItem',compact('item','subTotal'));
        }else{
            return view('front.error.cartEmpty');
        }
    }

    //add to cart method
    public function cart($request){
          //check product quantity must be greater then 0
          $qty=$request->quantity;
          if($qty==0){
            return back()->with('error','Quantity must not be zero');
          }
          $product_id   = $request->product_id;
          $attribute_id = $request->attribute;
          $type_id=$request->type_id;
          $qty=$request->quantity;
          $productDetails=Product::findOrFail($product_id);
          $attributeDetails=ProductAttribute::where('product_id',$product_id)->where('type_id',$type_id)->where('value_id',$attribute_id)->first();
  
          //check product has attribute or not
          $productAttribute=ProductAttribute::where('product_id',$product_id)->first();
          if(isset($productAttribute)){
             if($attribute_id==''){
               return back()->with('error','Select attribute');
             }
             //check product has duplicate attribute
             $count=ProductCart::
             where('user_id',auth()->user()->id)
             ->where('attribute_type_id',$type_id)
             ->where('attribute_value_id',$attribute_id)
             ->count();
  
             //if same attribute found than update qty
             if($count>0){
               $exists_qty=ProductCart::
               where('user_id',auth()->user()->id)
               ->where('attribute_type_id',$type_id)
               ->where('attribute_value_id',$attribute_id)
               ->sum('quantity');
               $totalQty = $exists_qty+$qty;
               $subTotal=$attributeDetails->sale_price*$totalQty;
         
               $update = ProductCart::where('user_id',auth()->user()->id)
               ->where('attribute_type_id',$type_id)
               ->where('attribute_value_id',$attribute_id)
               ->update([
                'user_id'=>auth()->user()->id,
                'product_id'=>$productDetails->id,
                'vendor_id'=>$productDetails->vendor_id,
                'shop_id'=>$productDetails->shop_id,
                'attribute_type_id'=>$type_id,
                'attribute_value_id'=>$attribute_id,
                'image'=> $attributeDetails->image,
                'quantity'=>$totalQty,
                'price'=>$attributeDetails->sale_price,
                'sub_total'=>$subTotal
                ]);
             }else{
                $store=new ProductCart;
                $store->user_id=auth()->user()->id;
                $store->product_id=$productDetails->id;
                $store->vendor_id=$productDetails->vendor_id;
                $store->shop_id=$productDetails->shop_id;
                $store->attribute_type_id=$type_id;
                $store->attribute_value_id=$attribute_id;
                $store->image=$attributeDetails->image;
                $store->quantity=$qty;
                $store->price=$attributeDetails->sale_price;
                $store->sub_total=$qty*$attributeDetails->sale_price;
                $store->save();
             }
          }else{
          //check product has duplicate without attribute
          $count=ProductCart::
          where('user_id',auth()->user()->id)
          ->where('product_id',$product_id)
          ->where('attribute_type_id','=',0)
          ->where('attribute_value_id','=',0)
          ->count();
          if($count>0){
              $exists_qty=ProductCart::
               where('user_id',auth()->user()->id)
               ->where('attribute_type_id','=',0)
               ->where('attribute_value_id','=',0)
               ->sum('quantity');
               $totalQty = $exists_qty+$qty;
               $subTotal=$productDetails->sale_price*$totalQty;
               $update = ProductCart::where('user_id',auth()->user()->id)
               ->where('attribute_type_id','=',0)
               ->where('attribute_value_id','=',0)
               ->update([
                'user_id'=>auth()->user()->id,
                'product_id'=>$productDetails->id,
                'vendor_id'=>$productDetails->vendor_id,
                'shop_id'=>$productDetails->shop_id,
                'attribute_type_id'=>$type_id,
                'attribute_value_id'=>$attribute_id,
                'image'=> $productDetails->image,
                'quantity'=>$totalQty,
                'price'=>$productDetails->sale_price,
                'sub_total'=>$subTotal
                ]);
          }else{
                $store=new ProductCart;
                $store->user_id=auth()->user()->id;
                $store->product_id=$productDetails->id;
                $store->vendor_id=$productDetails->vendor_id;
                $store->shop_id=$productDetails->shop_id;
                $store->image=$productDetails->image;
                $store->quantity=$qty;
                $store->price=$productDetails->sale_price;
                $store->sub_total=$qty*$productDetails->sale_price;
                $store->save();
          }
      }
       
        return back()->with('success','Product has been added to cart'); 
    }


    //cart delete method
    public function cartDelete($id){
        $delete=ProductCart::findOrFail($id);
        $delete->delete();
        return back()->with('error','Item has been removed');
    }


}

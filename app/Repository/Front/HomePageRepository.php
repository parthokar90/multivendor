<?php

namespace App\Repository\Front;
date_default_timezone_set("Asia/Dhaka");
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
        ->where('status',6)
        ->take(4)
        ->get();
        return view('front.index',compact('shop','brand','slider','featured','blog','topCatPro'));
    }

    //single shop details
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
        $store->rating=5; 
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
        $coupon=CouponUser::where('user_id',auth()->user()->id)
        ->leftjoin('coupons','coupons.id','=','coupon_users.coupon_id')
        ->sum('amount');
        if($item->count()>0){
            return view('customer.cart.cartItem',compact('item','subTotal','coupon'));
        }else{
            return view('front.error.cartEmpty');
        }
    }

    //cart coupon method
    public function cartCoupon($request){
        $coupon=$request->coupon_code;
        $checkCoupon=Coupon::where('status',1)
        ->where('coupon_code',$coupon)
        ->where('expire_date','>=',date('Y-m-d'))
        ->count();   
        if($checkCoupon==0){  
           return back()->with('error','Code does not exists');
        }else{
          $coupon_data=Coupon::where('status',1)
          ->where('coupon_code',$coupon)
          ->where('expire_date','>=',date('Y-m-d'))
          ->first(); 
          $count=CouponUser::where('user_id',auth()->user()->id)->where('coupon_id',$coupon_data->id)->count();
          if($count>0){
              CouponUser::where('user_id',auth()->user()->id)->where('coupon_id',$coupon_data->id)->delete();
              $insert= new CouponUser;
              $insert->user_id=auth()->user()->id;
              $insert->coupon_id=$coupon_data->id;
              $insert->vendor_id=$coupon_data->vendor_id;
              $insert->save();
          }else{
              $insert= new CouponUser;
              $insert->user_id=auth()->user()->id;
              $insert->coupon_id=$coupon_data->id;
              $insert->vendor_id=$coupon_data->vendor_id;
              $insert->save();
          }   
        }
        return redirect()->route('cart.index');
    }

    //checkout method
    public function checkout(){
        $subTotal=0;
        $item=$this->cartItem();
        $subTotal=$this->cartSubTotal();
        $country=$this->activeCountry();
        $district=$this->activeDistrict();
        $coupon=CouponUser::where('user_id',auth()->user()->id)
        ->leftjoin('coupons','coupons.id','=','coupon_users.coupon_id')
        ->sum('amount');
        if($item->count()>0){
            return view('customer.checkout.index',compact('subTotal','coupon','country','district'));
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

    //order placed method
    public function orderPlaced($request){

    //check if ship address differeny then auth address
    if($request->ship_first_name==''){
        $ship_first_name=$request->auth_ship_first_name;
    }
    else{
        $ship_first_name=$request->ship_first_name;
    }

    if($request->ship_last_name==''){
        $ship_last_name=$request->auth_ship_last_name;
    }else{
        $ship_last_name=$request->ship_last_name;
    }

    if($request->ship_phone==''){
    $ship_phone=$request->auth_ship_phone;
    }
    else{
    $ship_phone=$request->ship_phone;
    }

    if($request->ship_country==''){
        $ship_country=$request->auth_ship_country;
    }
    else{
        $ship_country=$request->ship_country;
    }

    if($request->ship_city==''){
    $ship_city=$request->auth_ship_country;
    }
    else{
    $ship_city=$request->ship_city;
    }

    if($request->ship_zipcode==''){
    $ship_zipcode=$request->auth_ship_zipcode;
    }
    else{
    $ship_zipcode=$request->ship_zipcode;
    }

    if($request->ship_district==''){
        $ship_district=$request->auth_ship_district;
     }
      else{
      $ship_district=$request->ship_district;
    }

    $order = new Order;
    $order->user_id=auth()->user()->id;
    $order->ship_first_name=$ship_first_name;
    $order->ship_last_name=$ship_last_name;
    $order->ship_location='Bangladesh';
    $order->ship_country=$ship_country;
    $order->ship_city=$ship_city;
    $order->ship_district=$ship_district;
    $order->ship_zipcode=$ship_zipcode;
    $order->ship_phone=$ship_phone;
    $order->ship_note=$request->ship_note;
    $order->order_date=date('Y-m-d h:i:s');
    $order->status_id=1;
    $order->payment_type=$request->payment_type;
    $order->save();

    //delivery charge
    $charge=DeliveryCharge::where('district_id',$ship_district)
    ->join('product_carts','product_carts.vendor_id','=','delivery_charges.vendor_id')
    ->select('product_carts.vendor_id','delivery_charges.id as charge_id')
    ->groupBy('product_carts.vendor_id')
   ->get();
    foreach($charge as $charges){
        $store = new OrderCharge;
        $store->order_id = $order->id;
        $store->user_id = auth()->user()->id;
        $store->vendor_id = $charges->vendor_id;
        $store->charge_id = $charges->charge_id;
        $store->save();
    }
    
    $cartItem = ProductCart::where('user_id',auth()->user()->id)->get();
    foreach($cartItem as $item){
    //stock minus default product
     $product_current_stock=Product::where('id',$item->product_id)->sum('quantity');
     $cart_product_qty=ProductCart::where(['product_id'=>$item->product_id,'attribute_type_id'=>0,'attribute_value_id'=>0])->sum('quantity');
     $update_product_stock=$product_current_stock-$cart_product_qty;
     Product::where('id',$item->product_id)
     ->update([
       'quantity'=>$update_product_stock
     ]);  
  
    //stock minus attribute product
     $product_current_stock_attribute=ProductAttribute::where(['product_id'=>$item->product_id,'type_id'=>$item->attribute_type_id,'value_id'=>$item->attribute_value_id])->sum('quantity');
     $cart_product_qty_att=ProductCart::where(['product_id'=>$item->product_id,'attribute_type_id'=>$item->attribute_type_id,'attribute_value_id'=>$item->attribute_value_id])->sum('quantity');
     $update_product_stock_att=$product_current_stock_attribute-$cart_product_qty_att;
     ProductAttribute::where(['product_id'=>$item->product_id,'type_id'=>$item->attribute_type_id,'value_id'=>$item->attribute_value_id])
     ->update([
      'quantity'=>$update_product_stock_att
     ]); 
  
      $itemData = new OrderItem;
      $itemData->order_id =  $order->id;
      $itemData->product_id = $item->product_id;
      $itemData->vendor_id = $item->vendor_id;
      $itemData->shop_id = $item->shop_id;
      $itemData->attribute_id = $item->attribute_type_id;
      $itemData->attribute_value_id = $item->attribute_value_id;
      $itemData->quantity = $item->quantity;
      $itemData->status_id = 1;
      $itemData->save();
   }

    //coupon data
    $couponData=CouponUser::where('user_id',auth()->user()->id)
    ->get();

    foreach($couponData as $coupons){
    $orderCoupon = new OrderCoupon;
    $orderCoupon->order_id = $order->id;
    $orderCoupon->user_id = auth()->user()->id;
    $orderCoupon->coupon_id = $coupons->coupon_id;
    $orderCoupon->vendor_id = $coupons->vendor_id;
    $orderCoupon->save();
    }

    //delete table
    ProductCart::where('user_id',auth()->user()->id)->delete();
    CouponUser::where('user_id',auth()->user()->id)->delete();
    return redirect()->route('home.page');
 }


}

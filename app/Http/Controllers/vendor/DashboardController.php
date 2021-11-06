<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\vendor\Vendor;
use App\Http\Requests\vendor\VendorUpdateRequest;
use Illuminate\Support\Facades\Hash;
use App\Traits\CommonTrait;
use App\Models\vendor\Shop;
use App\Models\vendor\Product;
use App\Models\customer\Order;
use App\Models\customer\OrderItem;
use Illuminate\Support\Str;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

     //import trait
     use CommonTrait;
    
    //vendor dashboard
    public function index(){
        $totalProduct=Product::where('vendor_id',auth()->user()->id)->count();
        $todayOrder=OrderItem::where('vendor_id',auth()->user()->id)->whereDate('created_at',date('Y-m-d'))->count();
        $totalOrder=OrderItem::where('vendor_id',auth()->user()->id)->count();
        $totalShop=Shop::where('vendor_id',auth()->user()->id)->count();
        $todayPending=OrderItem::where(['vendor_id'=>auth()->user()->id,'status_id'=>1])->whereDate('created_at',date('Y-m-d'))->count();
        $totalPending=OrderItem::where(['vendor_id'=>auth()->user()->id,'status_id'=>1])->count();
        return view('vendor.dashboard',compact('totalProduct','todayOrder','totalOrder','totalShop','todayPending','totalPending'));
    }

    //vendor profile
    public function vendorProfile(){
        
        $id=auth()->user()->id;

        $vendor = Vendor::findOrFail($id);

        $country = $this->activeCountry();

        return view('vendor.profile.profile',compact('vendor','country'));
    }

    //pendor profile update
    public function updateVendorProfile(VendorUpdateRequest $request,$id){
           
         $vendor = Vendor::findOrFail($id);

         //check if file is upload
         $image_name='';
         if($request->hasFile('image')){
           $image_name = time().'.'.$request->image->getClientOriginalExtension();
           $request->image->move(('vendor/profile/'), $image_name);
         }else{
           $image_name=$vendor->image;
         } 

         if($request->password==''){
           $pass=$vendor->password;
         }else{
           $pass=Hash::make($request->password);
         }

         if($request->status==''){
           $status=$vendor->status;
         }else{
          $status=$request->status;
         }

         $vendor->first_name=$request->first_name;

         $vendor->last_name=$request->last_name;

         $vendor->email=$request->email;

         $vendor->password = $pass;

         $vendor->mobile=$request->mobile;

         $vendor->image=$image_name;

         $vendor->address=$request->address;

         $vendor->country_id=$request->country_id;

         $vendor->role=2;

         $vendor->city=$request->city;

         $vendor->zip_code=$request->zip_code;

         $vendor->gender=$request->gender;

         $vendor->created_by=auth()->user()->id;

         $vendor->status=$status;
     
         $vendor->save();

         //vendor shop information
         $shop=Shop::where('vendor_id',$vendor->id)->first();

         //check if file is upload
         $logo_name='';
         $banner_name='';
          if($request->hasFile('logo')){
                   $logo_name = time().'.'.$request->logo->getClientOriginalExtension();
                   $request->logo->move(('vendor/shop/'), $logo_name);
          }else{
            $logo_name= $shop->logo;
          } 

          if($request->hasFile('shop_banner')){
            $banner_name = time().'.'.$request->shop_banner->getClientOriginalExtension();
            $request->shop_banner->move(('vendor/shop/banner/'), $banner_name);
            }else{
                $banner_name= $shop->shop_banner;
            } 

            if($request->shop_status==''){
              $shop_status=$shop->status;
            }else{
              $shop_status=$request->shop_status;
            }

         $shop->shop_name=$request->shop_name;

         $shop->logo=$logo_name;

         $shop->shop_banner=$banner_name;

         $shop->shop_slug=Str::slug($request->shop_name);

         $shop->shop_address=$request->shop_address;

         $shop->vendor_id=$vendor->id;

         $shop->created_by=auth()->user()->id;

         $shop->status=$shop_status;

         $shop->save();

         return redirect()->route('vendor.profile')
         ->with('success','Profile has been updated successfully.');

    }
}

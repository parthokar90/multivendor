<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\vendor\Product;
use Illuminate\Support\Str;
use App\Traits\CommonTrait;
use App\Traits\ProductCreate;
use App\Models\vendor\Shop;
use App\Models\admin\AttributeValue;
use App\Models\customer\ProductWishlist;
use App\Models\admin\SystemStatus;
use App\Http\Requests\admin\ProductValidate;  
use App\Http\Requests\admin\ProductUpdateRequest;  
use App\Models\vendor\TempAttribute;
use App\Models\vendor\ProductAttribute;
use App\Models\vendor\ProductCategory;
use App\Models\vendor\ProductGallery;
use Session;
use DataTables;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

     //import trait
     use CommonTrait,ProductCreate;  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list=Product::where('vendor_id',auth()->user()->id)->orderBy('id','DESC')->with('brand','shop')->get();        
        if ($request->ajax()) {
            return Datatables::of($list)
                ->addIndexColumn()

                  // for brand name 
                  ->addColumn('brand', function($row){
                      $brand=$row->brand->brand_name;  
                      return $brand;
                    })

                   //for shop name  
                    ->addColumn('shop', function($row){
                      $shop=$row->shop->shop_name;  
                      return $shop;
                    })

                     //for image
                    ->addColumn('image', function($row){
                        $src=asset('vendor/product/'.$row->image);
                        return '<img src="'.$src.'" border="0" width="40" class="img-rounded" align="center" />';
                     })

                     // for status  
                    ->addColumn('status', function($row){
                        if($row->status==6){
                        $status='Publish';
                        }else{
                            $status='Unpublish';
                        }    
                        return $status;
                      })

                    //for action column

                    ->addColumn('action', function($row){
                      $btn = '<a class="btn btn-primary btn-sm" title="Edit" href="'.route('products.edit',$row->id).'"> <i class="fa fa-edit"></i></a>';
                      return $btn;
                    })

                   ->rawColumns(['brand','shop','image','status','action'])

                   ->make(true);
              }
        return view('vendor.product.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributeType=$this->activeType();
        $shop=Shop::where(['vendor_id'=>auth()->user()->id,'status'=>1])->get();
        $brand=$this->activeBrand();
        $category=$this->allParentCategory();
        TempAttribute::where('vendor_id',auth()->user()->id)->where('brouser_id',Session::getId())->delete();
        return view('vendor.product.create',compact('attributeType','shop','brand','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductValidate $request)
    {
        //check if file is upload
         $image_name='';
         if($request->hasFile('image')){
           $image_name = time().'.'.$request->image->getClientOriginalExtension();
           $request->image->move(('vendor/product/'), $image_name);
         } 

        $product = new Product;
        $product->product_name        = $request->product_name;
        $product->product_slug        = \Str::slug($product->product_name);
        $product->quantity            = $request->quantity;
        $product->alert_quantity      = $request->alert_quantity;
        $product->regular_price       = $request->regular_price;
        $product->sale_price          = $request->sale_price;
        $product->cost_price          = $request->cost_price;
        $product->image               = $image_name;
        $product->tag                 = $request->tag;
        $product->is_featured         = $request->is_featured;
        $product->stock_status        = $request->stock_status;
        $product->dimension           = $request->dimension;
        $product->short_description   = $request->short_description;
        $product->long_description    = $request->long_description;
        $product->brand_id            = $request->brand_id;
        $product->vendor_id           = auth()->user()->id;
        $product->shop_id             = $request->shop_id;
        $product->created_by          = auth()->user()->id;
        $product->status              = 5;
        $product->save();

        //product category
        $this->productCategory($product->id,$request->category_id);

        //product attribute
        $this->productAttribute(auth()->user()->id,$product->id);
       
        // gallery image
        if($request->hasFile('galleryImage'))
         {
             $galleryImage = [];
             foreach($request->file('galleryImage') as $image)
             {
                 $filename = time().'.'.$image->getClientOriginalName();
                 $image->move(('vendor/product/gallery/'), $filename);
                 $gallery = new ProductGallery;
                 $gallery->product_id =  $product->id;
                 $gallery->image =  $filename;
                 $gallery->created_by =  auth()->user()->id;
                 $gallery->status =  7;
                 $gallery->save();
             }
         }
         return redirect()->route('products.index')->with('success','Product has been saved successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $attributeType=$this->activeType();
        $shop=Shop::where(['vendor_id'=>auth()->user()->id,'status'=>1])->get();
        $brand=$this->activeBrand();
        $category=$this->activeCategory();
        TempAttribute::where('vendor_id',auth()->user()->id)->where('brouser_id',Session::getId())->delete();
        $attribute=ProductAttribute::where('product_id',$id)
        ->leftjoin('attributes','attributes.id','=','product_attributes.type_id')
        ->leftjoin('attribute_values','attribute_values.id','=','product_attributes.value_id')
        ->select('attributes.attribute_type','attribute_values.attribute','product_attributes.*')
        ->orderBy('product_attributes.id','DESC')
        ->get();
        return view('vendor.product.edit',compact('product','attributeType','shop','brand','category','attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {

       $product = Product::findOrFail($id);
        //check if file is upload
        $image_name='';
        if($request->hasFile('image')){
          $image_name = time().'.'.$request->image->getClientOriginalExtension();
          $request->image->move(('vendor/product/'), $image_name);
        }else{
          $image_name=$product->image;
        } 
       $product->product_name        = $request->product_name;
       $product->product_slug        = \Str::slug($product->product_name);
       $product->quantity            = $request->quantity;
       $product->alert_quantity      = $request->alert_quantity;
       $product->regular_price       = $request->regular_price;
       $product->sale_price          = $request->sale_price;
       $product->cost_price          = $request->cost_price;
       $product->image               = $image_name;
       $product->tag                 = $request->tag;
       $product->is_featured         = $request->is_featured;
       $product->stock_status        = $request->stock_status;
       $product->dimension           = $request->dimension;
       $product->short_description   = $request->short_description;
       $product->long_description    = $request->long_description;
       $product->brand_id            = $request->brand_id;
       $product->vendor_id           = auth()->user()->id;
       $product->shop_id             = $request->shop_id;
       $product->created_by          = auth()->user()->id;
       $product->status              = 5;
       $product->save();

       //product category
       $this->updateProductcategory($product->id,$request->category_id);

       //product attribute
       $this->productAttribute(auth()->user()->id,$product->id,Session::getId());

       
        // gallery image
        if($request->hasFile('galleryImage'))
         {
             ProductGallery::where('product_id',$id)->delete();
             $galleryImage = [];
             foreach($request->file('galleryImage') as $image)
             {
                 $filename = time().'.'.$image->getClientOriginalName();
                 $image->move(('vendor/product/gallery/'), $filename);
                 $gallery = new ProductGallery;
                 $gallery->product_id =  $product->id;
                 $gallery->image =  $filename;
                 $gallery->created_by =  auth()->user()->id;
                 $gallery->status =  7;
                 $gallery->save();
             }
         }

       return redirect()->route('products.index')->with('success','Product has been update successfully');
    }


      /**
     * attribute value ajax request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function attributeValue($id){
        $data = AttributeValue::where('type_id',$id)->where('status',1)->get();
        return response()->json($data);
    }

      /**
     * show product stock quantity.
     *
     * @return \Illuminate\Http\Response
     */
    public function productStock(){

      $list=Product::where('vendor_id',auth()->user()->id)->orderBy('id','DESC')->with('shop','productAttributeValue')->get();

      return view('vendor.product.stock.index',compact('list'));
      
    }

       /**
     * show product wishlist of login vendor.
     *
     * @return \Illuminate\Http\Response
     */
    public function productWishlist(Request $request){

        $list=ProductWishlist::where('vendor_id',auth()->user()->id)->orderBy('id','DESC')->with('product','customer')->get();
  
        if ($request->ajax()) {
            return Datatables::of($list)
                ->addIndexColumn()

                  //for product name
                  ->addColumn('product_name', function($row){
                    $product_name=optional($row->product)->product_name;
                    return $product_name;
                  })

                  // for customer name 
                  ->addColumn('customer', function($row){
                      $customer=$row->customer->first_name.'&nbsp'.$row->customer->last_name;  
                      return $customer;
                    })

                   ->rawColumns(['product_name','customer'])

                   ->make(true);
              }
            return view('vendor.product.wishlist',compact('list'));
        
      }

      //this function insert temporary attribute
      public function tempAttribute(Request $request){
        $count=TempAttribute::where(['vendor_id'=>auth()->user()->id,'type_id'=>$request->type_id,'value_id'=>$request->value_id])->count();
        if($count>0){
          TempAttribute::where(['vendor_id'=>auth()->user()->id,'type_id'=>$request->type_id,'value_id'=>$request->value_id])->delete();
        }
        $store = new TempAttribute;
        $store->vendor_id=auth()->user()->id;
        $store->brouser_id=Session::getId();
        $store->type_id=$request->type_id;
        $store->value_id=$request->value_id;
        $store->quantity=$request->att_quantity;
        $store->alert_quantity=$request->att_alert_quantity;
        $store->regular_price=$request->att_regular_price;
        $store->sell_price=$request->att_sell_price;
        $store->cost_price=$request->att_cost_price;
        $store->save();
      }

      //this function show all temporary attribute of vendor
      public function getTempAttribute(){
        $data=TempAttribute::where('vendor_id',auth()->user()->id)->where('brouser_id',Session::getId())
        ->leftjoin('attributes','attributes.id','=','temp_attributes.type_id')
        ->leftjoin('attribute_values','attribute_values.id','=','temp_attributes.value_id')
        ->select('temp_attributes.*','attribute_type','attribute')
        ->orderBy('temp_attributes.id','DESC')
        ->get();
        return response()->json($data);
      }

      //this function is using delete attribute from table
      public function deleteAttribute($id){
          TempAttribute::where('id',$id)->delete();
      }

      //this function is using delete attribute from table
      public function deleteAttributePro($id){
        return ProductAttribute::where('id',$id)->delete();
      }

      //this function edit attribute ajax request
      public function editAttributePro($id){
        return ProductAttribute::findOrFail($id);
      }

      //this function is update product attribute
      public function updateAttributePro(Request $request){
         $pro=ProductAttribute::findOrFail($request->id);
         $image_name='';
         if($request->hasFile('image')){
           $image_name = time().'.'.$request->image->getClientOriginalExtension();
           $request->image->move(('vendor/product/attribute/'), $image_name);
         }else{
           $image_name=$pro->image;
         } 
         $pro->quantity=$request->quantity;
         $pro->alert_quantity=$request->alert_quantity;
         $pro->quantity=$request->quantity;
         $pro->regular_price=$request->regular_price;
         $pro->sale_price=$request->sale_price;
         $pro->cost_price=$request->cost_price;
         $pro->image=$image_name;
         $pro->save();
         return redirect()->back()->with('success','Attribute has been update successfully');
      }


}

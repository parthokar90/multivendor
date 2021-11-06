<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\vendor\Product;
use App\Traits\CommonTrait;
use App\Models\vendor\Shop;
use App\Traits\ProductCreate;
use App\Models\vendor\TempAttribute;
use App\Models\vendor\ProductAttribute;
use Session;
use DataTables;

class ProductController extends Controller
{
    //import trait
    use CommonTrait,ProductCreate; 

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

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
                      $btn = '<a class="btn btn-primary btn-sm" title="Edit" href="'.route('admin.product.edit',$row->id).'"> <i class="fa fa-edit"></i></a>';
                      return $btn;
                    })

                   ->rawColumns(['brand','shop','image','status','action'])

                   ->make(true);
              }
        return view('admin.product.index',compact('list'));
    }

    public function edit($id){
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
        return view('admin.product.edit',compact('product','attributeType','shop','brand','category','attribute'));
    }

    //update product status
    public function update(Request $request,$id){

       $pro = Product::findOrFail($id);
       $pro->status=$request->status;
       $pro->save();
       return redirect()->route('admin.product.index')
       ->with('success','Product has been update successfully.');
    }
}

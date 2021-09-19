<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\customer\ProductReview;
use DataTables;

class ProductReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list=ProductReview::where('vendor_id',auth()->user()->id)->with('product','customer')->get();
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

                    //for review status
                    ->addColumn('status', function($row){
                         if($row->status==1){
                            $status="Approved";
                         }else{
                            $status="Reject";
                         }
                         return $status;
                       })

                    //for review rating
                    ->addColumn('rating', function($row){
                        $rating=$row->rating."&nbsp"."Rating";
                        return $rating;
                      })

                   //for action column
                    ->addColumn('action', function($row){
                      if($row->status==1){
                        $btn = '<a class="btn btn-primary btn-sm" title="Edit Review" href="'.route('reviews.edit',$row->id).'"> <i class="fa fa-edit"></i></a>';
                      }else{
                        $btn = '<a class="btn btn-primary btn-sm" title="Edit Review" href="'.route('reviews.edit',$row->id).'"> <i class="fa fa-edit"></i></a>';
                      }  
                      return $btn;
                    })


                   ->rawColumns(['product_name','customer','status','rating','action'])

                   ->make(true);
              }
        return view('vendor.product.review',compact('list'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = ProductReview::findOrFail($id);
        return view('vendor.product.reviewEdit',compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $review = ProductReview::findOrFail($id);
       $review->rating = $request->rating;
       $review->message = $request->message;
       $review->reply = $request->reply;
       $review->status = $request->status;
       $review->save();
       return redirect()->route('reviews.index')->with('success','Review has been update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

     /**
     * update the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reviewStatus($id)
    {
        //
    }


}

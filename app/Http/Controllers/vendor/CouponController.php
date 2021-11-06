<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\vendor\Coupon;
use DataTables;

class CouponController extends Controller
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
        $list=Coupon::where('vendor_id',auth()->user()->id)->orderBy('id','DESC')->get();
        if ($request->ajax()) {
            return Datatables::of($list)
                ->addIndexColumn()

                   //for action column
                    ->addColumn('action', function($row){
                     $btn = '<a class="btn btn-primary btn-sm" title="Edit Order" href="'.route('coupon.edit',$row->id).'"> <i class="fa fa-edit"></i></a>';
                     return $btn;
                    })

                   ->rawColumns(['action'])

                   ->make(true);
              }
        return view('vendor.coupon.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = new Coupon;

        $store->vendor_id=auth()->user()->id;

        $store->coupon_code=$request->coupon_code;

        $store->amount=$request->amount;

        $store->expire_date=$request->expire_date;

        $store->save();

        return redirect()->route('coupon.index')->with('success','Coupon has been saved successfully');
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
    public function edit(Coupon $Coupon)
    {
        return view('vendor.coupon.edit',compact('Coupon'));
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
      
        $store = Coupon::findOrFail($id);

        $store->vendor_id=auth()->user()->id;

        $store->coupon_code=$request->coupon_code;

        $store->amount=$request->amount;

        $store->expire_date=$request->expire_date;

        $store->save();

        return redirect()->route('coupon.index')->with('success','Coupon has been update successfully');
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
}

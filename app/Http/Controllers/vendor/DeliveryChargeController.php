<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\vendor\DeliveryCharge;
use App\Models\admin\District;
use DataTables;

class DeliveryChargeController extends Controller
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
        $list=DeliveryCharge::where('vendor_id',auth()->user()->id)->orderBy('id','DESC')->get();
        if ($request->ajax()) {
            return Datatables::of($list)
                ->addIndexColumn()

                   //for action column
                    ->addColumn('action', function($row){
                     $btn = '<a class="btn btn-primary btn-sm" title="Edit Order" href="'.route('delivery-charge.edit',$row->id).'"> <i class="fa fa-edit"></i></a>';
                     return $btn;
                    })

                   ->rawColumns(['action'])

                   ->make(true);
              }
        return view('vendor.charge.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $district = District::orderBy('id','DESC')->get();
        return view('vendor.charge.create',compact('district'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = DeliveryCharge::where('vendor_id',auth()->user()->id)->where('district_id',$request->district_id)->count();
        if($count>0){
            DeliveryCharge::where('vendor_id',auth()->user()->id)->where('district_id',$request->district_id)->delete();
        }
        $store = new DeliveryCharge;

        $store->vendor_id=auth()->user()->id;

        $store->district_id=$request->district_id;

        $store->amount=$request->amount;

        $store->save();

        return redirect()->route('delivery-charge.index')->with('success','Delivery Charge has been saved successfully');
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
    public function edit(DeliveryCharge $DeliveryCharge)
    {
        $district = District::orderBy('id','DESC')->get();
        return view('vendor.charge.edit',compact('district','DeliveryCharge'));
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
        $count = DeliveryCharge::where('vendor_id',auth()->user()->id)->where('district_id',$request->district_id)->count();
        if($count>0){
            DeliveryCharge::where('vendor_id',auth()->user()->id)->where('district_id',$request->district_id)->delete();
        }
        $store = DeliveryCharge::findOrFail($id);

        $store->vendor_id=auth()->user()->id;

        $store->district_id=$request->district_id;

        $store->amount=$request->amount;

        $store->save();

        return redirect()->route('delivery-charge.index')->with('success','Delivery Charge has been update successfully');
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

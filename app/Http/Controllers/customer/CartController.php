<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Front\HomePageService;
use App\Models\customer\ProductCart;



class CartController extends Controller
{
    protected $homeService;
    public function __construct(HomePageService $homeService)
    {
        $this->middleware('auth:web');
        $this->HomePageService = $homeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->HomePageService->cartIndex();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->HomePageService->cart($request);
    }


    //for customer cart update
    public function cartUpdate($id,$qty){
        $cart=ProductCart::findOrFail($id);
        $cart->quantity=$qty;
        $cart->sub_total=$cart->price*$qty;
        $cart->save();
        return response()->json($cart);
    }

    //for customer coupon
    public function cartCoupon(Request $request){
        return $this->HomePageService->cartCoupon($request);
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        return $this->HomePageService->cartDelete($id);
    } 
}

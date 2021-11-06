<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\customer\Order;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    //customer dashboard
    public function index(){
        $totalOrder=Order::where('user_id',auth()->user()->id)->count();
        $pendindOrder=Order::where(['user_id'=>auth()->user()->id,'status_id'=>1])->count();
        $processingOrder=Order::where(['user_id'=>auth()->user()->id,'status_id'=>2])->count();
        $deliveredOrder=Order::where(['user_id'=>auth()->user()->id,'status_id'=>3])->count();
        $cancelledOrder=Order::where(['user_id'=>auth()->user()->id,'status_id'=>4])->count();
        $todayOrder=Order::where(['user_id'=>auth()->user()->id,'order_date'=>date('Y-m-d')])->count();
        return view('customer.dashboard',compact('totalOrder','pendindOrder','processingOrder','deliveredOrder','cancelledOrder','todayOrder'));
    }
}

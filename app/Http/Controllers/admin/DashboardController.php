<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\vendor\Vendor;
use App\Models\admin\Category;
use App\Models\admin\Brand;
use App\Models\admin\Attribute;
use App\Models\vendor\Product;
use App\Models\customer\Order;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //admin dashboard
    public function index(){
        $totalCustomer=User::count();
        $totalVendor=Vendor::count();
        $totalCategory=Category::count();
        $totalBrand=Brand::count();
        $totalAttribute=Attribute::count();
        $totalProduct=Product::count();
        $todayOrder=Order::where('order_date',date('Y-m-d'))->count();
        $totalOrder=Order::count();
        return view('admin.dashboard',compact('totalCustomer','totalVendor',
        'totalCategory','totalBrand','totalAttribute','totalProduct','todayOrder','totalOrder'));
    }

    //dashboard chart list ajax request
    public function dashboardChart(){
        
        return response()->json('ok request come');
    }
}

<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Front\HomePageService;

class CheckoutController extends Controller
{
 
    public function __construct(HomePageService $homeService)
    {
        $this->middleware('auth:web');
    }

    //checkout index method
    public function index(){
        return view('customer.checkout.index');
    }
}

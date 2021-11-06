<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Front\HomePageService;


class CheckoutController extends Controller
{
    protected $homeService;
    public function __construct(HomePageService $homeService)
    {
        $this->middleware('auth:web');
        $this->HomePageService = $homeService;
    }

    //checkout index method
    public function index(){
        return $this->HomePageService->checkout();
    }

    //order placed
    public function orderPlaced(Request $request){
      return $this->HomePageService->orderPlaced($request);
    }
}

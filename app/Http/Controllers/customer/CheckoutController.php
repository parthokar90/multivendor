<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //checkout index method
    public function index(){
        return view('customer.checkout.index');
    }
}

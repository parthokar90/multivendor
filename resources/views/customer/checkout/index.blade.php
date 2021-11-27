@extends('front.layout.master')

@section('title') Checkout @endsection

@section('content')
   <!-- start banner area -->
   <section class="inner-page banner" data-img="{{asset('front/assets/images/banner.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>checkout</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                      <li class="breadcrumb-item"><a href="{{route('home.page')}}">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{route('home.page')}}">shop</a></li>
                      <li class="breadcrumb-item active" aria-current="page">checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- end banner area -->

    <!-- start checkout area -->
    <form method="post" action="{{route('customer.order.placed')}}">
        @csrf 
    <section class="checkout-page checkout cart-page cart-detail">
        <div class="container">
            <div class="row">
                <!-- billing -->
                <div class="col-lg-8">
                    <div class="billing-details">
                        <div class="title">
                            <h4>billing details</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label>First Name</label>
                                <input type="text" value="{{auth()->user()->first_name}}" name="auth_ship_first_name" placeholder="first name*" class="bill-input">
                            </div>
                            <div class="col-lg-6">
                                <label>Last Name</label>
                                <input type="text" value="{{auth()->user()->last_name}}" name="auth_ship_last_name" placeholder="last name*" class="bill-input">
                            </div>
                            <div class="col-lg-6">
                                <label>City</label>
                                <input type="text" value="{{auth()->user()->city}}" name="auth_ship_city" placeholder="town/city*" class="bill-input">
                            </div>
                            <div class="col-lg-6">
                                <label>Country</label>
                                <select class="bill-input select" name="auth_ship_country">
                                    @foreach($country as $c)
                                    <option value="{{$c->id}}">{{$c->country_name}}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label>District</label>
                                <select class="bill-input select" name="auth_ship_district">
                                    @foreach($district as $d)
                                    <option value="{{$d->id}}">{{$d->district_name}}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label>Post Code</label>
                                <input type="number" placeholder="post code*" class="bill-input" name="auth_ship_zipcode">
                            </div>
                            <div class="col-lg-12">
                                <label>Mobile</label>
                                <input type="tel" value="{{auth()->user()->mobile}}" name="auth_ship_phone" placeholder="phone*" class="bill-input">
                            </div>
                        </div>
                        <div class="create">
                            <!-- card 2 -->
                            <div class="accordion-item">
                                <div class="accordion-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <label for="term2" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Ship to a Different Address
                                            <input type="checkbox" class="check" id="term2">
                                            <span class="check-custom"></span>
                                        </label>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>First Name</label>
                                                <input type="text" name="ship_first_name" placeholder="first name*" class="bill-input">
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Last Name</label>
                                                <input type="text" name="ship_last_name" placeholder="last name*" class="bill-input">
                                            </div>
                                            <div class="col-lg-6">
                                                <label>City</label>
                                                <input type="text" name="ship_city" placeholder="town/city*" class="bill-input">
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Country</label>
                                                <select class="bill-input select" name="ship_country">
                                                    @foreach($country as $c)
                                                    <option value="{{$c->id}}">{{$c->country_name}}</option>
                                                    @endforeach 
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>District</label>
                                                <select class="bill-input select" name="ship_district">
                                                    <option value="">Select</option>
                                                    @foreach($district as $d)
                                                    <option value="{{$d->id}}">{{$d->district_name}}</option>
                                                    @endforeach 
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Post Code</label>
                                                <input type="number" placeholder="post code*" class="bill-input" name="ship_zipcode">
                                            </div>
                                            <div class="col-lg-12">
                                                <label>Mobile</label>
                                                <input type="tel" name="ship_phone" placeholder="phone*" class="bill-input">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- notes -->
                        <div class="notes">
                            <textarea name="ship_note" class="bill-input" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                        </div>
                    </div>
                </div>
                <!-- order detail -->
                <div class="col-lg-4">
                    <div class="total-content">
                        <div class="title text-center">
                            <h5>your order</h5>
                        </div>
                        <div class="sub d-flex justify-content-between">
                            <p>Subtotal:</p>
                            <p>Tk {{number_format($subTotal)}}</p>
                        </div>
                        <div class="ship">
                            <div class="d-flex justify-content-between">
                                <p>Coupon</p>
                                <p>Tk {{number_format($coupon)}}</p>
                            </div>
                        </div>
                        <div class="checkout">
                            <div class="total d-flex justify-content-between">
                                <h5>total</h5>
                                <p>Tk {{number_format($subTotal-$coupon)}}</p>
                            </div>
                            <label class="input-container">
                                <span>Direct Bank Transfer</span>
                                <input type="radio" name="payment_type" value="1" checked>
                                <span class="checkmark"></span>
                            </label>
                            <label class="input-container">
                                <span>Check Payments</span>
                                <input type="radio" name="payment_type" value="2">
                                <span class="checkmark"></span>
                            </label>
                            <label class="input-container">
                                <span>Cash on Delivery</span>
                                <input type="radio" name="payment_type" value="3">
                                <span class="checkmark"></span>
                            </label>
                            <button type="submit" style="width:100%;padding:10px 0;" class="button-style1">Place Order <span class="btn-dot"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </form>
    <!-- end checkout area -->
@endsection




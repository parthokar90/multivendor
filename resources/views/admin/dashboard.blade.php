@extends('admin.layout.master')

@section('title') Dashboard @endsection

@section('content')
 
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Dashboard</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box noradius noborder bg-danger">
                <i class="far fa-user float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Customer</h6>
                <h1 class="m-b-20 text-white counter">{{$totalCustomer}}</h1>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box noradius noborder bg-danger">
                <i class="far fa-user float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Vendor</h6>
                <h1 class="m-b-20 text-white counter">{{$totalVendor}}</h1>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box noradius noborder bg-danger">
                <i class="fas fa-certificate float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Category</h6>
                <h1 class="m-b-20 text-white counter">{{$totalCategory}}</h1>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box noradius noborder bg-danger">
                <i class="fab fa-bandcamp float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Brand</h6>
                <h1 class="m-b-20 text-white counter">{{$totalBrand}}</h1>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box noradius noborder bg-danger">
                <i class="fab fa-vaadin float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Attribute</h6>
                <h1 class="m-b-20 text-white counter">{{$totalAttribute}}</h1>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box noradius noborder bg-danger">
                <i class="fab fa-product-hunt float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Product</h6>
                <h1 class="m-b-20 text-white counter">{{$totalProduct}}</h1>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box noradius noborder bg-danger">
                <i class="fab fa-first-order-alt float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Today Orders</h6>
                <h1 class="m-b-20 text-white counter">{{$todayOrder}}</h1>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box noradius noborder bg-danger">
                <i class="fab fa-first-order-alt float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Total Orders</h6>
                <h1 class="m-b-20 text-white counter">{{$totalOrder}}</h1>
            </div>
        </div>
    </div>
    <!-- end row -->


    
</div>
<!-- END container-fluid -->

@endsection 

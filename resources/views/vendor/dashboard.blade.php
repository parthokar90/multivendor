@extends('vendor.layout.master')

@section('title') Dashboard @endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-cyan text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                    <h3 class="text-white">{{$totalProduct}}</h3>
                    <h6 class="text-white">Product</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-2 col-xlg-4">
            <div class="card card-hover">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                    <h3 class="text-white">{{$todayOrder}}</h3>
                    <h6 class="text-white">Today Order</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-danger text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
                    <h3 class="text-white">{{$totalOrder}}</h3>
                    <h6 class="text-white">Total Order</h6>
                </div>
            </div>
        </div>

        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-cyan text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
                    <h3 class="text-white">{{$todayPending}}</h3>
                    <h6 class="text-white">Today Pending Order</h6>
                </div>
            </div>
        </div>

          <!-- Column -->
          <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-danger text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
                    <h3 class="text-white">{{$totalPending}}</h3>
                    <h6 class="text-white">Total Pending Order</h6>
                </div>
            </div>
        </div>

          <!-- Column -->
          <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-cyan text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
                    <h3 class="text-white">{{$totalShop}}</h3>
                    <h6 class="text-white">Total Shop</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Site Analysis</h4>
                            <h5 class="card-subtitle">Overview of Latest Month</h5>
                        </div>
                    </div>
                    <div class="row">
                        <!-- column -->
                        <div class="col-lg-9">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-line-chart"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <div class="col-6">
                                    <div class="bg-dark p-10 text-white text-center">
                                        <i class="fa fa-user mb-1 font-16"></i>
                                        <h5 class="mb-0 mt-1">2540</h5>
                                        <small class="font-light">Total Users</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-dark p-10 text-white text-center">
                                        <i class="fa fa-plus mb-1 font-16"></i>
                                        <h5 class="mb-0 mt-1">120</h5>
                                        <small class="font-light">New Users</small>
                                    </div>
                                </div>
                                <div class="col-6 mt-3">
                                    <div class="bg-dark p-10 text-white text-center">
                                        <i class="fa fa-cart-plus mb-1 font-16"></i>
                                        <h5 class="mb-0 mt-1">656</h5>
                                        <small class="font-light">Total Shop</small>
                                    </div>
                                </div>
                                <div class="col-6 mt-3">
                                    <div class="bg-dark p-10 text-white text-center">
                                        <i class="fa fa-tag mb-1 font-16"></i>
                                        <h5 class="mb-0 mt-1">9540</h5>
                                        <small class="font-light">Total Orders</small>
                                    </div>
                                </div>
                                <div class="col-6 mt-3">
                                    <div class="bg-dark p-10 text-white text-center">
                                        <i class="fa fa-table mb-1 font-16"></i>
                                        <h5 class="mb-0 mt-1">100</h5>
                                        <small class="font-light">Pending Orders</small>
                                    </div>
                                </div>
                                <div class="col-6 mt-3">
                                    <div class="bg-dark p-10 text-white text-center">
                                        <i class="fa fa-globe mb-1 font-16"></i>
                                        <h5 class="mb-0 mt-1">8540</h5>
                                        <small class="font-light">Online Orders</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- column -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
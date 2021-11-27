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
</div>
@endsection 
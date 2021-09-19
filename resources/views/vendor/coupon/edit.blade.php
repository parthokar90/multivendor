@extends('vendor.layout.master')

@section('title') Delivery Charge Edit @endsection

@section('content')
 
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Dashboard</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Delivery Charge Edit</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card mb-3">
                <div class="card-body">
                    <form method="post" action="{{route('coupon.update',$Coupon->id)}}">
                        @csrf 
                        {{method_field('PATCH')}}
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" name="amount" value="{{$Coupon->amount}}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Expire Date</label>
                            <input type="date" name="expire_date" value="{{$Coupon->expire_date}}" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Add</button>
                    </form>
                  </div>
             </div>
        </div>
    </div>
</div>
@endsection 

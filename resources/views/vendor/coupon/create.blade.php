@extends('vendor.layout.master')

@section('title') Coupon Create @endsection

@section('content')
 
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Dashboard</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Coupon Create</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card mb-3">
                <div class="card-body">

                    <form method="post" action="{{route('coupon.store')}}">
                        @csrf 
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" name="amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Expire Date</label>
                            <input type="date" name="expire_date" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Add</button>
                    </form>
                  </div>
             </div>
        </div>
    </div>
</div>
@endsection 

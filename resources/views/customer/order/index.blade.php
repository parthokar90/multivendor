@extends('customer.layout.master')

@section('title') Order List @endsection

@section('content')
 
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Dashboard</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Order List</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card mb-3">
                <div class="card-body">
                       @include('admin.include.message')
                       <div class="table-responsive">
                            <table class="datatable table  table-hover display">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Order Date</th>  
                                        <th>Status</th>  
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list as $key=>$order)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{date('d-m-Y',strtotime($order->order_date))}}</td>
                                        <td>{{optional($order->status)->status_name}}</td>
                                        <td><a href="{{route('customer.order.edit',$order->id)}}"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                       </div>
                  </div>
             </div>
        </div>
    </div>
</div>
@endsection 

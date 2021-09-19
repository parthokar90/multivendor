@extends('vendor.layout.master')

@section('title') Product Stock List @endsection

@section('content')
 
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Dashboard</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Product Stock List</li>
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
                                        <th>Shop</th>  
                                        <th>Product</th>
                                        <th>Image</th>
                                        <th>Attribute</th>  
                                        <th>Qty</th>  
                                        <th>Action</th> 
                                    </tr>
                                </thead>

                                <tbody>
                                  @forelse($list as $key=>$item)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$item->shop->shop_name}}</td>  
                                        <td>{{$item->product_name}}</td>
                                        <td><img width="50px" height="50px" src="{{asset('vendor/product/'.$item->image)}}"></td>
                                        <th>
                                            @foreach($item->productAttributeValue as $value)
                                               <div>{{$value->attributeValue->attribute}}</div>
                                            @endforeach 
                                        </th>  
                                        <td>@if($item->productAttributeValue->count()<=0) 
                                                {{$item->quantity}} pcs 
                                                @else  
                                                @foreach($item->productAttributeValue as $value)
                                                    <div>{{$value->quantity}} pcs</div>
                                                @endforeach
                                             @endif</td>  
                                        <td><a class="btn btn-primary btn-sm" title="Edit Product" href="'.route('products.edit',$item->id).'"> <i class="fa fa-edit"></i></a></td> 
                                    </tr>
                                    @empty
                                    <p>No Product Found</p>
                                  @endforelse   
                                </tbody>
                            </table>
                       </div>
                  </div>
             </div>
        </div>
    </div>
</div>
@endsection 

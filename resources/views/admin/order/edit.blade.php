@extends('admin.layout.master')

@section('title') Order Details @endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
                <div class="breadcrumb-holder">
                    <h1 class="main-title float-left">Dashboard</h1>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Order Details</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
    </div>
    <div class="row">

      <div class="col-xl-4 col-4">
        <h4>Customer Details</h4>
        <hr>
        <div class="card">
            <div class="card-body" style="height:300px;">
               <div>@if(isset($order->customer->image)) <img width="100px" height="100px" src="{{asset('customer/profile/'.$order->customer->image)}}"> @else <img width="100px" height="100px" src="{{asset('customer/profile/no-image.jpg')}}"> @endif </div> 
               <div><b>Name:</b> {{optional($order->customer)->first_name}} {{optional($order->customer)->last_name}}</div> 
               <div><b>Email:</b> {{optional($order->customer)->email}} </div> 
               <div><b>Mobile:</b> {{optional($order->customer)->mobile}} </div> 
               <div><b>Country:</b> {{optional($order->customer->country)->country_name}} </div> 
               <div><b>District:</b> {{optional($order->customer->district)->district_name}} </div> 
               <div><b>City:</b> {{optional($order->customer)->city}} </div> 
               <div><b>Zip Code:</b> {{optional($order->customer->postCode)->post_code}} </div> 
               <div><b>Address:</b> {{optional($order->customer)->address}} </div> 
            </div>
        </div>
      </div>

      <div class="col-xl-4 col-4">
       @php $subTotal=0; $couponAmount=0; @endphp  
       <h4>Order Details</h4>
       <hr>
       <div class="card">
            <div class="card-body" style="height:300px;">
               <div><b>Order Id:  </b> # {{$order->id}} </div> 
               <div><b>Order Date:</b> {{$order->order_date}} </div> 
               <div><b>Total Items:</b> {{$totalItem}}</div> 
               <div><b>Sub Total:</b> 
               
               @foreach($order->orderItem as $key=> $item)
                    @php $details=$item->AttributeDetails($item->attribute_value_id); @endphp
                    @if(isset($item->Attribute)) 
                        @php $price=$details->sale_price; @endphp
                            @else 
                        @php $price=$item->Product->sale_price; @endphp
                    @endif
                    @php $subTotal+=$price*$item->quantity; @endphp 
               @endforeach 
               
               
               
               Tk {{number_format($subTotal)}}  @php $subTotals=$subTotal; @endphp</div> 
               <div><b>(-)Coupon:</b> Tk {{$order->coupon($order->id)}}</div> 
               <div><b>(+)Delivery Charge:</b> Tk {{$order->deliveryCharge($order->id)}}</div> 
               <div><b>Grand Total:</b> Tk {{number_format($subTotals+$order->deliveryCharge($order->id)-$order->coupon($order->id))}}</div> 
               <div><b>Status:</b> {{optional($order->status)->status_name}} </div> 
            </div>
        </div>
      </div>

      <div class="col-xl-4 col-4">
       <h4>Shipping Details</h4>
       <hr>
       <div class="card">
            <div class="card-body" style="height:300px;">
               <div><b>Address:</b> {{$order->ship_address}} </div> 
               <div><b>Location:</b> {{$order->ship_location}} </div> 
               <div><b>Country:</b> {{optional($order->shippingCountry)->country_name}} </div> 
               <div><b>District:</b> {{$order->ship_district}} </div> 
               <div><b>City:</b> {{$order->ship_city}} </div> 
               <div><b>Zipcode:</b> {{$order->ship_zipcode}} </div> 
            </div>
        </div>
        @if($order->status_id!=4)
        <form method="post" action="{{route('order_status_update',$order->id)}}">
          @csrf 
          <div class="form-group">
            <label>Change Order Status</label>
            <select class="form-control" name="status_id">
              @if($order->status_id==1)
              <option value="2" selected>Processing</option>
              <option value="3">Delivered</option>
              <option value="4">Cancelled</option>
              @endif
              @if($order->status_id==2)
              <option value="3" selected>Delivered</option>
              <option value="4">Cancelled</option>
              @endif
              @if($order->status_id==3)
              <option value="4">Cancelled</option>
              @endif
            </select>
            <button type="submit" class="btn btn-info">Update</button>
          </div>
        </form>
         @endif
      </div>

 

      <div class="col-xl-12 col-12">
        @include('admin.include.message')
        <h4>Order Item</h4>
        <hr>
        <div class="card">
            <div class="card-body">
              @if($order->status_id!=4)
                <div class="table-responsive">
                <table class="table table-bordered">
                   <tr>
                       <th>Sl</th>
                       <th>Shop</th>
                       <th>Product</th>
                       <th>Image</th>
                       <th>Stock</th>
                       <th>Price</th>
                       <th>Order Quantity</th>
                       <th>Sub Total</th>
                       <th>Quantity</th>
                       <th>Action</th>
                    </tr>

                    @forelse($order->orderItem as $key=> $item)
                    @php $details=$item->AttributeDetails($item->attribute_value_id); @endphp
                    <tr>
                      <td>{{++$key}}</td>
                      <td>{{$item->Product->Shop->shop_name}}</td>
                      <td>
                          {{optional($item->product)->product_name}} 
                             @if(isset($item->Attribute)) 
                               ({{optional($item->Attribute)->attribute}}) 
                             @endif
                      </td>
                      <td>
                          @if(isset($item->Attribute)) 
                             <img width="50px" height="50px" src="{{asset('vendor/product/attribute/'.$details->image)}}"> 
                             @else 
                             <img width="50px" height="50px" src="{{asset('vendor/product/'.optional($item->Product)->image)}}"> 
                           @endif
                      </td>
                      <td>
                         @if(isset($item->Attribute)) 
                             {{$details->quantity}} pcs
                                @php $stock=$details->quantity; @endphp
                                @else 
                                {{$item->Product->quantity}} pcs
                                @php $stock=$item->Product->quantity; @endphp
                          @endif
                      </td>
                      <td>
                         @if(isset($item->Attribute)) 
                             {{number_format($details->sale_price)}} Tk
                               @php $price=$details->sale_price; @endphp
                                @else 
                                {{number_format($item->Product->sale_price)}} Tk
                               @php $price=$item->Product->sale_price; @endphp
                          @endif
                      </td>
                      <td>{{$item->quantity}} pcs</td>
                      <td> Tk {{number_format($price*$item->quantity)}} </td>

                      <form method="post" action="{{route('customer.order.update',$item->id)}}">
                          @csrf 
                      <td><input type="number" name="quantity" min="1" max="{{$stock}}" required></td>
                      <td>
                         <button type="submit" name="action" value="minus" class="btn btn-warning"><i class="fa fa-minus"></i></button>
                         <button type="submit" name="action" value="plus" class="btn btn-success text-white"><i class="fa fa-plus"></i></button>
                      </td>
                      </form>
                    </tr>
                    @empty
                    <p>No Item Found</p>
                    @endforelse
                  </table>
                </div>
                @else 
                Order Cancelled
                @endif 
            </div>
        </div>
      </div>
  </div>
</div>
@endsection 
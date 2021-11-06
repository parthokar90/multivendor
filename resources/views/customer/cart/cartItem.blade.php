@extends('front.layout.master')

@section('title') Cart Item @endsection

@section('content')
   <!-- start banner area -->
   <section class="inner-page banner" data-img="{{asset('front/assets/images/banner.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>cart item</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                      <li class="breadcrumb-item"><a href="{{route('home.page')}}">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{route('home.page')}}">shop</a></li>
                      <li class="breadcrumb-item active" aria-current="page">cart</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- end banner area -->
   <!-- start account area -->
   <section class="cart-page cart-detail">
    <div class="container">
        @include('message.message')
        <div class="row">
            <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">shop</th>
                                    <th scope="col">image</th>
                                    <th scope="col">product name</th>
                                    <th scope="col">price</th>
                                    <th scope="col">quantity</th>
                                    <th scope="col">total</th>
                                    <th scope="col">delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($item as $carts)
                                <tr>
                                    <td class="pro-name">
                                        <a href="{{route('shop.single',array('id'=>$carts->shop->id,'slug'=>$carts->shop->shop_slug))}}">{{$carts->shop->shop_name}}</a>
                                    </td>
                                    <th scope="row" class="pro-img">
                                        <a href="shop-4-column-sidebar.html">
                                            @if(isset($carts->attributeType))
                                              <img width="50px" height="50px" src="{{asset('vendor/product/attribute/'.$carts->image)}}" alt="Product Image"/>
                                              @else 
                                               <img width="50px" height="50px" src="{{asset('vendor/product/'.$carts->image)}}" alt="Product Image"/>
                                            @endif
                                        </a>
                                    </th>
                                    <td class="pro-name">
                                        <a href="shop-4-column-sidebar.html">{{$carts->product->product_name}}</a>
                                        @if(isset($carts->attributeType))
                                        <p>{{$carts->attributeType->attribute_type}}: {{$carts->attributeValue->attribute}}</p>
                                        @endif 
                                    </td>
                                    <td class="pro-price"><p>{{number_format($carts->price)}}</p></td>
                                    <td class="pro-quantity">
                                        <div class="d-flex number-spinner justify-content-center">
                                            <input type="text" id="input-quantity-{{$carts->id}}" name="qty" class="form-control text-center input-value" value="{{$carts->quantity}}" id="cart_qty">
                                            <div class="buttons">
                                                <button onclick="qtyUp({{$carts->id}})" id="qty_up" data-dir="up" class="up-btn"><i class="flaticon-plus"></i></button>
                                                <button onclick="qtyDown({{$carts->id}})" id="qty_down" data-dir="dwn" class="down-btn"><i class="flaticon-remove"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pro-total"><p>{{number_format($carts->sub_total)}}</p></td>
                                    <td class="pro-delete">
                                        <a onclick="return confirm('are you sure want to delete??')" href="{{route('item.delete',$carts->id)}}">
                                            <i class="flaticon-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <p>No Item Found</p>
                               @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="coupon-area d-flex justify-content-between">
                        <form method="post" action="{{route('cart.coupon')}}">
                            @csrf 
                            <div class="coupon-input">
                                <input type="text" placeholder="coupon code" class="inputs" name="coupon_code">
                                <button class="button-style1">apply coupon <span class="btn-dot"></span></button>
                            </div>
                       </form>
                        <button type="button" class="button-style1">update cart <span class="btn-dot"></span></button>
                    </div>
              </div>
        </div>
    </div>
</section>
<!-- end account area -->

<!-- start cart-total area -->
<section class="cart-page cart-total">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="total-content">
                    <div class="title text-center">
                        <h5>cart total</h5>
                    </div>

                    <div class="sub d-flex justify-content-between">
                        <p>Subtotal:</p>
                        <p>Tk {{number_format($subTotal)}}</p>
                    </div>
                    <div class="sub d-flex justify-content-between">
                        <p>Discount:</p>
                        <p>Tk {{number_format($coupon)}}</p>
                    </div>
                    <div class="checkout">
                        <div class="d-flex justify-content-between">
                            <h5>total</h5>
                            <p>Tk {{number_format($subTotal-$coupon)}}</p>
                        </div>
                        <a href="{{route('customer.checkout')}}" class="button-style1">checkout <span class="btn-dot"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
 function qtyUp(id){  
    var qty = $("#input-quantity-"+id).val();
    var qtyPerse=parseInt(qty)+1;
    cartAjax(id,qtyPerse);
 }
 function qtyDown(id){
    var qty = $("#input-quantity-"+id).val();
    var qtyPerse=parseInt(qty)-1;
    cartAjax(id,qtyPerse);
 }
 function cartAjax(id,qty){
    $.ajax({
            type: 'GET',
            url: 'cart/update/'+id+"/"+qty,
            success: function (data) {
                location.reload();
            },
            error:function(data){
             console.log(data);
            },
        });
 }
</script>
@endsection




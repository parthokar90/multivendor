@extends('front.layout.master')

@section('title') Wishlist @endsection

@section('content')
   <!-- start banner area -->
   <section class="inner-page banner" data-img="{{asset('front/assets/images/banner.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>wishlist</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                      <li class="breadcrumb-item"><a href="{{route('home.page')}}">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{route('home.page')}}">shop</a></li>
                      <li class="breadcrumb-item active" aria-current="page">wishlist</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- end banner area -->
 <!-- start account area -->
 <section class="cart-page wishlist-page cart-detail">
    <div class="container">
        @include('message.message')
        <div class="row">
            <div class="col-lg-12">
                <form action="#!">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Sl</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($list as $key=>$item)
                                <tr>
                                    <td class="pro-name">
                                        {{++$key}}
                                    </td>
                                    <th scope="row" class="pro-img">
                                        <a href="{{route('product.single',array('id'=>$item->product_id,'slug'=>$item->product->product_slug))}}">
                                            <img src="{{asset('vendor/product/'.$item->product->image)}}" alt="Cart"/>
                                        </a>
                                    </th>
                                    <td class="pro-name">
                                        <a href="{{route('product.single',array('id'=>$item->product_id,'slug'=>$item->product->product_slug))}}">{{$item->product->product_name}}</a>
                                    </td>
                                    <td class="pro-delete">
                                        <a onclick="return confirm('are you sure')" href="{{route('delete.wishlist',$item->id)}}">
                                            <i class="flaticon-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <p>No Data Found</p>
                               @endforelse
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- end account area -->
@endsection




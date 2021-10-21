  @extends('front.layout.master')
  @section('title') Home @endsection
  @section('content')

    <!-- start fancybox area -->
    @include('front.include.fancybox')
    <!-- end fancybox area -->

    <!-- start banner area -->
    <section class="home1 banner" data-img="{{asset('front/assets/images/home1/banner.jpg')}}">
            <div class="banner-slider">
                @forelse ($slider as $sliders)
                <div class="slider-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-7">
                                <div class="text-area">
                                    <h4 data-animation="fadeInUp" data-delay=".2s">{{$sliders->text}}</h4>
                                    <h1 data-animation="fadeInUp" data-delay=".4s">{{$sliders->text}}</h1>
                                    <p data-animation="fadeInUp" data-delay=".6s">{{$sliders->description}}</p>
                                    <a href="shop-3-column-sidebar.html" class="button-style1" data-animation="fadeInUp" data-delay=".8s">shop now <span class="btn-dot"></span></a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-5">
                                <div class="image-area image1" data-animation="fadeInRight" data-delay=".3s">
                                    <img src="{{asset('admin/slider/'.$sliders->image)}}" alt="Banner Image"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p>No Slider Found</p>
               @endforelse
            </div>
    </section>
    <!-- end banner area -->

    <!-- start feature area -->
    @include('front.include.feature')
    <!-- end feature area -->

     <!-- start shop area -->
      <section class="home1 category">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>shop list</h3>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xl-3 col-lg-5">
                            <div class="single-category cat-height item-animation">
                                <img src="{{asset('front/assets/images/home1/category/image1.jpg')}}" alt="Category Image"/>
                                <div class="content">
                                    <h5>Latest Shop</h5>
                                    <a href="{{route('shop.all')}}">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-7">
                            <div class="row">
                                @forelse ($shop as $shops)
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                        <div class="single-category item-animation">
                                            <img src="{{asset('vendor/shop/'.$shops->logo)}}" alt="Category Image"/>
                                            <div class="content">
                                                <h5>{{$shops->shop_name}}</h5>
                                                <p>{{$shops->shopProduct($shops->id)}} products</p>
                                                <a href="{{route('shop.single',array('id'=>$shops->id,'slug'=>$shops->shop_slug))}}">view more</a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No Shop Found</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
     <!-- end shop area -->

     <!-- start category area -->
        <section class="home1 category">
          <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>product brands</h3>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xl-3 col-lg-5">
                            <div class="single-category cat-height item-animation">
                                <img src="{{asset('front/assets/images/home1/category/image1.jpg')}}" alt="Category Image"/>
                                <div class="content">
                                    <h5>latest brand</h5>
                                    <a href="{{route('brand.all')}}">view all</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-7">
                            <div class="row">
                                @forelse ($brand as $brands)
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                    <div class="single-category item-animation">
                                        <img src="{{asset('admin/brand/'.$brands->image)}}" alt="Brand Image"/>
                                        <div class="content">
                                            <h5>{{$brands->brand_name}}</h5>
                                            <p>{{$brands->countProduct($brands->id)}} products</p>
                                            <a href="{{route('brand.product',array('id'=>$brands->id,'slug'=>$brands->slug))}}">view more</a>
                                        </div>
                                    </div>
                                </div>
                                 @empty
                                 <p>No Brand Found</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
     <!-- end category area -->

     <!-- start collection area -->
        <section class="home1 collection">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h3>our top collection</h3>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @forelse ($toCat as $toCats)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">{{$toCats->category_name}}</button>
                                </li>
                            @empty
                               <p>No Collection Found</p>
                            @endforelse
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <!-- best seller -->
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    @forelse ($topCatPro as $topCatPros)
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="single-item">
                                            <div class="image-area">
                                                <a href="{{route('product.single',array('id'=>$topCatPros->id,'slug'=>$topCatPros->product_slug))}}">
                                                    <img src="{{asset('vendor/product/'.$topCatPros->image)}}" class="img-active" alt="Product Image"/>
                                                </a>
                                                <a href="{{route('product.single',array('id'=>$topCatPros->id,'slug'=>$topCatPros->product_slug))}}">
                                                    <img src="{{asset('vendor/product/'.$topCatPros->image)}}" class="img-hover" alt="Product Image"/>
                                                </a>
                                                <span class="sale-status">@if($topCatPros->stock_status==1)sale @endif</span>
                                                <div class="action">
                                                    <ul>
                                                        <li>
                                                            <a href="{{route('add.wishlist',$topCatPros->id)}}">
                                                                <i class="far fa-heart"></i>
                                                                <p class="my-tooltip">
                                                                    add to wishlist
                                                                </p>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#!" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                <i class="far fa-eye"></i>
                                                                <p class="my-tooltip">
                                                                    quick view
                                                                </p>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="bottom-area">
                                                <ul class="rating d-flex">
                                                    @for($i=0;$i<$topCatPros->averageRating($topCatPros->id);$i++)
                                                      <li><i class="fas fa-star"></i></li>
                                                    @endfor 
                                                </ul>
                                                <a href="{{route('product.single',array('id'=>$topCatPros->id,'slug'=>$topCatPros->product_slug))}}">
                                                    <h5>{{$topCatPros->product_name}}</h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <p>No Product Found</p>
                                   @endforelse
                                </div>
                            </div>
                            <!-- trending -->
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">          
      
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="single-item">
                                            <div class="image-area">
                                                <a href="shop-detail-left.html">
                                                    <img src="{{asset('front/assets/images/home1/product/p7a.jpg')}}" class="img-active" alt="Product Image"/>
                                                </a>
                                                <a href="shop-detail-left.html">
                                                    <img src="{{asset('front/assets/images/home1/product/p7b.jpg')}}" class="img-hover" alt="Product Image"/>
                                                </a>
                                                <span class="sale-status">sale</span>
                                                <div class="action">
                                                    <ul>
                                                        <li>
                                                            <a href="wishlist.html">
                                                                <i class="far fa-heart"></i>
                                                                <p class="my-tooltip">
                                                                    add to wishlist
                                                                </p>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#!" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                <i class="far fa-eye"></i>
                                                                <p class="my-tooltip">
                                                                    quick view
                                                                </p>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="cart.html">
                                                                <i class="flaticon-shopping-cart"></i>
                                                                <p class="my-tooltip">
                                                                    add to cart
                                                                </p>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="compare.html">
                                                                <i class="fas fa-sync-alt"></i>
                                                                <p class="my-tooltip">
                                                                    compare
                                                                </p>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="size">
                                                    <ul class="d-flex">
                                                        <li>
                                                            <a href="#!">s</a>
                                                        </li>
                                                        <li>
                                                            <a href="#!">m</a>
                                                        </li>
                                                        <li>
                                                            <a href="#!">l</a>
                                                        </li>
                                                        <li>
                                                            <a href="#!">xl</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="bottom-area">
                                                <ul class="rating d-flex">
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                </ul>
                                                <a href="shop-detail-left.html">
                                                    <h5>Faux suede bomber jacket</h5>
                                                </a>
                                                <p><span>$110</span> - $78</p>
                                                <a href="#!" class="add-cart button-style1">add to cart <span class="btn-dot"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- new arrival -->
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="row">
                                
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="single-item">
                                            <div class="image-area">
                                                <a href="shop-detail-left.html">
                                                    <img src="{{asset('front/assets/images/home1/product/p7a.jpg')}}" class="img-active" alt="Product Image"/>
                                                </a>
                                                <a href="shop-detail-left.html">
                                                    <img src="{{asset('front/assets/images/home1/product/p7b.jpg')}}" class="img-hover" alt="Product Image"/>
                                                </a>
                                                <span class="sale-status">sale</span>
                                                <div class="action">
                                                    <ul>
                                                        <li>
                                                            <a href="wishlist.html">
                                                                <i class="far fa-heart"></i>
                                                                <p class="my-tooltip">
                                                                    add to wishlist
                                                                </p>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#!" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                <i class="far fa-eye"></i>
                                                                <p class="my-tooltip">
                                                                    quick view
                                                                </p>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="cart.html">
                                                                <i class="flaticon-shopping-cart"></i>
                                                                <p class="my-tooltip">
                                                                    add to cart
                                                                </p>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="compare.html">
                                                                <i class="fas fa-sync-alt"></i>
                                                                <p class="my-tooltip">
                                                                    compare
                                                                </p>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="size">
                                                    <ul class="d-flex">
                                                        <li>
                                                            <a href="#!">s</a>
                                                        </li>
                                                        <li>
                                                            <a href="#!">m</a>
                                                        </li>
                                                        <li>
                                                            <a href="#!">l</a>
                                                        </li>
                                                        <li>
                                                            <a href="#!">xl</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="bottom-area">
                                                <ul class="rating d-flex">
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                </ul>
                                                <a href="shop-detail-left.html">
                                                    <h5>oversize cotton dress</h5>
                                                </a>
                                                <p><span>$110</span> - $78</p>
                                                <a href="#!" class="add-cart button-style1">add to cart <span class="btn-dot"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- end collection area -->

    <!-- start offer area -->
       <section class="home1 offer">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="item item1 item-animation" data-img="{{asset('front/assets/images/home1/offer1.jpg')}}">
                        <h5>black friday</h5>
                        <h4>Save Up To 50% Off On All Latest Fashion</h4>
                        <a href="shop-5-column.html" class="button-style1">view more <span class="btn-dot"></span></a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="item item2 item-animation" data-img="{{asset('front/assets/images/home1/offer2.jpg')}}">
                        <h5>festival season</h5>
                        <h4>Awesome Jewellery Sets for Woman</h4>
                        <a href="shop-detail-left.html" class="button-style1">buy now <span class="btn-dot"></span></a>
                    </div>
                </div>
            </div>
        </div>
      </section>
    <!-- end offer area -->

    <!-- start featured area -->
    <section class="home1 featured">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>featured product</h3>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row featured-slider">
                        @forelse ($featured as $featureds)
                        <div class="col-lg-3">
                            <div class="single-product">
                                <div class="image-area">
                                    <img src="{{asset('vendor/product/'.$featureds->image)}}" class="img-main" alt="Product Image"/>
                                    <img src="{{asset('vendor/product/'.$featureds->image)}}" class="img-hover" alt="Product Image"/>
                                    <div class="action">
                                        <ul class="d-flex">
                                            <li>
                                                <a href="{{route('add.wishlist',$featureds->id)}}">
                                                    <i class="far fa-heart"></i>
                                                    <p class="my-tooltip">add to wishlist</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#!" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <i class="far fa-eye"></i>
                                                    <p class="my-tooltip">quick view</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="bottom-area">
                                    <a href="{{route('product.single',array('id'=>$featureds->id,'slug'=>$featureds->product_slug))}}">
                                        <h5>{{$featureds->product_name}}</h5>
                                    </a>
                                    <p><span>$110</span> - $78000</p>
                                    <ul class="rating d-flex">
                                      @for($i=0;$i<$featureds->averageRating($featureds->id);$i++)
                                        <li><i class="fas fa-star"></i></li>
                                      @endfor 
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p>No Product Found</p>
                       @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end featured area -->




     <!-- start new area -->
       <section class="home1 new" data-img="{{asset('front/assets/images/home1/new-bg.jpg')}}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="content">
                            <h5>new collection</h5>
                            <h3>Get Upto 25% Off New Fashion Collection in 2021</h3>
                            <a href="shop-5-column.html">discover now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
     <!-- end new area -->

    <!-- start blog area -->
    <section class="home1 blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>from the blog</h3>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        @forelse ($blog as $blogs)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="single-blog">
                                <div class="blog-img item-animation3">
                                    <span class="item-animation3a"></span>
                                    <img src="{{asset('admin/blog/'.$blogs->image)}}" alt="Blog Image"/>
                                </div>
                                <div class="content">
                                    <a href="#!">
                                        <p>{{date('F d, Y',strtotime($blogs->created_at))}}</p>
                                    </a>
                                    <a href="{{route('blog.single',array('id'=>$blogs->id,'slug'=>$blogs->slug))}}">
                                        <h5>{{$blogs->title}}</h5>
                                    </a>
                                    <a href="{{route('blog.single',array('id'=>$blogs->id,'slug'=>$blogs->slug))}}" class="read-more">read more</a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p>No Blog Found</p>
                       @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end blog area -->


  @endsection 
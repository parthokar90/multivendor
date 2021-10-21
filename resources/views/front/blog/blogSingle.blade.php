@extends('front.layout.master')

@section('title') Blog  @endsection

@section('content') 
    <!-- start banner area -->
    <section class="inner-page banner" data-img="{{asset('front/assets/images/banner.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>blog</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                          <li class="breadcrumb-item"><a href="{{route('home.page')}}">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page">blog</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner area -->

        <!-- start blog area -->
        <section class="blog-page blog-detail">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <!-- blog area -->
                            <div class="col-xl-9 col-lg-8 all order-1 order-lg-0">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <!-- blog image -->
                                            <div class="blog-img item-animation">
                                                <img src="{{asset('front/blog/'.$blog->image)}}" alt="Blog">
                                                <div class="option">
                                                    <p>{{date('d',strtotime($blog->created_at))}} <br> {{date('f',strtotime($blog->created_at))}}</p>
                                                </div>
                                                <ul class="blog-date d-flex">
                                                    <li>
                                                        <a href="#!"><i class="flaticon-calendar"></i>{{date('f d Y',strtotime($blog->created_at))}}</a>
                                                    </li>
                                                    <li>
                                                        <a href="#!"><i class="flaticon-chat"></i>comment (03)</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-11">
                                            <!-- title -->
                                            <h4>{{$blog->title}}</h4>
                                            <!-- paragraph -->
                                            <p>{{$blog->post}}</p>
                                            <div class="share-blog d-flex justify-content-between">
                                                <div class="left-part d-flex">
                                                    <span>share : </span>
                                                    <div class="media-body">
                                                        <ul class="social d-flex">
                                                            <li><a href="#!"><i class="fab fa-facebook-f"></i></a></li>
                                                            <li><a href="#!"><i class="fab fa-pinterest-p"></i></a></li>
                                                            <li><a href="#!"><i class="fab fa-instagram"></i></a></li>
                                                            <li><a href="#!"><i class="fab fa-google-plus-g"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="right-part">
                                                    <a href="#!" class="d-flex align-items-center">
                                                        <i class="flaticon-chat"></i>
                                                        <p>comments (03)</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- comment part -->
                                            <div class="comment">
                                                <div class="title">
                                                    <h4>recent comments</h4>
                                                </div>
                                                <ul class="all-comment">
                                                    <li>
                                                        <img src="assets/images/blog/comment3.jpg" alt="Comment Author">
                                                        <div class="comment-body">
                                                            <a href="#!" class="reply d-flex align-items-center"><i class="flaticon-reply-arrow"></i><p>reply</p></a>
                                                            <a href="#!"><h4>Richard Doe</h4></a>
                                                            <a href="#!"><p class="time">September 19, 2021</p></a>
                                                            <p>Perspiciatis unde omnis iste natus error sit voluptatem accusant laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="title leave">
                                                    <h4>Leave a comment</h4>
                                                </div>
                                                <form action="#!">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <input type="text" placeholder="name*" required class="input-field"> 
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <input type="email" placeholder="email*" required class="input-field"> 
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <textarea placeholder="your comments*" required class="input-field"></textarea>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <button type="submit" class="button-style1">post comment <span class="btn-dot"></span></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- sidebar area -->
                            <div class="col-xl-3 col-lg-4 order-0 order-lg-1">
                                <div class="inner-page sidebar">
                                    <!-- section 1 -->
                                    <div class="section search">
                                        <div class="title">
                                            <h4>search blog</h4>
                                        </div>
                                        <form action="#!">
                                            <input type="search" placeholder="search here..." class="inputs">
                                            <button type="submit"><i class="flaticon-search"></i></button>
                                        </form>
                                    </div>
                                    <!-- section 2 -->
                                    <div class="section category">
                                        <div class="title">
                                            <h4>categories</h4>
                                        </div>
                                        <ul>
                                            <li>
                                                <a href="category.html" class="d-flex justify-content-between">
                                                    <p>Dairy Bread & Eggs </p>
                                                    <p>07</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- section 3 -->
                                    <div class="section popular">
                                        <div class="title">
                                            <h4>Recent Blog</h4>
                                        </div>
                                        <ul class="small-item">
                                        
                                            <li class="item d-flex align-items-center">
                                                <div class="image">
                                                    <a href="shop-detail.html">
                                                        <img src="assets/images/product/img4.jpg" alt="Product"/>
                                                    </a>
                                                </div>
                                                <div class="item-body">
                                                    <a href="shop-detail.html">
                                                        <h5>Hign Fashionable Floral Long Skirt</h5>
                                                    </a>
                                                    <p><span>$120</span> - $99</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- section 4 -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
     <!-- end blog area -->
@endsection
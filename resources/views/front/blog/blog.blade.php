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
    <section class="blog-page blog blog-masonry4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>from the blog</h3>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row grid">
                     @forelse ($blog as $blogs)
                        <div class="col-lg-3 col-md-6 grid-item">
                            <div class="single-blog">
                                <div class="blog-img item-animation3">
                                    <span class="item-animation3a"></span>
                                    <img src="{{asset('front/blog/'.$blogs->image)}}" alt="Blog">
                                </div>
                                <div class="content">
                                    <a href="#!">
                                        <p>{{date('F d, Y',strtotime($blogs->created_at))}}</p>
                                    </a>
                                    <a href="{{route('blog.single',array('id'=>$blogs->id,'slug'=>$blogs->slug))}}">
                                        <h5>{{$blogs->title}}</h5>
                                    </a>
                                    <p class="desc"> {{substr($blogs->post, 0, 10).'...' }}</p>
                                    <a href="{{route('blog.single',array('id'=>$blogs->id,'slug'=>$blogs->slug))}}" class="read-more">read more</a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p>No Blog Found</p>
                       @endforelse
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="pages">
                        <ul class="d-flex justify-content-center">
                            <li><a href="#!"><i class="flaticon-chevron-1"></i></a></li>
                            <li><a href="#!" class="active">1</a></li>
                            <li><a href="#!">2</a></li>
                            <li><a href="#!">3</a></li>
                            <li><a href="#!">4</a></li>
                            <li><a href="#!"><i class="flaticon-chevron"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end blog area -->
        
@endsection
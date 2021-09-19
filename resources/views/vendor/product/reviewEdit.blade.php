@extends('vendor.layout.master')

@section('title') Customer Review @endsection

@section('content')
 
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Dashboard</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Customer Review</li>
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
                     
                       <form action="{{route('reviews.update',$review->id)}}" method="post">
                        @csrf 
                        {{method_field('PATCH')}}

                        <div class="form-group">
                            <label>Message </label>
                            <div>
                                <textarea type="text" name="message" class="form-control">{{$review->message}}</textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Reply </label>
                            <div>
                                <textarea type="text" name="reply" class="form-control">{{$review->reply}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Rating </label>
                            <div>
                                <input type="text" name="rating" class="form-control" value="{{$review->rating}}"> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status">
                              @if($review->status==1)
                              <option value="1" selected>Approved</option>
                              <option value="0">Reject</option>
                                @else 
                                <option value="1">Approved</option>
                                <option value="0" selected>Reject</option>
                              @endif
                            </select>
                        </div>

                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-check"></i>  Update 
                            </button>
                            <a href="{{route('reviews.index')}}" class="btn btn-secondary m-l-5">
                               <i class="fas fa-chevron-right"></i>  Back
                            </a>
                        </div>

                    </form>

                  </div>
             </div>
        </div>
    </div>
</div>
@endsection 

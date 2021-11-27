@extends('customer.layout.master')

@section('title') Profile @endsection

@section('content')
 <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="{{route('customer.dashboard')}}" class="fw-normal">Dashboard</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
      
                <!-- ============================================================== -->
                <!-- PRODUCTS YEARLY SALES -->
                <!-- ============================================================== -->
                <div class="row">
                  <div class="col-md-4">
                    <div class="card">
                       <h5 class="py-3 text-center">Personal Info</h5>
                        @if($profile->image=='')
                        <div class="text-center"><img src="{{asset('customer/profile/no-image.jpg')}}" width="50px" height="50px"></div>
                        @else 
                        <div class="text-center"> <img src="{{asset('customer/profile/'.$profile->image)}}" width="50px" height="50px"></div>
                        @endif
                        <div class="py-1 text-center">Name: {{$profile->first_name}} {{$profile->last_name}}</div>
                        <div class="py-1 text-center">Email: {{$profile->email}}</div>
                        <div class="py-1 text-center">Mobile: {{$profile->mobile}}</div>
                        <div class="py-1 text-center">Address: {{$profile->address}}</div>
                        <div class="py-1 text-center">Country: {{optional($profile->country)->country_name}}</div>
                    </div>
                  </div>

                  <div class="col-md-8">
                    @include('admin.include.message')
                     <form method="post" action="{{route('customer.profile.update',$profile->id)}}" enctype="multipart/form-data">
                         @csrf 
                         <div class="form-group">
                           <label>First Name</label>
                           <input type="text" name="first_name" class="form-control" value="{{$profile->first_name}}">
                         </div>
                         <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="{{$profile->last_name}}">
                         </div>
                         <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                         </div>
                         <label>Address</label>
                         <textarea class="form-control" name="address">{{$profile->address}}</textarea>
                         <button type="submit" class="btn btn-success mt-2">Update Profile</button>
                     </form>
                  </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
@endsection 
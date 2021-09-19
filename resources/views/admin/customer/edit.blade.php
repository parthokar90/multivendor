@extends('admin.layout.master')

@section('title') Customer Edit @endsection

@section('content')
 
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Dashboard</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Customer Edit</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card mb-3">
                  <div class="card-body">
                    <form action="{{route('customers.update',$user->id)}}" method="post">
                        @csrf 
                        {{method_field('PATCH')}}

                        <div class="form-group">
                            <label>First Name </label>
                            <div>
                                <input type="text" name="first_name" value="{{$user->first_name}}" class="form-control" placeholder="First Name" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Last Name </label>
                            <div>
                                <input type="text" name="last_name" value="{{$user->last_name}}" class="form-control" placeholder="Last Name" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Email </label>
                            <div>
                                <input readonly type="text" name="email" value="{{$user->email}}" class="form-control" placeholder="Email" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Mobile </label>
                            <div>
                                <input readonly type="text" name="mobile" value="{{$user->mobile}}" class="form-control" placeholder="Mobile" />
                            </div>
                        </div>

                        <div class="form-group">
                            <img src="{{asset('customer/profile/'.$user->image)}}" width="50px" heighr="50px">
                            <label>Image <span class="text-danger">*</span></label>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status">
                              @if($user->status==1)
                              <option value="1" selected>Active</option>
                              <option value="0">Inactive</option>
                                @else 
                                <option value="1">Active</option>
                                <option value="0" selected>Inactive</option>
                              @endif
                            </select>
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-check"></i>  Update 
                            </button>
                            <button type="reset" class="btn btn-secondary m-l-5">
                                <i class="fas fa-sync-alt"></i>  Reset
                            </button>
                        </div>
                    </form>
                  </div>
             </div>
        </div>
    </div>
</div>
@endsection 

@extends('admin.layout.master')

@section('title') Slider Edit @endsection

@section('content')
 
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Dashboard</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Slider Edit</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card mb-3">
                  <div class="card-body">
                    <form action="{{route('sliders.store')}}" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="form-group">
                            <label>Title <span class="text-danger">*</span></label>
                            <div>
                                <input type="text" value="{{old('text')}}" name="text" class="form-control" placeholder="Text" required />
                            </div>
                            @if($errors->has('text'))
                            <span class="text-danger"> {{$errors->first('text')}}</span>
                           @endif
                        </div>

                        <div class="form-group">
                            <label>Link </label>
                            <div>
                                <input type="text" name="link" value="{{old('link')}}" class="form-control" placeholder="Link" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Description <span class="text-danger">*</span></label>
                            <div>
                                <textarea name="description" class="form-control" placeholder="Brand Name" required>{{old('description')}}</textarea>
                            </div>
                            @if($errors->has('description'))
                            <span class="text-danger"> {{$errors->first('description')}}</span>
                           @endif
                        </div>


                        <div class="form-group">
                            <label>Image <span class="text-danger">*</span></label>
                            <div>
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status">
                              <option value="1" selected>Active</option>
                              <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-check"></i>  Create 
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

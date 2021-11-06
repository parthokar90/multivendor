@extends('vendor.layout.master')

@section('title') Product Create @endsection

@section('content')
 
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Dashboard</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Create Product</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card mb-3">
                <div class="card-body" style="background:#e7e7e7">
                       <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
                         @csrf 
                         <div class="row">
                           <div class="col-md-9">
                             
                             <div class="form-group">
                              <label>Product Name <span class="text-danger">*</span></label>
                               <input type="text" name="product_name" class="form-control" placeholder="Product Name"/>
                               @if($errors->has('product_name'))
                               <span class="text-danger"> {{$errors->first('product_name')}}</span>
                               @endif
                             </div>

                             <div class="form-group">
                              <label>Product Description <span class="text-danger">*</span></label>
                               <textarea class="form-control" cols="5" rows="5" name="long_description" placeholder="Product Description"></textarea>
                               @if($errors->has('long_description'))
                               <span class="text-danger"> {{$errors->first('long_description')}}</span>
                               @endif
                             </div>

                             <div class="row">
                                <div class="col-3">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">General</a>
                                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Inventory</a>
                                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Shipping</a>
                                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Attribute</a>
                                    <a class="nav-link" id="v-pills-tag-tab" data-toggle="pill" href="#v-pills-tag" role="tab" aria-controls="v-pills-tag" aria-selected="false">Seo</a>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                     <h4>General Information</h4>

                                       <div class="form-group">
                                        <label>Regular Price</label>
                                        <input type="text" name="regular_price" value="0" class="form-control" placeholder="Regular Price"/>
                                       </div>

                                       <div class="form-group">
                                        <label>Sell Price</label>
                                        <input type="text" name="sale_price" value="0" class="form-control" placeholder="Sell Price"/>
                                       </div>

                                       <div class="form-group">
                                        <label>Cost Price</label>
                                        <input type="text" name="cost_price" value="0" class="form-control" placeholder="Cost Price"/>
                                       </div>

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                      <h4>Stock Information</h4>
                                      <div class="form-group">
                                        <label>Stock Status</label>
                                        <select class="form-control" name="stock_status">
                                          <option value="1">In Stock</option>
                                          <option value="0">Out Of Stock</option>
                                        </select>
                                       </div>

                                       <div class="form-group">
                                        <label>Stock Quantity</label>
                                        <input type="text" name="quantity" value="0" class="form-control" placeholder="Stock Quantity"/>
                                       </div>

                                       <div class="form-group">
                                        <label>Alert Quantity</label>
                                        <input type="text" name="alert_quantity" value="0" class="form-control" placeholder="Alert Quantity"/>
                                       </div>
                                    
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                      <h4>Shipping Information</h4>
                                       <div class="form-group">
                                        <label>Shipping</label>
                                        <input type="text" name="dimension" class="form-control" placeholder="Shipping"/>
                                       </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                    <h4>Attribute Information</h4>
                                     <div class="form-group">
                                        <label>Select Type</label>
                                        <select class="form-control" name="" id="attribute_type">
                                          <option value="">Select</option>
                                           @foreach($attributeType as $types)
                                             <option myselect="{{$types->attribute_type}}" value="{{$types->id}}">{{$types->attribute_type}}</option>
                                           @endforeach 
                                        </select>
                                     </div>

                                     <div class="form-group">
                                        <label>Value</label>
                                        <select class="form-control" name="" id="att_value">
                                          <option value="">Select Type First</option>
                                        </select>
                                     </div>

                                     <div id="att_input_div" style="display:none">
                                     <form method="POST" enctype="multipart/form-data" id="upload_image_form" action="javascript:void(0)" >
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="number" class="form-control" name="att_quantity" id="att_quantity" value="0">
                                        </div>

                                        <div class="form-group">
                                            <label>Alert Quantity</label>
                                            <input type="number" class="form-control" name="att_alert_quantity" id="att_alert_quantity" value="0">
                                        </div>

                                        <div class="form-group">
                                            <label>Regular Price</label>
                                            <input type="number" class="form-control" name="att_regular_price" id="att_regular_price" value="0">
                                        </div>

                                        <div class="form-group">
                                            <label>Sell Price</label>
                                            <input type="number" class="form-control" name="att_sell_price" id="att_sell_price" value="0">
                                        </div>

                                        <div class="form-group">
                                            <label>Cost Price</label>
                                            <input type="number" class="form-control" name="att_cost_price" id="att_cost_price" value="0">
                                        </div>

                                        </form>
                                     </div> 

                                     <button type="button" class="btn btn-success" id="add_att"><i class="fa fa-plus"></i> Add</button>
                                     <div class="table-responsive">
                                     <table class="table table-bordered mt-3" id="att_table" style="display:none">
                                     </table>
                                     </div>
                                    </div>

                                    <div class="tab-pane fade show" id="v-pills-tag" role="tabpanel" aria-labelledby="v-pills-tag-tab">
                                      <h4>Seo Information</h4>
 
                                        <div class="form-group">
                                         <label>Tag</label>
                                         <input type="text" name="tag" value="" class="form-control" placeholder="Enter Tag comma seperate"/>
                                        </div>
                                     </div>
                                    </div>
                                </div>
                             </div>
                             <div class="form-group mt-3">
                              <label>Short Description <span class="text-danger">*</span></label>
                               <textarea class="form-control" cols="5" rows="5" name="short_description" placeholder="Product Short Description"></textarea>
                               @if($errors->has('short_description'))
                               <span class="text-danger"> {{$errors->first('short_description')}}</span>
                               @endif
                             </div>
                           </div>
                           <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">

                            <div class="card mb-3">
                                <div class="card-body text-center">    
                                    <div class="row">    
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-info btn-block mt-3"> <i class="fa fa-check"></i> Create</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <!-- end card-body -->
                                <div class="card mb-3">
                                  <div class="card-header">
                                      <h4><i class="fas fa-star"></i>Featured product?</h4>
                                  </div>
                                  <div class="card-body text-center">
                                      <div class="row">
                                          <div class="col-lg-12">
                                            <input type="radio" id="f1" name="is_featured" value="1">
                                            <label for="f1"> Yes</label><br>
                                            <input type="radio" id="f2" name="is_featured" value="0" checked>
                                            <label for="f2"> No</label><br>
                                          </div>
                                      </div>
                                  </div>
                              </div> 

                                <div class="card mb-3">
                                  <div class="card-header">
                                      <h4><i class="fas fa-certificate"></i> Select Category <span class="text-danger">*</span></h4>
                                  </div>
                                  <div class="card-body text-center">
                                      <div class="row">
                                          @if($errors->has('category_id'))
                                          <span class="text-danger"> {{$errors->first('category_id')}}</span>
                                          @endif
                                          <div class="col-lg-12" style="height: 200px;  overflow-y: scroll;">
                                            @foreach($category as $categorys)
                                              <input type="checkbox" id="{{$categorys->id}}" name="category_id[]" value="{{$categorys->id}}">
                                              <label for="{{$categorys->id}}"> {{$categorys->category_name}}</label><br>
                                                @foreach($categorys->subCategory as $child)
                                                  <input class="ml-5" type="checkbox" id="{{$child->id}}" name="category_id[]" value="{{$child->id}}">
                                                  <label for="{{$child->id}}"> {{$child->category_name}}</label><br>
                                                @endforeach 
                                            @endforeach 
                                          </div>
                                      </div>
                                  </div>
                              </div>  

                              <div class="card mb-3">
                                  <div class="card-header">
                                      <h4><i class="fab fa-bandcamp"></i> Select Brand <span class="text-danger">*</span></h4>
                                  </div>
                                  <div class="card-body text-center">
                                      <div class="row">
                                          <div class="col-lg-12">
                                           <select class="form-control" name="brand_id">
                                             @foreach($brand as $brands)
                                              <option value="{{$brands->id}}">{{$brands->brand_name}} </option>
                                             @endforeach 
                                           </select>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                            <div class="card mb-3">
                              <div class="card-header">
                                  <h4><i class="fab fa-bandcamp"></i> Select Shop <span class="text-danger">*</span></h4>
                              </div>
                              <div class="card-body text-center">
                                  <div class="row">
                                      <div class="col-lg-12">
                                       <select class="form-control" name="shop_id">
                                         @foreach($shop as $shops)
                                           <option value="{{$shops->id}}">{{$shops->shop_name}}</option>
                                          @endforeach 
                                       </select>
                                      </div>
                                  </div>
                               </div>
                            </div>

                              <div class="card mb-3">
                                <div class="card-header">
                                    <h4><i class="far fa-file-image"></i> Product Image <span class="text-danger">*</span></h4>
                                </div>
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-lg-12">
                                          <input type="file" name="image" class="form-control" accept="image/*">
                                          @if($errors->has('image'))
                                          <span class="text-danger"> {{$errors->first('image')}}</span>
                                          @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <!-- end card-body -->

                             <div class="card mb-3">
                                <div class="card-header">
                                    <h4><i class="far fa-file-image"></i> Product Gallery </h4>
                                </div>
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <input type="file" name="galleryImage[]" multiple class="form-control" accept="image/*">
                                        </div>
                                    </div>
                                </div>                                
                             </div>
                           </div>
                         </div>
                      </div>
                  </div>
             </div>
        </div>
    </div>
</div>
<script>
// attribute value ajax request
 $("#attribute_type").change(function(){
    let id=$("#attribute_type").val(); 
         $.ajax({
               type:'GET',
               url:'{{url('att/value/')}}'+'/'+id,
               success:function(response) {
                $("#att_input_div").show(); 
                var schema_one = '';
                $.each(response, function(i, item) {
                    schema_one += '<option value="' + item.id + '">' + item.attribute + '</option>';
                });
                $('#att_value').html(schema_one);
               },error:function(response){
                 console.log(response);
               }
           });
      });

  //show all temporary attribute list
  function attributeList(){
    $.ajax({
               type:'GET',
               url:'{{route('list.attribute')}}',
               success:function(response) {
                var schema_one = '<tr style="border:1px solid #000000;"><th>Type</th><th>Value</th><th>Qty</th><th>Alert Qty</th><th>Regular Price</th><th>Sell Price</th><th>Cost Price</th><th>Action</th></tr>';
                $.each(response, function(i, item) {
                    schema_one += '<tr>  <td>'+item.attribute_type+'</td>  <td>'+item.attribute+'</td>  <td>'+item.quantity+'</td> <td>'+item.alert_quantity+'</td>  <td>'+item.regular_price+'</td>  <td>'+item.sell_price+'</td>  <td>'+item.cost_price+'</td> <td><button onclick="deleteAttribute('+item.id+')" type="button" class="btn btn-danger" value="'+item.id+'"><i class="fa fa-trash"></i></button></td>  </tr>';
                });
                 $('#att_table').html(schema_one);
                 $("#att_table").show();
               },error:function(response){
                 console.log(response);
               }
           });
  }    

 //attribute add click function
 $("#add_att").click(function(){
   
    let att_type = $("#attribute_type").val();
    if(att_type===''){
      alert('Select type first');
      return false;
    }
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    let types_val = $("#attribute_type :selected").val();
    let values_val = $("#att_value :selected").val();
    let att_quantity = $("#att_quantity").val();
    let att_alert_quantity = $("#att_alert_quantity").val();
    let att_regular_price = $("#att_regular_price").val();
    let att_sell_price = $("#att_sell_price").val();
    let att_cost_price = $("#att_cost_price").val();
    let att_image = $("#att_image").val();

    $.ajax({
      type:'POST',
      url:'{{route('product.temp.attribute')}}',
      data:{
        type_id:types_val,
        value_id:values_val,
        att_quantity:att_quantity,
        att_alert_quantity:att_alert_quantity,
        att_regular_price:att_regular_price,
        att_sell_price:att_sell_price,
        att_cost_price:att_cost_price,
        },
      success:function(response) {
         // ajax start
           attributeList();
         // ajax end
      },error:function(response){
        console.log(response);
      }
    });
 }); 

 //delete attribute id wise 
 function deleteAttribute(id){
    $.ajax({
               type:'GET',
               url:'{{url('delete/attribute/')}}'+'/'+id,
               success:function(response) {
                attributeList();
               },error:function(response){
                 console.log(response);
               }
           });
  }

</script>
@endsection 

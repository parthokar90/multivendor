  <!-- The Modal -->
  <div class="modal" id="attEditModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form method="post" action="{{route('up_att_pro')}}" enctype="multipart/form-data">
            @csrf 
            <input type="hidden" name="id" id="id" value="">
             <div class="form-group">
              <label>Quantity</label>
              <input type="number" name="quantity" class="form-control" id="quantity">
             </div>
             <div class="form-group">
                <label>Alert Quantity</label>
                <input type="number" name="alert_quantity" class="form-control" id="alert_quantity">
             </div>
             <div class="form-group">
                <label>Regular Price</label>
                <input type="number" name="regular_price" class="form-control" id="regular_price">
             </div>
             <div class="form-group">
                <label>Sell Price</label>
                <input type="number" name="sale_price" class="form-control" id="sale_price">
             </div>
             <div class="form-group">
                <label>Cost Price</label>
                <input type="number" name="cost_price" class="form-control" id="cost_price">
             </div>
             <div class="form-group">
                <img src="" >
                <label>Image</label>
                <input type="file" name="image" class="form-control" id="image">
             </div>
             <button type="submit" class="btn btn-success">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
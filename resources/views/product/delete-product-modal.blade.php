<div class="modal fade" id="deleteProductModal" 
     tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
          Delete Confirmation - Product <span class="productStyle"></span>
        </h4>
      </div>
      <div class="modal-body">
        <p>
          <span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
          Are you sure you want to delete Product <span class="productStyle"></span>?
        </p>
      </div>
      <div class="modal-footer">
        <span class="pull-left">
          <button type="button" 
             class="btn btn-default" 
             data-dismiss="modal">
              Cancel
          </button>
        </span>
        <span class="pull-right"> 
          <form action="{{ route('product.delete') }}" method="post">
              <input id="deleteProductStyle" type="text" name="product_style" hidden>
              <button type="submit" class="btn btn-danger">
                  Delete Product
              </button>
              {{ csrf_field() }}
          </form>
        </span>
      </div>
    </div>
  </div>
</div>
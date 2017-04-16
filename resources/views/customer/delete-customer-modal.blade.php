<div class="modal fade" id="deleteCustomerModal" 
     tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
          Delete Confirmation - Customer <span class="customerName"></span>
        </h4>
      </div>
      <div class="modal-body">
        <p>
          <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
          Are you sure you want to delete Customer <span class="customerName"></span>?
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
          <form action="{{ route('customer.delete') }}" method="post">
              <input id="deleteCustomerId" type="text" name="customer_id" hidden>
              <button type="submit" class="btn btn-danger">
                  Delete Customer
              </button>
              {{ csrf_field() }}
          </form>
        </span>
      </div>
    </div>
  </div>
</div>
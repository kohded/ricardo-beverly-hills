<div class="modal fade" id="updateInvoiceAmountModal" 
     tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
          Enter Invoice Amount - Claim #<span class="claimId"></span>
        </h4>
      </div>
      <form action="{{ route('claim.update-invoice-amount') }}" method="post">
        <div class="modal-body">
          <p>Enter Invoice Amount for Claim #<span class="claimId"></span></p>

          <div class="form-group">
            <input type="text" class="form-control" name="invoice_amount" placeholder="Enter Invoice Amount...">
          </div>
        </div>
        <div class="modal-footer">
          <span class="pull-left">
            <button type="button" 
               class="btn btn-default" 
               data-dismiss="modal">
                Cancel
            </button>
          </span>
          <input id="claimNumber" type="text" name="claim_id" hidden>
          <span class="pull-right">
            <button type="submit" class="btn btn-primary">
                <span class="fa fa-envelope" aria-hidden="true"></span>
                Update Invoice Amount
            </button>
            {{ csrf_field() }}
          </span>
        </div>
      </form>
    </div>
  </div>
</div>
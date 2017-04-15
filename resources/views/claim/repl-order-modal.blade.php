<div class="modal fade" id="convertToReplaceOrderModal" 
     tabindex="-1" role="dialog" 
     aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" 
        id="favoritesModalLabel">
          <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
          Convert Claim #<span class="claimId"></span> to Replace Order
        </h4>
      </div>
      <div class="modal-body">
        <p>
          Are you sure you would like to convert <b>Claim #<span class="claimId"></span></b> to a Replace Order?
        </p>

        <p>
          Notification e-mails will be sent to the <b>Customer</b>, and <b>Repair Center</b>.
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
          <form action="{{ route('claim.convert-to-replace-order') }}"
                method="post">
              <input id="claimNumberInput" type="number" name="claim_id" hidden>
              <button type="submit" class="btn btn-primary">
                  Convert to Replace Order
              </button>
              {{ csrf_field() }}
          </form>
        </span>
      </div>
    </div>
  </div>
</div>
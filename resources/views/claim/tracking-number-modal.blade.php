<div class="modal fade" id="enterTrackingModal" 
     tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
          Enter Tracking Number - Claim #<span class="claimId"></span>
        </h4>
      </div>
      <form action="{{ route('claim.enter-tracking-number') }}" method="post">
        <div class="modal-body">
          <p>Enter Tracking Number for Claim #<span class="claimId"></span></p>

          <div class="form-group">
            <input type="text" class="form-control" name="tracking_number" placeholder="Enter Tracking Number...">
          </div>

          <p>The recipient will receive a notification e-mail.</p>
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
            <input id="trackingClaimNumberInput" type="number" name="claim_id" hidden>
            <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                Submit Tracking Number
            </button>
            {{ csrf_field() }}
          </span>
        </div>
      </form>
    </div>
  </div>
</div>
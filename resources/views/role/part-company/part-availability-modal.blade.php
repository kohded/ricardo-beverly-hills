<div class="modal fade" id="enterPartAvailabilityModal" 
     tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
          Enter Part Availability - Claim #<span class="claimId"></span>
        </h4>
      </div>
      <form action="{{ route('pc-enter-part-availability') }}" method="post">
        <div class="modal-body">
          <p>Are the following parts available?</p>
          <p>RBH: <b><span id="partsNeeded"></span></b></p>
          <div class="radio">
            <label>
              <input class="form-check-input" type="radio" name="parts_available" value="1">
              Parts <span class="text-success">Available</span>
            </label>
          </div>
          <div class="radio">
            <label>
              <input class="form-check-input" type="radio" name="parts_available" value="0">
              Parts <span class="text-danger"><b>NOT</b> Available</span>
            </label>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="part_company_comment" placeholder="Enter Comment...">
          </div>

          <p>Ricardo Beverly Hills will be sent a notification e-mail upon submit.</p>
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
            <input id="availClaimNumberInput" type="number" name="claim_id" hidden>
            <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                Submit to Ricardo Beverly Hills
            </button>
            {{ csrf_field() }}
          </span>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="deleteClaimModal" 
     tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
          Delete Confirmation - Claim #<span class="claimId"></span>
        </h4>
      </div>
      <div class="modal-body">
        <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
        <p>Are you sure you want to delete Claim #<span class="claimId"></span></p>
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
          <form action="{{ route('claim.delete') }}" method="post">
              <input id="deleteClaimNumberInput" type="number" name="claim_id" hidden>
              <button type="submit" class="btn btn-danger">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                  Delete Claim
              </button>
              {{ csrf_field() }}
          </form>
        </span>
      </div>
    </div>
  </div>
</div>
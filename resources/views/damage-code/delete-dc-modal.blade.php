<div class="modal fade" id="deleteDamageCodeModal" 
     tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
          Delete Confirmation - Damage Code <span class="damageCodeName"></span>
        </h4>
      </div>
      <div class="modal-body">
        <p>
          <span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
          Are you sure you want to delete Damage Code <b><span class="damageCodeName"></span></b>?
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
          <form action="{{ route('damage-code.delete') }}" method="post">
              <input id="deleteDCName" type="text" name="dc_name" hidden>
              <input id="deleteDamageCodeId" type="number" name="dc_id" hidden>
              <button type="submit" class="btn btn-danger">
              	<span class="fa fa-trash" aria-hidden="true"></span>
                  Delete Damage Code
              </button>
              {{ csrf_field() }}
          </form>
        </span>
      </div>
    </div>
  </div>
</div>
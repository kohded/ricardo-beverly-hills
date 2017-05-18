<div class="modal fade" id="creditCardModal" 
     tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
          Credit Card Information Capture / Print
        </h4>
      </div>
      <div class="modal-body col-sm-12">
        <p>
          <span class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></span>
          <strong>This information MUST be printed, it will be erased once this modal closes.</strong>
        </p>
        {{--Billing Name--}}
        <div class="form-group col-sm-12">
            <label for="ccname">Name (Exactly as it appears on card)</label>
            <input type="text" class="form-control" id="customer-first-name"
                   name="ccname">
        </div>
        {{--CC Number--}}
        <div class="form-group col-sm-12">
            <label for="ccname">Credit Card Number</label>
            <input type="text" class="form-control" id="customer-first-name"
                   name="ccname">
        </div>
        {{--Expiration--}}
        <div class="form-group col-sm-3">
            <label for="ccname">Expiration</label>
            <input type="text" class="form-control" id="customer-first-name"
                   name="ccname" placeholder="##/##">
        </div>
        {{--Security Code--}}
        <div class="form-group col-sm-3">
            <label for="ccname">Security Code</label>
            <input type="text" class="form-control" id="customer-first-name"
                   name="ccname" placeholder="###">
        </div>
        {{--Address 1--}}
        <div class="form-group col-xs-12">
            <label for="ccaddress1">Billing Address 1</label>
            <input type="text" class="form-control" id="customer-address1"
                   name="ccaddress1">
        </div>
        {{--Address 2--}}
        <div class="form-group col-xs-12">
            <label for="ccaddress2">Billing Address 2</label>
            <input type="text" class="form-control" id="customer-address2"
                   name="ccaddress2">
        </div>
        {{--City--}}
        <div class="form-group col-sm-6">
            <label for="cccity">City</label>
            <input type="text" class="form-control"
                   id="cccity" name="cccity">
        </div>
        {{--State--}}
        <div class="form-group col-xs-6 col-sm-3">
            <label for="ccstate">State</label>
            <input type="text" class="form-control state-autocomplete"
                   id="ccstate" name="ccstate">
        </div>
        {{--Zip--}}
        <p><div class="form-group col-xs-6 col-sm-3">
            <label for="cczip">Zip</label>
            <input type="text" class="form-control" id="customer-zip"
                   name="cczip">
        </div>
      </div>
      <div class="modal-footer">
        <span class="pull-left">
          <button type="button" 
             class="btn btn-default" 
             data-dismiss="modal">
              Cancel / Done
          </button>
        </span>
        <span class="pull-right">
          <button type="submit" class="btn btn-primary">
              <span class="fa fa-print" aria-hidden="true"></span>
              Print
          </button>
        </span>
      </div>
    </div>
  </div>
</div>
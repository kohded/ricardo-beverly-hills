@extends('layouts.master')

@section('content')
    <div id="claim">
        <div class="row">
            <div class="col-xs-12">
                {{--<h4>{{ $title }}</h4>--}}

                <form action="" method="post">

                    <legend>New Claim</legend>

                    <div class="form-group col-xs-6">
                        <label for="inputClaimNumber">Claim Opened Date</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="mm/dd/yy">
                    </div>


                    <legend>Customer</legend>

                    <div class="form-group col-xs-5">
                        <label for="customer-first-name">First</label>
                        <input type="text" class="form-control" id="customer-first-name" placeholder="First">
                    </div>

                    <div class="form-group col-xs-5">
                        <label for="customer-last-name">Last</label>
                        <input type="text" class="form-control" id="customer-last-name" placeholder="Last">
                    </div>

                    <div class="form-group col-xs-12">
                        <label for="customer-address-1">Address 1</label>
                        <input type="text" class="form-control" id="customer-address-1" placeholder="Address 1">
                    </div>

                    <div class="form-group col-xs-12">
                        <label for="customer-address-2">Address 2</label>
                        <input type="text" class="form-control" id="customer-address-2" placeholder="Address 2">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="customer-city">City</label>
                        <input type="text" class="form-control" id="customer-city" placeholder="City">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="customer-state">State</label>
                        <input type="text" class="form-control" id="customer-state" placeholder="State">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="customer-zip">Zip</label>
                        <input type="text" class="form-control" id="customer-zip" placeholder="Zip">
                    </div>

                    <div class="form-group col-xs-2">
                        <label for="customer-phone">Phone</label>
                        <input type="text" class="form-control" id="customer-phone" placeholder="Home Phone">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="customer-email">Email</label>
                        <input type="text" class="form-control" id="customer-email" placeholder="Email">
                    </div>

                    <legend>Action Taken to this Claim</legend>

                        <div class="form-check col-xs-3">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="action-options"
                                       value="send-replacement">
                                Send Replacement Parts
                            </label>
                        </div>

                        <div class="col-xs-1"><b>OR</b></div>

                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="action-options" value="refer-repair">
                                Referred to Repair Center
                            </label>
                        </div>

                    <br>

                    <div class="form-group col-xs-8">
                        <label for="inputClaimNumber">Repair Center</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="inputClaimNumber">Referred Date</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="">
                    </div>

                    <div class="form-group col-xs-8">
                        <label for="inputClaimNumber">Address</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="inputClaimNumber">Phone #</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="">
                    </div>

                    <div class="form-group col-xs-3">
                        <label for="inputClaimNumber">City</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="">
                    </div>

                    <div class="form-group col-xs-3">
                        <label for="inputClaimNumber">State</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="">
                    </div>

                    <div class="form-group col-xs-3">
                        <label for="inputClaimNumber">Zip</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="">
                    </div>

                    <div class="form-group col-xs-3">
                        <label for="inputClaimNumber">Fax #</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="">
                    </div>

                    <legend>Recommendation From Repair Center</legend>

                    <div class="form-check col-xs-1">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="recommended-options"
                                   value="repair">
                            Repair
                        </label>
                    </div>

                    <div class="col-xs-1"><b>OR</b></div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="recommended-options" value="replace">
                            Replace
                        </label>
                    </div>

                    <br>

                    <div class="form-group col-xs-12">
                        <label for="inputClaimNumber">Claim Follow Up</label>
                        <textarea class="col-xs-12"></textarea>
                    </div>

                    <div class="form-group col-xs-3">
                        <label for="inputClaimNumber">Repair Bill #</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="">
                    </div>

                    <div class="form-group col-xs-3">
                        <label for="inputClaimNumber">Cost of Repair</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="">
                    </div>


                    <button type="submit" class="btn btn-primary col-xs-12">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
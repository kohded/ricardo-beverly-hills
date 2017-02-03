@extends('layouts.master')

@section('content')
    <div id="claim">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                {{--<h4>{{ $title }}</h4>--}}

                <form>

                    <legend>Create New Claim</legend>

                    <legend>Customer</legend>

                    <div class="form-group col-xs-6">
                        <label for="customer-first-name">First</label>
                        <input type="text" class="form-control" id="customer-first-name" placeholder="First">
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="customer-last-name">Last</label>
                        <input type="text" class="form-control" id="customer-last-name" placeholder="Last">
                    </div>

                    <div class="form-group col-xs-12">
                        <label for="inputClaimNumber">Address 1</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="Address 1">
                    </div>

                    <div class="form-group col-xs-12">
                        <label for="inputClaimNumber">Address 2</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="Address 2">
                    </div>

                    <div class="form-group col-xs-7">
                        <label for="inputClaimNumber">City</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="City">
                    </div>

                    <div class="form-group col-xs-2">
                        <label for="inputClaimNumber">State</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="State">
                    </div>

                    <div class="form-group col-xs-3">
                        <label for="inputClaimNumber">Zip</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="Zip">
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="inputClaimNumber">Phone</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="Home Phone">
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="inputClaimNumber">Email</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="Email">
                    </div>
                    <div class="col-xs-12">
                        <hr />
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-4 text-right">
                            <label for="claim-product">Product</label>
                        </div>

                        <div class="form-group col-xs-8">
                            <select id="claim-product">
                                @foreach ($products as $product)
                                    <option value="{{ $product->style }}">
                                        {{ $product->style }} -  
                                        {{ $product->class }} - 
                                        {{ $product->color }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-4 text-right">
                            <label for="claim-damage-code">Damage Code</label>
                        </div>

                        <div class="form-group col-xs-8">
                            <select id="claim-damage-code">
                                @foreach ($damage_codes as $dc)
                                    <option value="{{ $dc->id }}">{{ $dc->id . '-' . $dc->part }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-4 text-right">
                            <label for="claim-repair-center">Repair Center</label>
                        </div>

                        <div class="form-group col-xs-8">
                            <select id="claim-repair-center">
                                @foreach ($repair_centers as $rc)
                                    <option value="{{ $rc->id }}">{{ $rc->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <legend>Action Taken to this Claim</legend>

                        <div class="form-check col-xs-5">
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

                    <br />

                    <legend>Recommendation From Repair Center</legend>

                    <div class="form-check col-xs-2">
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

                    <div class="form-group col-xs-12">
                        <label for="inputClaimNumber">Comment</label>
                        <textarea class="col-xs-12"></textarea>
                    </div>


                    <button type="submit" class="btn btn-primary col-xs-12">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
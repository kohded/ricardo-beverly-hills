@extends('layouts.master')

@section('content')
    <div id="claim">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                {{--<h4>{{ $title }}</h4>--}}

                <form action="{{ URL::route('claim.create') }}" method="post">

                    <legend>Create New Claim</legend>

                    <legend>Customer</legend>

                    <div class="form-group col-xs-6">
                        <label for="customer-first-name">First</label>
                        <input type="text" class="form-control" id="customer-first-name" name="firstname" placeholder="First">
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="customer-last-name">Last</label>
                        <input type="text" class="form-control" id="customer-last-name" name="lastname" placeholder="Last">
                    </div>

                    <div class="form-group col-xs-12">
                        <label for="customer-address1">Address 1</label>
                        <input type="text" class="form-control" id="customer-address1" name="address1" placeholder="Address 1">
                    </div>

                    <div class="form-group col-xs-12">
                        <label for="customer-address2">Address 2</label>
                        <input type="text" class="form-control" id="customer-address2" name="address2" placeholder="Address 2">
                    </div>

                    <div class="form-group col-xs-7">
                        <label for="customer-city">City</label>
                        <input type="text" class="form-control" id="customer-city" name="city" placeholder="City">
                    </div>

                    <div class="form-group col-xs-2">
                        <label for="customer-state">State</label>
                        <input type="text" class="form-control" id="customer-state" name="state" placeholder="WA ">
                    </div>

                    <div class="form-group col-xs-3">
                        <label for="customer-zip">Zip</label>
                        <input type="text" class="form-control" id="customer-zip" name="zip" placeholder="Zip">
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="customer-phone">Phone</label>
                        <input type="text" class="form-control" id="customer-phone" name="phone" placeholder="###-###-####">
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="customer-email">Email</label>
                        <input type="text" class="form-control" id="customer-email" name="email" placeholder="Email">
                    </div>
                    <div class="col-xs-12">
                        <hr />
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-4 text-right">
                            <label for="claim-product">Product</label>
                        </div>

                        <div class="form-group col-xs-8">
                            <select name="products" id="claim-product">
                                @foreach ($products as $product)
                                    <option name="products" value="{{ $product->style }}">
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
                            <select name="damagecode" id="claim-damage-code">
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
                            <select name="repaircenter" id="claim-repair-center">
                                @foreach ($repair_centers as $rc)
                                    <option value="{{ $rc->id }}">{{ $rc->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <legend>Action Taken to this Claim</legend>

                        <div class="form-check col-xs-5">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="" value=1>
                                Send Replacement Parts
                            </label>
                        </div>

                        <div class="col-xs-1"><b>OR</b></div>

                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="" value=0>
                                Referred to Repair Center
                            </label>
                        </div>

                    <br />

                    <legend>Recommendation From Repair Center</legend>

                    <div class="form-check col-xs-2">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="replaced" value="0">
                            Repair
                        </label>
                    </div>

                    <div class="col-xs-1"><b>OR</b></div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="replaced" value="1">
                            Replace
                        </label>
                    </div>

                    <div class="form-group col-xs-12">
                        <label for="inputClaimNumber">Comment</label>
                        <textarea class="col-xs-12" name="comment"></textarea>
                    </div>

                    {{ csrf_field() }}

                    <button type="submit" class="btn btn-primary col-xs-12" name="submit">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
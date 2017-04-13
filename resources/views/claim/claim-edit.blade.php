@extends('layouts.master')

@section('content')
    <div id="claim">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">

                @if(count($errors->all()))
                    <div class="col-xs-offset-3 col-xs-6 alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error  }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{--Form successfully added product--}}
                @if(Session::has('message'))
                    <div class="row">
                        <div class="col-xs-offset-3 col-xs-6">
                            <p class="alert alert-success text-center">
                                {{ Session::get('message') }}
                            </p>
                        </div>
                    </div>
                @endif

                <form action="{{ URL::route('claim.create') }}" method="post">

                    <legend>{{ $title }}</legend>

                    <legend>Customer</legend>

                    <a href="#claim-existing-customer" class="btn btn-info col-xs-8 col-xs-offset-2" data-toggle="collapse">Existing Customer</a>
                    <div id="claim-existing-customer" class="collapse form-group col-xs-8 col-xs-offset-2">
                        <label for="customer-email">Existing Customer Email</label>
                        <input type="text" class="form-control" id="existing-customer-email" name="existingcustomeremail" value="{{ $customerDetails['customer'][0]->email }}"
                        >
                    </div>

                    <br />
                    <br />

                    <a href="#claim-new-customer" class="btn btn-info col-xs-8 col-xs-offset-2" data-toggle="collapse">New Customer</a>
                    <div id="claim-new-customer" class="collapse col-xs-12">
                        <div class="form-group col-xs-6">
                            <label for="customer-first-name">First</label>
                            <input type="text" class="form-control" id="customer-first-name" name="firstname"
                                   placeholder="First" >
                        </div>

                        <div class="form-group col-xs-6">
                            <label for="customer-last-name">Last</label>
                            <input type="text" class="form-control" id="customer-last-name" name="lastname"
                                   placeholder="Last" >
                        </div>

                        <div class="form-group col-xs-12">
                            <label for="customer-address1">Address 1</label>
                            <input type="text" class="form-control" id="customer-address1" name="address1"
                                   placeholder="Address 1" >
                        </div>

                        <div class="form-group col-xs-12">
                            <label for="customer-address2">Address 2</label>
                            <input type="text" class="form-control" id="customer-address2" name="address2"
                                   placeholder="Address 2">
                        </div>

                        <div class="form-group col-xs-7">
                            <label for="customer-city">City</label>
                            <input type="text" class="form-control" id="customer-city" name="city" placeholder="City"
                            >
                        </div>

                        <div class="form-group col-xs-2">
                            <label for="customer-state">State</label>
                            <input type="text" class="form-control" id="customer-state" name="state" placeholder="WA "
                            >
                        </div>

                        <div class="form-group col-xs-3">
                            <label for="customer-zip">Zip</label>
                            <input type="text" class="form-control" id="customer-zip" name="zip" placeholder="Zip"
                            >
                        </div>

                        <div class="form-group col-xs-6">
                            <label for="customer-phone">Phone</label>
                            <input type="text" class="form-control" id="customer-phone" name="phone"
                                   placeholder="###-###-####" >
                        </div>

                        <div class="form-group col-xs-6">
                            <label for="customer-email">Email</label>
                            <input type="text" class="form-control" id="customer-email" name="email" placeholder="Email"
                            >
                        </div>

                    </div>
                    <div class="col-xs-12">
                        <hr/>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-4 text-right">
                            <label for="claim-product">Product</label>
                        </div>

                        <div class="form-group col-xs-8">
                            <select name="products" id="claim-product" >
                                @foreach ($products as $product)
                                    @if($product->style != $claimDetails->product_style)
                                        <option name="products" value="{{ $product->style }}">
                                            {{ $product->style }} -
                                            {{ $product->collection }} -
                                            {{ $product->color }}
                                        </option>
                                    @else
                                        <option name="products" value="{{ $product->style }}" selected>
                                            {{ $product->style }} -
                                            {{ $product->collection }} -
                                            {{ $product->color }}
                                        </option>
                                    @endif
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
                                    @if($dc->id != $claimDetails->dc_id)
                                        <option value="{{ $dc->id }}">{{ $dc->id . '-' . $dc->part }}</option>
                                    @else
                                        <option value="{{ $dc->id }}" selected>{{ $dc->id . '-' . $dc->part }}</option>
                                    @endif
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
                                    @if($rc->id != $claimDetails->rc_id)
                                        <option value="{{ $rc->id }}">{{ $rc->name }}</option>
                                    @else
                                        <option value="{{ $rc->id }}" selected>{{ $rc->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <br/>

                    <legend>Recommendation From Repair Center</legend>

                    <div class="form-check col-xs-2">
                        <label class="form-check-label">
                            @if($claimDetails->replaced == 0)
                                <input class="form-check-input" type="radio" name="replaced" value="0" checked>
                            @else
                                <input class="form-check-input" type="radio" name="replaced" value="0">
                            @endif

                            Repair
                        </label>
                    </div>

                    <div class="col-xs-1"><b>OR</b></div>

                    <div class="form-check">
                        <label class="form-check-label">
                            @if($claimDetails->replaced == 1)
                                <input class="form-check-input" type="radio" name="replaced" value="1" checked>
                            @else
                                <input class="form-check-input" type="radio" name="replaced" value="1">
                            @endif
                            Replace
                        </label>
                    </div>

                    <div class="form-group col-xs-12">
                        <label for="inputClaimNumber">Comment</label>
                        <textarea class="col-xs-12" name="comment"></textarea>
                    </div>

                    <input type="hidden" name="id" value="{{ $claimDetails->claim_id}}">

                    {{ csrf_field() }}

                    <button type="submit" class="btn btn-primary col-xs-12" name="submit">Submit</button>
                </form>

            </div>
        </div>
    </div>

    <script>
        var firstNameTxt = document.getElementById("customer-first-name");
            firstNameTxt.onclick = function (){
                document.getElementById("existing-customer-email").value = "";
            }

        var existCustTxt = document.getElementById("existing-customer-email");
        existCustTxt.onclick = function (){
            document.getElementById("customer-first-name").value = "";
            document.getElementById("customer-last-name").value = "";
            document.getElementById("customer-address1").value = "";
            document.getElementById("customer-address2").value = "";
            document.getElementById("customer-city").value = "";
            document.getElementById("customer-state").value = "";
            document.getElementById("customer-zip").value = "";
            document.getElementById("customer-phone").value = "";
            document.getElementById("customer-email").value = "";
        }
    </script>
@endsection
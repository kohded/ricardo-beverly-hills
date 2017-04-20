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

                <form action="{{ URL::route('update-claim') }}" method="post">

                    <legend>Edit Claim</legend>

                    <legend>Customer</legend>

                    <a href="#claim-existing-customer" id="existing-customer" class="btn btn-info col-xs-8 col-xs-offset-2">Existing Customer</a>
                    <div id="existing-customer-field" class="form-group col-xs-8 col-xs-offset-2">
                        <label for="customer-email">Existing Customer Email</label>
                        <input type="text" class="form-control" name="existing_customer_email" value="{{ $customerDetails['customer'][0]->email }}"
                        >
                    </div>

                    <br />
                    <br />

                    <a href="#claim-new-customer" id="edit-customer-info" class="btn btn-info col-xs-8 col-xs-offset-2" >Edit Customer Information</a>
                    <div id="claim-new-customer" class="col-xs-12">
                        <div class="form-group col-xs-6">
                            <label for="customer-first-name">First</label>
                            <input type="text" class="form-control" id="customer-first-name" name="firstname"
                                   value="{{ $customerDetails['customer'][0]->first_name }}" >
                        </div>

                        <div class="form-group col-xs-6">
                            <label for="customer-last-name">Last</label>
                            <input type="text" class="form-control" id="customer-last-name" name="lastname"
                                   value="{{ $customerDetails['customer'][0]->last_name }}" >
                        </div>

                        <div class="form-group col-xs-12">
                            <label for="customer-address1">Address 1</label>
                            <input type="text" class="form-control" id="customer-address1" name="address1"
                                   value="{{ $customerDetails['customer'][0]->address }}" >
                        </div>

                        <div class="form-group col-xs-12">
                            <label for="customer-address2">Address 2</label>
                            <input type="text" class="form-control" id="customer-address2" name="address2"
                                   value="{{ $customerDetails['customer'][0]->address_2 }}">
                        </div>

                        <div class="form-group col-xs-7">
                            <label for="customer-city">City</label>
                            <input type="text" class="form-control" id="customer-city" name="city" value="{{ $customerDetails['customer'][0]->city }}"
                            >
                        </div>

                        <div class="form-group col-xs-2">
                            <label for="customer-state">State</label>
                            <input type="text" class="form-control" id="customer-state" name="state" value="{{ $customerDetails['customer'][0]->state }}"
                            >
                        </div>

                        <div class="form-group col-xs-3">
                            <label for="customer-zip">Zip</label>
                            <input type="text" class="form-control" id="customer-zip" name="zip" value="{{ $customerDetails['customer'][0]->zip }}"
                            >
                        </div>

                        <div class="form-group col-xs-6">
                            <label for="customer-phone">Phone</label>
                            <input type="text" class="form-control" id="customer-phone" name="phone"
                                   value="{{ $customerDetails['customer'][0]->phone }}" >
                        </div>

                        <div class="form-group col-xs-6">
                            <label for="customer-email">Email</label>
                            <input type="text" class="form-control" id="customer-email" name="email" value="{{ $customerDetails['customer'][0]->email }}"
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
                            <select name="damage_code" id="claim-damage-code">
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
                            <select name="repair_center" id="claim-repair-center">
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

                    <dl class="dl-horizontal">
                        <dt>Claim Type</dt>
                        <dd>
                            <div class="form-check">
                                <label class="form-check-label">
                                    @if($claimDetails->replace_order == 0)
                                        <input class="form-check-input" type="radio" name="replace_order" value="0" checked="checked">
                                    @else
                                        <input class="form-check-input" type="radio" name="replace_order" value="0">
                                    @endif
                                    <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                                    Repair Order
                                </label>
                            </div>
                        </dd>
                        <dd>
                            <div class="form-check">
                                <label class="form-check-label">
                                    @if($claimDetails->replace_order == 1)
                                        <input class="form-check-input" type="radio" name="replace_order" value="1" checked="checked">
                                    @else
                                        <input class="form-check-input" type="radio" name="replace_order" value="1">
                                    @endif
                                    <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                                    Replace Order
                                </label>
                            </div>
                        </dd>

                        <br />

                        <dt>Parts Required?</dt>
                        <dd>
                            <div class="form-check">
                                <label class="form-check-label">
                                    @if($claimDetails->part_needed == '1')
                                        <input class="form-check-input" type="radio" name="part_needed" value="1" checked="checked">
                                    @else
                                        <input class="form-check-input" type="radio" name="part_needed" value="1">
                                    @endif
                                    Yes
                                </label>
                            </div>
                        </dd>
                        <dd>
                            <div class="form-check">
                                <label class="form-check-label">
                                    @if($claimDetails->part_needed == '0')
                                        <input class="form-check-input" type="radio" name="part_needed" value="0" checked="checked">
                                    @else
                                        <input class="form-check-input" type="radio" name="part_needed" value="0">
                                    @endif
                                    No
                                </label>
                            </div>
                        </dd>

                        <br />


                        <dt>Parts Needed</dt>
                        <dd>
                            <input type="text" class="form-control" name="parts_needed" value="{{$claimDetails->parts_needed}}">
                        </dd>

                        <br />

                        <dt>Ship Parts To</dt>
                        <dd>
                            <div class="form-check">
                                <label class="form-check-label">
                                    @if($claimDetails->ship_to == "Customer")
                                        <input class="form-check-input" type="radio" name="ship_to" value="Customer" checked="checked">
                                    @else
                                        <input class="form-check-input" type="radio" name="ship_to" value="Customer">
                                    @endif
                                    Customer
                                </label>
                            </div>
                        </dd>
                        <dd>
                            <div class="form-check">
                                <label class="form-check-label">
                                    @if($claimDetails->ship_to == "Repair Center")
                                        <input class="form-check-input" type="radio" name="ship_to" value="Repair Center" checked="checked">
                                    @else
                                        <input class="form-check-input" type="radio" name="ship_to" value="Repair Center">
                                    @endif
                                    Repair Center
                                </label>
                            </div>
                        </dd>
                    </dl>
                    

                    <input type="hidden" name="claim_id" value="{{ $claimDetails->claim_id}}">
                    <input type="hidden" name="customer_id" value="{{ $customerDetails['customer'][0]->id}}">
                    <input type="hidden" id="edit-type-switch" name="edit_type_switch" value="1">

                    {{ csrf_field() }}

                    <button type="submit" class="btn btn-primary col-xs-12" name="submit">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
@extends('layouts.master-narrow')

@section('content')
    <div id="claim-create" class="hidden-print">
        <div class="row">
            <div class="col-xs-12">
                <h2>Create Claim</h2>
                <hr>
            </div>
        </div>
        {{--Form successfully created claim--}}
        @if(Session::has('message'))
            <div class="row">
                <div class="col-xs-12">
                    <p class="alert alert-success">
                        {{ Session::get('message') }}
                    </p>
                </div>
            </div>
        @endif
        {{--Form validation errors--}}
        @if(count($errors) > 0)
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <form id="newClaimForm" action="{{ URL::route('claim.create') }}" method="post">
                {{--Existing Customer Button--}}
                <div class="col-xs-6">
                    <a href="#existing-customer-field" id="existing-customer"
                       class="btn btn-primary col-xs-12 mt-20 mb-20" data-toggle="collapse">
                        Existing Customer
                    </a>
                </div>
                {{--New Customer Button--}}
                <div class="col-xs-6">
                    <a href="#claim-new-customer" id="edit-customer-info"
                       class="btn btn-primary col-xs-12 mt-20 mb-20" data-toggle="collapse">
                        New Customer
                    </a>
                </div>
                {{--Existing Customer Field--}}
                <div id="existing-customer-field"
                    @if (old('edit_type_switch') !== "1")
                        class="collapse"
                    @endif
                    >
                    {{--Email--}}
                    <div class="form-group col-xs-12">
                        <label for="existing-customer-email">Email</label>
                        <input type="text" class="form-control customer-email-autocomplete"
                               id="existing-customer-email" name="existing_customer_email"
                               placeholder="email@example.com" value="{{ old('existing_customer_email') }}">
                    </div>
                </div>
                {{--New Customer Fields--}}
                <div id="claim-new-customer"
                    @if (old('edit_type_switch') !== "0")
                        class="collapse"
                    @endif
                    >
                    {{--First Name--}}
                    <div class="form-group col-sm-6">
                        <label for="customer-first-name">First Name</label>
                        <input type="text" class="form-control" id="customer-first-name"
                               name="firstname"
                               value="{{ old('firstname') }}">
                    </div>
                    {{--Last Name--}}
                    <div class="form-group col-sm-6">
                        <label for="customer-last-name">Last Name</label>
                        <input type="text" class="form-control"
                               id="customer-last-name" name="lastname"
                               value="{{ old('lastname') }}">
                    </div>
                    {{--Phone--}}
                    <div class="form-group col-sm-6">
                        <label for="customer-phone">Phone</label>
                        <input type="text" class="form-control" id="customer-phone" name="phone"
                               placeholder="##########"
                               value="{{ old('phone') }}">
                    </div>
                    {{--Email--}}
                    <div class="form-group col-sm-6">
                        <label for="customer-email">Email</label>
                        <input type="text" class="form-control" id="customer-email" name="email"
                               placeholder="email@example.com"
                               value="{{ old('email') }}">
                    </div>
                    {{--Address 1--}}
                    <div class="form-group col-xs-12">
                        <label for="customer-address1">Address 1</label>
                        <input type="text" class="form-control" id="customer-address1"
                               name="address1"
                               value="{{ old('address1') }}">
                    </div>
                    {{--Address 2--}}
                    <div class="form-group col-xs-12">
                        <label for="customer-address2">Address 2</label>
                        <input type="text" class="form-control" id="customer-address2"
                               name="address2"
                               value="{{ old('address2') }}">
                    </div>
                    {{--City--}}
                    <div class="form-group col-sm-6">
                        <label for="customer-city">City</label>
                        <input type="text" class="form-control"
                               id="customer-city" name="city"
                               value="{{ old('city') }}">
                    </div>
                    {{--State--}}
                    <div class="form-group col-xs-6 col-sm-3">
                        <label for="customer-state">State</label>
                        <input type="text" class="form-control state-autocomplete"
                               id="customer-state" name="state" placeholder="WA"
                               value="{{ old('state') }}">
                    </div>
                    {{--Zip--}}
                    <div class="form-group col-xs-6 col-sm-3">
                        <label for="customer-zip">Zip</label>
                        <input type="text" class="form-control" id="customer-zip"
                               name="zip" placeholder="#####"
                               value="{{ old('zip') }}">
                    </div>
                </div>
                <div id="claim-order-details" class="collapse">
                    {{--Product--}}
                    <div class="form-group col-xs-12">
                        <label for="claim-product">Product</label>
                        <input type="text" class="form-control product-autocomplete"
                               id="claim-product" name="products" value="{{ old('products') }}">
                        <input type="text"  class="product-style" name="product-style"
                               value="{{ old('product-style') }}" hidden>
                    </div>
                    {{--Damage Code--}}
                    <div class="form-group col-xs-12">
                        <label for="claim-damage-code">Damage Code</label>
                        <input type="text" class="form-control damage-code-autocomplete"
                               id="claim-damage-code" name="damage_code" value="{{ old('damage_code') }}">
                        <input type="text"  class="damage-code-id" name="damage-code-id"
                               value="{{ old('damage-code-id') }}" hidden>
                    </div>
                    {{--Repair Center--}}
                    <div class="form-group col-xs-12">
                        <label for="claim-repair-center">Repair Center</label>
                        <input type="text" class="form-control repair-center-autocomplete"
                               id="claim-repair-center" name="repair_center" value="{{ old('repair_center') }}">
                        <input type="text"  class="repair-center-id" name="repair-center-id"
                               value="{{ old('repair-center-id') }}" hidden>
                    </div>

                    {{--Courtesy or Charged (only on Customer Orders)--}}
                    <div id="courtesy_or_charge" class="form-group col-xs-12 hidden">
                        <label for="charge_radio">Charge Customer?</label>
                        <div id="charge_radio">
                            <label class="radio-inline">
                                <input type="radio" name="courtesy_charge" value="Courtesy"
                                    @if (old('courtesy_charge') === 'Courtesy')
                                            checked="checked"
                                    @endif
                                    >
                                Courtesy
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="courtesy_charge" value="Charge"
                                    @if (old('courtesy_charge') === 'Charge')
                                        checked="checked"
                                    @endif
                                    >
                                Charge
                            </label>
                            <span id="charge_btn"
                                class="btn btn-primary btn-sm ml-10 hidden"
                                data-toggle="modal" data-target="#creditCardModal">
                                Enter & Print Credit Card Info
                            </span>
                        </div>
                    </div>

                    {{--Claim Type--}}
                    <div class="form-group col-xs-12">
                        <label for="claim-type">Claim Type</label>
                        <div class="" id="claim-type">
                            <label class="radio-inline">
                                <input id="repairOrderBtn" type="radio"
                                       name="replace_order" value="0" checked="checked">
                                <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                                Repair Order
                            </label>
                            <label class="radio-inline">
                                <input id="replaceOrderBtn" type="radio"
                                       name="replace_order" value="1"
                                    @if (old('replace_order') === '1')
                                        checked="checked"
                                    @endif
                                    >
                                <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                                Replace Order
                            </label>
                        </div>
                    </div>

                    {{--Parts information inputs--}}
                    <div id="partsInputs">
                        {{--Parts Required--}}
                        <div class="form-group col-xs-12">
                            <label for="parts-required">Parts Required</label>
                            <div class="" id="parts-required">
                                <label class="radio-inline">
                                    <input id="partsRequiredRadio" type="radio"
                                           name="part_needed" value="1"
                                        @if (old('part_needed') === '1')
                                            checked="checked"
                                        @endif
                                        >
                                    Yes
                                </label>
                                <label class="radio-inline">
                                    <input id="partsNotRequiredRadio" type="radio"
                                           name="part_needed" value="0"
                                        @if (old('part_needed') === '0')
                                            checked="checked"
                                        @endif
                                        >
                                    No
                                </label>
                            </div>
                        </div>
                        <div id="partDetails">
                            {{--Part Needed--}}
                            <div class="form-group col-xs-12">
                                <label for="part-needed">Part Needed</label>
                                <input type="text" class="form-control"
                                       id="part-needed" name="parts_needed"
                                       value="{{ old('parts_needed') }}">
                            </div>
                            {{--Ship Parts To--}}
                            <div class="form-group col-xs-12">
                                <label for="ship-parts-to">Ship Parts To</label>
                                <div class="" id="ship-parts-to">
                                    <label class="radio-inline">
                                        <input type="radio" name="ship_to" value="Customer"
                                            @if (old('ship_to') === 'Customer')
                                                    checked="checked"
                                            @endif
                                            >
                                        Customer
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="ship_to" value="Repair Center"
                                            @if (old('ship_to') === 'Repair Center')
                                                checked="checked"
                                            @endif
                                            >
                                        Repair Center
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Purchase Order--}}
                    <div class="form-group col-xs-12">
                        <label for="purchase-order">Purchase Order</label>
                        <input type="text" class="form-control" id="purchase-order"
                               name="purchase-order" value="{{ old('purchase-order') }}">
                    </div>
                    {{--Comment--}}
                    <div class="form-group col-xs-12">
                        <label for="claim-comment">Comment</label>
                        <textarea class="form-control" id="claim-comment" name="comment">{{ old('comment') }}</textarea>
                    </div>
                    <input type="hidden" id="edit-type-switch" name="edit_type_switch"
                           value="{{ old('edit_type_switch') }}">
                </div>
                {{--Submit--}}
                <div class="form-group col-xs-12">
                    <hr>
                    <a href="{{ route('claim-index') }}" class="btn btn-primary">
                        Back
                    </a>
                    <span id="newClaimSubmitBtn"
                            class="btn btn-primary pull-right"
                            data-toggle="modal" data-target="#newClaimConfirmModal">
                        Submit
                    </span>
                </div>
                {{--Token--}}
                {{ csrf_field() }}
            </form>
        </div>
    </div>

    @include('claim.new-claim-confirm-modal')
    @include('claim.credit-card-modal')
    @include('claim.cc-print')
@endsection
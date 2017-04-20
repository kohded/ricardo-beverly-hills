@extends('layouts.master-narrow')

@section('content')
    <div id="claim-create">
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
            <form action="{{ URL::route('claim.create') }}" method="post">
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
                <div id="existing-customer-field" class="collapse">
                    {{--Email--}}
                    <div class="form-group col-xs-12">
                        <label for="existing-customer-email">Email</label>
                        <input type="text" class="form-control" id="existing-customer-email"
                               name="existing_customer_email" placeholder="email@example.com">
                    </div>
                </div>
                {{--New Customer Fields--}}
                <div id="claim-new-customer" class="collapse">
                    {{--First Name--}}
                    <div class="form-group col-sm-6">
                        <label for="customer-first-name">First Name</label>
                        <input type="text" class="form-control" id="customer-first-name"
                               name="firstname">
                    </div>
                    {{--Last Name--}}
                    <div class="form-group col-sm-6">
                        <label for="customer-last-name">Last Name</label>
                        <input type="text" class="form-control" id="customer-last-name"
                               name="lastname">
                    </div>
                    {{--Phone--}}
                    <div class="form-group col-sm-6">
                        <label for="customer-phone">Phone</label>
                        <input type="text" class="form-control" id="customer-phone" name="phone"
                               placeholder="##########">
                    </div>
                    {{--Email--}}
                    <div class="form-group col-sm-6">
                        <label for="customer-email">Email</label>
                        <input type="text" class="form-control" id="customer-email" name="email"
                               placeholder="email@example.com">
                    </div>
                    {{--Address 1--}}
                    <div class="form-group col-xs-12">
                        <label for="customer-address1">Address 1</label>
                        <input type="text" class="form-control" id="customer-address1"
                               name="address1">
                    </div>
                    {{--Address 2--}}
                    <div class="form-group col-xs-12">
                        <label for="customer-address2">Address 2</label>
                        <input type="text" class="form-control" id="customer-address2"
                               name="address2">
                    </div>
                    {{--City--}}
                    <div class="form-group col-sm-6">
                        <label for="customer-city">City</label>
                        <input type="text" class="form-control" id="customer-city" name="city">
                    </div>
                    {{--State--}}
                    <div class="form-group col-xs-6 col-sm-3">
                        <label for="customer-state">State</label>
                        <input type="text" class="form-control" id="customer-state" name="state"
                               placeholder="WA">
                    </div>
                    {{--Zip--}}
                    <div class="form-group col-xs-6 col-sm-3">
                        <label for="customer-zip">Zip</label>
                        <input type="text" class="form-control" id="customer-zip" name="zip"
                               placeholder="#####">
                    </div>
                </div>
                {{--Product--}}
                <div class="form-group col-xs-12">
                    <label for="claim-product">Product</label>
                    <select class="form-control" id="claim-product" name="products">
                        @foreach ($products as $product)
                            <option name="products" value="{{ $product->style }}">
                                {{ $product->style }} -
                                {{ $product->collection }} -
                                {{ $product->color }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{--Damage Code--}}
                <div class="form-group col-xs-12">
                    <label for="claim-damage-code">Damage Code</label>
                    <select class="form-control" id="claim-damage-code" name="damage_code">
                        @foreach ($damage_codes as $dc)
                            <option value="{{ $dc->id }}">{{ $dc->id . '-' . $dc->part }}</option>
                        @endforeach
                    </select>
                </div>
                {{--Repair Center--}}
                <div class="form-group col-xs-12">
                    <label for="claim-repair-center">Repair Center</label>
                    <select class="form-control" id="claim-repair-center" name="repair_center">
                        @foreach ($repair_centers as $rc)
                            <option value="{{ $rc->id }}">{{ $rc->name }}
                                - {{ $rc->streetName }}</option>
                        @endforeach
                    </select>
                </div>
                {{--Claim Type--}}
                <div class="form-group col-xs-12">
                    <label for="claim-type">Claim Type</label>
                    <div class="" id="claim-type">
                        <label class="radio-inline">
                            <input type="radio" name="replace_order" value="0" checked="checked">
                            <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                            Repair Order
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="replace_order" value="1">
                            <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                            Replace Order
                        </label>
                    </div>
                </div>
                {{--Parts Required--}}
                <div class="form-group col-xs-12">
                    <label for="parts-required">Parts Required</label>
                    <div class="" id="parts-required">
                        <label class="radio-inline">
                            <input type="radio" name="part_needed" value="1">
                            Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="part_needed" value="0">
                            No
                        </label>
                    </div>
                </div>
                {{--Part Needed--}}
                <div class="form-group col-xs-12">
                    <label for="part-needed">Part Needed</label>
                    <input type="text" class="form-control" id="part-needed" name="parts_needed">
                </div>
                {{--Ship Parts To--}}
                <div class="form-group col-xs-12">
                    <label for="ship-parts-to">Ship Parts To</label>
                    <div class="" id="ship-parts-to">
                        <label class="radio-inline">
                            <input type="radio" name="ship_to" value="Customer" checked="checked">
                            Customer
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="ship_to" value="Repair Center">
                            Repair Center
                        </label>
                    </div>
                </div>
                {{--Comment--}}
                <div class="form-group col-xs-12">
                    <label for="claim-comment">Comment</label>
                    <textarea class="form-control" id="claim-comment" name="comment"></textarea>
                </div>
                <input type="hidden" id="edit-type-switch" name="edit_type_switch" value="1">
                {{--Submit--}}
                <div class="form-group col-xs-12">
                    <hr>
                    <a href="{{ route('claim-index') }}" class="btn btn-primary">
                        Back
                    </a>
                    <button type="submit" class="btn btn-primary pull-right">
                        Submit
                    </button>
                </div>
                {{--Token--}}
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection
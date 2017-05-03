@extends('layouts.master-narrow')

@section('content')
    <div id="customer-edit">
        <div class="row">
            <div class="col-xs-12">
                <h2>Edit Customer</h2>
                <hr>
            </div>
        </div>
        {{--Form successfully edited customer--}}
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
        @if(count($errors->all()))
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
            <form class="insertion-form" action="{{ URL::route('customer-edit') }}" method="post">
                {{--First Name--}}
                <div class="form-group col-sm-6">
                    <label for="inputCustomerName">First Name</label>
                    <input type="text" class="form-control" 
                        id="inputCustomerName" name="firstname"
                        value="{{ $customerDetails['customer'][0]->first_name}}">
                </div>
                {{--Last Name--}}
                <div class="form-group col-sm-6">
                    <label for="inputCustomerName">Last Name</label>
                    <input type="text" class="form-control" 
                        id="inputCustomerName" name="lastname"
                        value="{{ $customerDetails['customer'][0]->last_name}}">
                </div>
                {{--Phone--}}
                <div class="form-group col-sm-6">
                    <label for="inputCustomerPhone">Phone</label>
                    <input type="text" class="form-control" 
                        id="inputCustomerPhone" name="phone"
                        value="{{ $customerDetails['customer'][0]->phone }}">
                </div>
                {{--Email--}}
                <div class="form-group col-sm-6">
                    <label for="inputCustomerEmail">Email</label>
                    <input type="text" class="form-control" 
                        id="inputCustomerEmail" name="email"
                        value="{{ $customerDetails['customer'][0]->email }}">
                </div>
                {{--Address 1--}}
                <div class="form-group col-xs-12">
                    <label for="inputCustomerAddress1">Address 1</label>
                    <input type="text" class="form-control" 
                        id="inputCustomerAddress1" name="address1"
                        value="{{ $customerDetails['customer'][0]->address }}">
                </div>
                {{--Address 2--}}
                <div class="form-group col-xs-12">
                    <label for="inputCustomerAddress2">Address 2</label>
                    <input type="text" class="form-control" 
                        id="inputCustomerAddress2" name="address2"
                        value="{{ $customerDetails['customer'][0]->address_2 }}">
                </div>
                {{--City--}}
                <div class="form-group col-sm-6">
                    <label for="inputCustomerCity">City</label>
                    <input type="text" class="form-control" 
                        id="inputCustomerCity" name="city"
                        value="{{ $customerDetails['customer'][0]->city }}">
                </div>
                {{--State--}}
                <div class="form-group col-xs-6 col-sm-3">
                    <label for="inputCustomerState">State</label>
                    <input type="text" class="form-control state-autocomplete"
                        id="inputCustomerState" name="state"
                        value="{{ $customerDetails['customer'][0]->state }}">
                </div>
                {{--Zip--}}
                <div class="form-group col-xs-6 col-sm-3">
                    <label for="inputCustomerZip">Zip</label>
                    <input type="text" class="form-control"
                        id="inputCustomerZip" name="zip"
                        value="{{ $customerDetails['customer'][0]->zip }}">
                </div>
                {{--Id--}}
                <input type="hidden" name="id" value="{{ $customerDetails['customer'][0]->id}}">
                {{--Submit--}}
                <div class="form-group col-xs-12">
                    <hr>
                    <a href="{{ route('customer') }}" class="btn btn-primary">
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
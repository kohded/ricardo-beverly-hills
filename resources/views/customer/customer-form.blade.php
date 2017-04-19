@extends('layouts.master-narrow')

@section('content')
    <div id="customer-create">
        <div class="row">
            <div class="col-xs-12">
                <h2>Create Customer</h2>
                <hr>
            </div>
        </div>
        {{--Form successfully created customer--}}
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
            <form class="insertion-form" action="{{ URL::route('customer-create') }}" method="post">
                {{--First Name--}}
                <div class="form-group col-sm-6">
                    <label for="inputCustomerFirstName">First Name</label>
                    <input type="text" class="form-control" id="inputCustomerFirstName" name="firstname">
                </div>
                {{--Last Name--}}
                <div class="form-group col-sm-6">
                    <label for="inputCustomerLastName">Last Name</label>
                    <input type="text" class="form-control" id="inputCustomerLastName" name="lastname">
                </div>
                {{--Phone--}}
                <div class="form-group col-sm-6">
                    <label for="inputCustomerPhone">Phone</label>
                    <input type="text" class="form-control" id="inputCustomerPhone" name="phone"
                           placeholder="##########">
                </div>
                {{--Email--}}
                <div class="form-group col-sm-6">
                    <label for="inputCustomerEmail">Email</label>
                    <input type="text" class="form-control" id="inputCustomerEmail" name="email"
                           placeholder="email@example.com">
                </div>
                {{--Address 1--}}
                <div class="form-group col-xs-12">
                    <label for="inputCustomerAddress1">Address 1</label>
                    <input type="text" class="form-control" id="inputCustomerAddress1"
                           name="address1">
                </div>
                {{--Address 2--}}
                <div class="form-group col-xs-12">
                    <label for="inputCustomerAddress2">Address 2</label>
                    <input type="text" class="form-control" id="inputCustomerAddress2"
                           name="address2">
                </div>
                {{--City--}}
                <div class="form-group col-sm-6">
                    <label for="inputCustomerCity">City</label>
                    <input type="text" class="form-control" id="inputCustomerCity" name="city">
                </div>
                {{--State--}}
                <div class="form-group col-xs-6 col-sm-3">
                    <label for="inputCustomerState">State</label>
                    <input type="text" class="form-control" id="inputCustomerState" name="state"
                           placeholder="WA">
                </div>
                {{--Zip--}}
                <div class="form-group col-xs-6 col-sm-3">
                    <label for="inputCustomerZip">Zip</label>
                    <input type="text" class="form-control" id="inputCustomerZip" name="zip"
                           placeholder="#####">
                </div>
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
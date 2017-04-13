@extends('layouts.master')

@section('content')

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

    <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
            <h3>Edit Customer</h3>
        </div>
    </div>

    <form class="insertion-form" action="{{ URL::route('customer-edit') }}" method="post">
        <div class="form-group col-xs-offset-3 col-xs-3">
            <label for="inputCustomerName">First Name</label>
            <input type="text" class="form-control" id="inputCustomerName" name="firstname" value="{{ $customerDetails['customer'][0]->first_name}}">
        </div>

        <div class="col-xs-3">
            <label for="inputCustomerName">Last Name</label>
            <input type="text" class="form-control" id="inputCustomerName" name="lastname" value="{{ $customerDetails['customer'][0]->last_name}}">
        </div>

        <div class="form-group col-xs-offset-3  col-xs-6">
            <label for="inputCustomerAddress1">Address 1</label>
            <input type="text" class="form-control" id="inputCustomerAddress1" name="address1" value="{{ $customerDetails['customer'][0]->address }}">
        </div>

        <div class="form-group col-xs-offset-3 col-xs-6">
            <label for="inputCustomerAddress2">Address 2</label>
            <input type="text" class="form-control" id="inputCustomerAddress2" name="address2" value="{{ $customerDetails['customer'][0]->address_2 }}">
        </div>

        <div class="form-group col-xs-offset-3 col-xs-2">
            <label for="inputCustomerCity">City</label>
            <input type="text" class="form-control" id="inputCustomerCity" name="city" value="{{ $customerDetails['customer'][0]->city }}">
        </div>

        <div class="form-group col-xs-2">
            <label for="inputCustomerState">State</label>
            <input type="text" class="form-control" id="inputCustomerState" name="state" value="{{ $customerDetails['customer'][0]->state }}">
        </div>

        <div class="form-group col-xs-2">
            <label for="inputCustomerZip">Zip</label>
            <input type="text" class="form-control" id="inputCustomerZip" name="zip" value="{{ $customerDetails['customer'][0]->zip }}">
        </div>

        <div class="form-group col-xs-offset-3 col-xs-3">
            <label for="inputCustomerPhone">Phone</label>
            <input type="text" class="form-control" id="inputCustomerPhone" name="phone"  value="{{ $customerDetails['customer'][0]->phone }}">
        </div>


        <div class="form-group col-xs-3">
            <label for="inputCustomerEmail">Email</label>
            <input type="text" class="form-control" id="inputCustomerEmail" name="email" value="{{ $customerDetails['customer'][0]->email }}">
        </div>

        <input type="hidden" name="id" value="{{ $customerDetails['customer'][0]->id}}">



{{ csrf_field() }}

<input class="btn btn-success col-xs-offset-3 col-xs-6" type="submit" name="submit" value="Update">
</form>
@endsection
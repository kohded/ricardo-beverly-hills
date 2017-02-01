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

<form class="insertion-form" action="{{ URL::route('customer-edit') }}" method="post">
        <div class="form-group col-xs-offset-3 col-xs-6">
            <label for="inputCustomerName">Customer Name</label>
            <input type="text" class="form-control" id="inputCustomerName" name="name" value="{{ $customerDetail[0]->name }}">
        </div>

        <div class="form-group col-xs-offset-3  col-xs-6">
            <label for="inputCustomerAddress1">Address 1</label>
            <input type="text" class="form-control" id="inputCustomerAddress1" name="address1" value="{{ $customerDetail[0]->address }}">
        </div>

        <div class="form-group col-xs-offset-3 col-xs-6">
            <label for="inputCustomerAddress2">Address 2</label>
            <input type="text" class="form-control" id="inputCustomerAddress2" name="address2" value="{{ $customerDetail[0]->address_2 }}">
        </div>

        <div class="form-group col-xs-offset-3 col-xs-2">
            <label for="inputCustomerCity">City</label>
            <input type="text" class="form-control" id="inputCustomerCity" name="city" value="{{ $customerDetail[0]->city }}">
        </div>

        <div class="form-group col-xs-2">
            <label for="inputCustomerState">State</label>
            <input type="text" class="form-control" id="inputCustomerState" name="state" value="{{ $customerDetail[0]->state }}">
        </div>

        <div class="form-group col-xs-2">
            <label for="inputCustomerZip">Zip</label>
            <input type="text" class="form-control" id="inputCustomerZip" name="zip" value="{{ $customerDetail[0]->zip }}">
        </div>

        <div class="form-group col-xs-offset-3 col-xs-2">
            <label for="inputCustomerPhone">Phone</label>
            <input type="text" class="form-control" id="inputCustomerPhone" name="phone"  value="{{ $customerDetail[0]->phone }}">
        </div>

        <div class="form-group col-xs-2">
            <label for="inputCustomerExt">Extension</label>
            <input type="text" class="form-control" id="inputCustomerExt" name="ext" value="{{ $customerDetail[0]->extension }}">
        </div>

        <div class="form-group col-xs-2">
            <label for="inputCustomerEmail">Email</label>
            <input type="text" class="form-control" id="inputCustomerEmail" name="email" value="{{ $customerDetail[0]->email }}">
        </div>

        <div class="form-group col-xs-offset-3 col-xs-6">
            <label for="inputCustomerComment">Comments</label>
            <textarea class="col-xs-12" id="inputCustomerComment" name="comments">{{ $customerDetail[0]->comments }}</textarea>
        </div>

{{ csrf_field() }}

<input class="btn btn-success col-xs-offset-3 col-xs-6" type="submit" name="submit" value="Update">
</form>
@endsection
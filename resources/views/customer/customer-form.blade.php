@extends('layouts.master')

@section('content')
   <h1 class="text-center">{{$title}}</h1>

    <form class="insertion-form">
        <div class="form-group col-xs-offset-3 col-xs-6">
            <label for="inputCustomerName">Customer Name</label>
            <input type="text" class="form-control" id="inputCustomerName" name="name" placeholder="Customer Name">
        </div>

        <div class="form-group col-xs-offset-3  col-xs-6">
            <label for="inputClaimNumber">Address 1</label>
            <input type="text" class="form-control" id="inputClaimNumber" placeholder="Address 1">
        </div>

        <div class="form-group col-xs-offset-3 col-xs-6">
            <label for="inputClaimNumber">Address 2</label>
            <input type="text" class="form-control" id="inputClaimNumber" placeholder="Address 2">
        </div>

        <div class="form-group col-xs-offset-3 col-xs-2">
            <label for="inputClaimNumber">City</label>
            <input type="text" class="form-control" id="inputClaimNumber" placeholder="City">
        </div>

        <div class="form-group col-xs-2">
            <label for="inputClaimNumber">State</label>
            <input type="text" class="form-control" id="inputClaimNumber" placeholder="e.g. WA">
        </div>

        <div class="form-group col-xs-2">
            <label for="inputClaimNumber">Zip</label>
            <input type="text" class="form-control" id="inputClaimNumber" placeholder="Zip">
        </div>

        <div class="form-group col-xs-offset-3 col-xs-2">
            <label for="inputClaimNumber">Phone</label>
            <input type="text" class="form-control" id="inputClaimNumber" placeholder="###-###-####">
        </div>

        <div class="form-group col-xs-2">
            <label for="inputClaimNumber">Extension</label>
            <input type="text" class="form-control" id="inputClaimNumber" placeholder="Ext.">
        </div>

        <div class="form-group col-xs-2">
            <label for="inputClaimNumber">Email</label>
            <input type="text" class="form-control" id="inputClaimNumber" placeholder="example@example.com">
        </div>

        <div class="form-group col-xs-offset-3 col-xs-6">
            <label for="inputClaimNumber">Comments</label>
            <textarea class="col-xs-12">Other information that is important to know.</textarea>
        </div>

        <input class="btn btn-primary col-xs-offset-3 col-xs-6" type="submit" name="submit" value="Submit">
    </form>
@endsection
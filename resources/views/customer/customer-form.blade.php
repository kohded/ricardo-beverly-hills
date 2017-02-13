@extends('layouts.master')

@section('content')
   <h1 class="text-center">{{$title}}</h1>

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



    <form class="insertion-form" action="{{ URL::route('customer-create') }}" method="post">
        <div class="form-group col-xs-offset-3 col-xs-6">
            <label for="inputCustomerName">Customer Name</label>
            <input type="text" class="form-control" id="inputCustomerName" name="name" placeholder="Customer Name">
        </div>

        <div class="form-group col-xs-offset-3  col-xs-6">
            <label for="inputCustomerAddress1">Address 1</label>
            <input type="text" class="form-control" id="inputCustomerAddress1" name="address1" placeholder="Address 1">
        </div>

        <div class="form-group col-xs-offset-3 col-xs-6">
            <label for="inputCustomerAddress2">Address 2</label>
            <input type="text" class="form-control" id="inputCustomerAddress2" name="address2" placeholder="Address 2">
        </div>

        <div class="form-group col-xs-offset-3 col-xs-2">
            <label for="inputCustomerCity">City</label>
            <input type="text" class="form-control" id="inputCustomerCity" name="city" placeholder="City">
        </div>

        <div class="form-group col-xs-2">
            <label for="inputCustomerState">State</label>
            <input type="text" class="form-control" id="inputCustomerState" name="state" placeholder="e.g. WA">
        </div>

        <div class="form-group col-xs-2">
            <label for="inputCustomerZip">Zip</label>
            <input type="text" class="form-control" id="inputCustomerZip" name="zip" placeholder="Zip">
        </div>

        <div class="form-group col-xs-offset-3 col-xs-2">
            <label for="inputCustomerPhone">Phone</label>
            <input type="text" class="form-control" id="inputCustomerPhone" name="phone" placeholder="###-###-####">
        </div>

        <div class="form-group col-xs-2">
            <label for="inputCustomerExt">Extension</label>
            <input type="text" class="form-control" id="inputCustomerExt" name="ext" placeholder="Ext.">
        </div>

        <div class="form-group col-xs-2">
            <label for="inputCustomerEmail">Email</label>
            <input type="text" class="form-control" id="inputCustomerEmail" name="email" placeholder="example@example.com">
        </div>

        <div class="form-group col-xs-offset-3 col-xs-6">
            <label for="inputCustomerComment">Comments</label>
            <textarea class="col-xs-12" id="inputCustomerComment" name="comments">Other information that is important to know.</textarea>
        </div>

        {{ csrf_field() }}

        <input class="btn btn-primary col-xs-offset-3 col-xs-6" type="submit" name="submit" value="Submit">
    </form>
@endsection
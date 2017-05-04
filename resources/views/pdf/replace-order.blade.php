@extends('pdf.layout')

@section('title')
<span class="fa fa-briefcase"></span>    
Replace Order
@endsection

@section('content')
{{--Customer Info--}}
<div class="pdf row top-line">
    <div class="col-xs-3">
        <p class="bold-text pull-right">Customer Name</span></p>
    </div>
    <div class="col-xs-9">
        <p>{{ $claim[0]->cust_first_name }} {{ $claim[0]->cust_last_name }}</p>
    </div>
    <div class="col-xs-3">
        <p class="bold-text pull-right">Address</p>
    </div>
    <div class="col-xs-9">
        <p>
            {{ $claim[0]->cust_address }}<br />
            @if($claim[0]->cust_address_2)
                {{ $claim[0]->cust_address_2 }}<br />
            @endif
            {{ $claim[0]->cust_city }}, {{ $claim[0]->cust_state }} {{ $claim[0]->cust_zip }}
        </p>
    </div>   
    <div class="col-xs-3">
        <p class="bold-text pull-right">Phone</p>
    </div>
    <div class="col-xs-9">
        <p>{{ $claim[0]->cust_phone }}</p>
    </div>   
    <div class="col-xs-3">
        <p class="bold-text pull-right">Email</span></p>
    </div>
    <div class="col-xs-9">
        <p>{{ $claim[0]->cust_email }}</p>
    </div>   
</div>

{{--Repair Center Info--}}
<div class="pdf row top-line">
    <div class="col-xs-3">
        <p class="bold-text pull-right">Repair Center Name</span></p>
    </div>
    <div class="col-xs-9">
        <p>{{ $claim[0]->rc_name }}
    </div>
    <div class="col-xs-3">
        <p class="bold-text pull-right">Address</p>
    </div>
    <div class="col-xs-9">
        <p>
            {{ $claim[0]->rc_address }}<br />
            {{ $claim[0]->rc_city }}, {{ $claim[0]->rc_state }} {{ $claim[0]->rc_zip }}
        </p>
    </div>  
    <div class="col-xs-3">
        <p class="bold-text pull-right">Phone</p>
    </div>
    <div class="col-xs-9">
        <p>{{ $claim[0]->rc_phone }}</p>
    </div>   
    <div class="col-xs-3">
        <p class="bold-text pull-right">Email</span></p>
    </div>
    <div class="col-xs-9">
        <p>{{ $claim[0]->rc_email }}</p>
    </div>    
</div>
@endsection
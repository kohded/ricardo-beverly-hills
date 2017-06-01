<!doctype html>
<html lang="en">
<!--
Ricardo Beverly Hills - Parts, Repair, & Warranty Management System
@author Arnold Koh <arnold@kohded.com>
@author Chris Knoll <>
@author Peter Kim <peterlk.dev@gmail.com>
@version 1.0, developed 1/17/17
@url http://rbh.greenrivertech.net
-->
<head>
    {{--Meta--}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--Links--}}
    <link rel="stylesheet" href="{{public_path('css/app.css')}}">

    {{--Title--}}
    <title>Ricardo Beverly Hills</title>
</head>
<body class="pdf">
    <div class="container pdf">
        {{--Logo and Address--}}
        <div class="pdf row">  
            <div class="col-xs-5">
                <img src="{{public_path('img/logo.jpg')}}">
            </div>
            <div class="col-xs-3 pull-right">
                <p>
                    6329 S 226th St<br />
                    Kent, WA 98032<br />
                    (800) 724-7496
                </p>
            </div>
        </div>

        {{--Title--}}
        <div class="pdf row">
            <div class="col-xs-12 text-center">
                <h3>Warranty Repair Payment Request</h3>
            </div>
        </div>

        <div class="pdf row top-line">
            <p>Please send payment of <b>${{ number_format($claim[0]->invoice_amount, 2) }}</b> to:</p>
        </div>
        {{--Repair Center Info--}}
        <div class="pdf row">
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
                <p class="bold-text pull-right">Email</p>
            </div>
            <div class="col-xs-9">
                <p>{{ $claim[0]->rc_email }}</p>
            </div>    
            <div class="col-xs-3">
                <p class="bold-text pull-right">Reference Repair Bill #</p>
            </div>
            <div class="col-xs-9">
                <p>{{$claim[0]->claim_id}}</p>
            </div>  
            
        </div>

        {{--Customer Info--}}
        <div class="pdf row top-line">
            <div class="col-xs-12">
                <p>The Warranty Repair was authorized for the below customer:</p>
            </div>
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

        {{--Basic Claim Info--}}
        <div class="pdf row">
            <div class="col-xs-3">
                <p class="bold-text pull-right">Claim Opened</span></p>
            </div>
            <div class="col-xs-3">
                <p>{{$claim[0]->claim_created_at}}</p>
            </div>
            <div class="col-xs-3">
                <p class="bold-text pull-right">Customer Claim #</p>
            </div>
            <div class="col-xs-3">
                <p>{{$claim[0]->claim_id}}</p>
            </div>        
        </div>

        {{--Defective Product--}}
        <div class="pdf row">
            <div class="col-xs-3">
                <p class="bold-text pull-right">Defective Product Style</span></p>
            </div>
            <div class="col-xs-3">
                <p>{{$claim[0]->product_style}}</p>
            </div>
            <div class="col-xs-3">
                <p class="bold-text pull-right">Damage Code</p>
            </div>
            <div class="col-xs-3">
                <p>{{ $claim[0]->dc_id }}</p>
            </div>        
        </div>

        {{--Signature / Date--}}
        <div class="pdf row top-line">
            <div class="col-xs-12">
                <p>Approved by:</p>
            </div>
            <br><br><br><br>
            <div class="col-xs-5 top-line">
                <p class="text-center">Signature</p>
            </div>
            <div class="col-xs-offset-1 col-xs-3 top-line">
                <p class="text-center">Date</p>
            </div>         
        </div>
    </div>
</body>
</html>
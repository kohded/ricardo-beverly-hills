@extends('layouts.master')

@section('content')
<div class="col-xs-offset-3 col-xs-6">
    <h3 class="text-center">Claim Number: {{ $claim[0]->claim_id }} </h3>

    <table class="table table-striped">
        <tr>
            <th>Opened At</th>
            <td class="text-center">{{ $claim[0]->claim_created_at }}</td>
        </tr>
        <tr>
            <th>Closed At</th>
            <td class="text-center">{{ $claim[0]->claim_date_closed }}</td>
        </tr>
        <tr>
            <th>Product Style</th>
            <td class="text-center">{{ $claim[0]->product_style }}</td>
        </tr>
        <tr>
            <th>Damage Code</th>
            <td class="text-center">{{ $claim[0]->dc_id }} - {{ $claim[0]->dc_part }}</td>
        </tr>

        <tr><th colspan="2" class="text-center"><h3>Customer Info</h3></th></tr>
        
        <tr>
            <th>Customer First Name</th>
            <td class="text-center">{{ $claim[0]->cust_first_name }}</td>
        </tr>
        <tr>
            <th>Customer Last Name</th>
            <td class="text-center">{{ $claim[0]->cust_last_name }}</td>
        </tr>
        <tr>
            <th>Customer Address</th>
            <td class="text-center">{{ $claim[0]->cust_address }}</td>
        </tr>
        <tr>
            <th>Customer Address 2</th>
            <td class="text-center">{{ $claim[0]->cust_address_2 }}</td>
        </tr>
        <tr>
            <th>Customer City</th>
            <td class="text-center">{{ $claim[0]->cust_city }}</td>
        </tr>
        <tr>
            <th>Customer State</th>
            <td class="text-center">{{ $claim[0]->cust_state }}</td>
        </tr>
        <tr>
            <th>Customer Zip</th>
            <td class="text-center">{{ $claim[0]->cust_zip }}</td>
        </tr>
        <tr>
            <th>Customer Phone</th>
            <td class="text-center">{{ $claim[0]->cust_phone }}</td>
        </tr>
        <tr>
            <th>Customer Email</th>
            <td class="text-center">{{ $claim[0]->cust_email }}</td>
        </tr>

        <tr><th colspan="2" class="text-center"><h3>Repair Center Info</h3></th></tr>
        <tr>
            <th>Repair Center Name</th>
            <td class="text-center">{{ $claim[0]->rc_name }}</td>
        </tr>
        <tr>
            <th>Repair Center Address</th>
            <td class="text-center">{{ $claim[0]->rc_address }}</td>
        </tr>
        <tr>
            <th>Repair Center City</th>
            <td class="text-center">{{ $claim[0]->rc_city }}</td>
        </tr>
        <tr>
            <th>Repair Center State</th>
            <td class="text-center">{{ $claim[0]->rc_state }}</td>
        </tr>
        <tr>
            <th>Repair Center Zip</th>
            <td class="text-center">{{ $claim[0]->rc_zip }}</td>
        </tr>
        <tr>
            <th>Repair Center Contact Name</th>
            <td class="text-center">{{ $claim[0]->rc_contact }}</td>
        </tr>
        <tr>
            <th>Repair Center Phone</th>
            <td class="text-center">{{ $claim[0]->rc_phone }}</td>
        </tr>
        <tr>
            <th>Repair Center Email</th>
            <td class="text-center">{{ $claim[0]->rc_email }}</td>
        </tr>
    </table>

    <div class="col-xl-12 text-center">
        <h3>Comments</h3>
    </div>
    @foreach ($comments as $comment)
        <div class="col-xs-3">
            {{ $comment->author }}<br />
            {{ $comment->created_at }}
        </div>
        <div class="col-xs-9">
            {{ $comment->comment }}
        </div>
        <div class="col-xs-12">
            <hr />
        </div>
    @endforeach
</div>
@endsection
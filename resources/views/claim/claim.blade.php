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



        <tr><th colspan="2" class="text-center"><h3>Repair Center Info</h3></th></tr>
        <tr>
            <th>Repair Center Name</th>
            <td class="text-center">{{ $claim[0]->rc_name }}</td>
        </tr>

    </table>
</div>
@endsection
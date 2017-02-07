@extends('layouts.master')

@section('content')

    <div class="col-xs-offset-3 col-xs-6">
        <h1 class="text-center"> {{ $customerDetail[0]->first_name . " " . $customerDetail[0]->last_name }} </h1>

        <table class="table table-striped">
            <tr>
               <th>Address</th>
                <td class="text-center">{{ $customerDetail[0]->address }}</td>
            </tr>

            @if($customerDetail[0]->address_2)
            <tr>
                <th>Address 2</th>
                <td class="text-center">{{ $customerDetail[0]->address_2 }}</td>
            </tr>
            @endif
            <tr>
                <th>City</th>
                <td class="text-center">{{ $customerDetail[0]->city }}</td>
            </tr>
            <tr>
                <th>State</th>
                <td class="text-center">{{ $customerDetail[0]->state }}</td>
            </tr>
            <tr>
                <th>Zip</th>
                <td class="text-center">{{ $customerDetail[0]->zip }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td class="text-center">{{ $customerDetail[0]->email }}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td class="text-center">{{ $customerDetail[0]->phone }}</td>
            </tr>
        </table>


    </div>







@endsection

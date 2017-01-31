@extends('layouts.master')

@section('content')
    <h1>All {{$title}}</h1>

    <a href="{{ URL::route('customer-create') }}" class="btn btn-lg btn-primary" role="button">Create New Customer</a>

    <table class="table">
        <thead>
        <tr>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Zip</th>
            <th>email</th>


        </tr>
        </thead>

        <tbody>
        @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->address }}</td>
                <td>{{ $customer->city }}</td>
                <td>{{ $customer->state }}</td>
                <td>{{ $customer->zip }}</td>
                <td>{{ $customer->email }}</td>
                <td><a href="{{ URL::route('more-customer-details', [ 'customerId' => $customer->id]) }}" class="btn btn-default">More Detail</a></td>
                <td><a href="" class="btn btn-success">Edit</a></td>
                <td><a href="" class="btn btn-danger">Delete</a></td>

            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

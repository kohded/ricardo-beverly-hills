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
            <th>Address 2</th>
            <th>City</th>
            <th>State</th>
            <th>Zip</th>
            <th>Phone</th>
            <th>Extension</th>
            <th>email</th>
            <th>comments</th>

        </tr>
        </thead>

        <tbody>
        @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->address }}</td>
                <td>{{ $customer->address_2 }}</td>
                <td>{{ $customer->city }}</td>
                <td>{{ $customer->state }}</td>
                <td>{{ $customer->zip }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->extension }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->comments }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

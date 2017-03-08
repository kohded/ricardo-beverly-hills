@extends('layouts.master')

@section('content')
    <h1>All {{$title}}</h1>

    <a href="{{ URL::route('customer-create') }}" class="btn btn-primary" role="button">
        Create New Customer</a>
    <hr>

    @include('customer.filter-form')

    <table class="table table-hover table-condensed">
        <thead>
        <tr>
            <th></th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Repair Center</th>
            <th></th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        @foreach ($customers as $customer)
            <tr>
                <td><a href="{{ URL::route('more-customer-details', [ 'customerId' => $customer->id ]) }}" class="btn btn-default btn-sm">More Detail</a></td>
                <td>{{ $customer->first_name . " " . $customer->last_name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->name }}</td>
                <td><a href="{{ URL::route('customer-get-edit', [ 'customerId' => $customer->id ])  }}" class="btn btn-success btn-sm">Edit</a></td>
                <td><a href="{{ URL::route('customer.delete', [ 'customerId' => $customer->id ])  }}" class="btn btn-danger btn-sm">Delete</a></td>

            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@extends('layouts.master')

@section('content')
    <div id="customer-list">
        <div class="row">
            <div class="col-xs-12">
                <h1>All Customers</h1>

                {{--Delete repair center alert--}}
                @if(Session::has('message'))
                    <p class="alert alert-danger">
                        {{ Session::get('message') }}
                    </p>
                @endif

                {{--Create button--}}
                <a href="{{ URL::route('customer-create') }}" class="btn btn-primary">
                    Create New Customer
                </a>
            </div>
        </div>
        <hr>

        @include('customer.filter-form')

        <div class="row">
            <div class="col-xs-12">
                <div class="table-responsive">
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
                                <td>
                                    <a href="{{ URL::route('more-customer-details', [ 'customerId' => $customer->id ]) }}"
                                       class="btn btn-default btn-sm">More Detail</a></td>
                                <td>{{ $customer->first_name . " " . $customer->last_name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->name }}</td>
                                <td class="table-data-wrap">
                                    <a href="{{ URL::route('customer-get-edit', [ 'customerId' => $customer->id ])  }}"
                                       class="btn btn-success btn-sm">Edit</a></td>
                                <td class="table-data-wrap">
                                    <a href="{{ URL::route('customer.delete', [ 'customerId' => $customer->id ])  }}"
                                       class="btn btn-danger btn-sm">Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

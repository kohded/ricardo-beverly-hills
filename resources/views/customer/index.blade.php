@extends('layouts.master')

@section('content')
    <div id="customer-list">
        <div class="row">
            <div class="col-xs-12">
                <h1>All Customers</h1>

                {{--Create button--}}
                <a href="{{ URL::route('customer-create') }}" class="btn btn-primary">
                    Create New Customer
                </a>
            </div>
        </div>

        <hr>
        @include('customer.filter-form')
        <hr>

        <div class="row">
            <div class="col-xs-12">
                {{--Delete customer alert--}}
                @if(Session::has('message'))
                    <p class="alert alert-danger">
                        {{ Session::get('message') }}
                    </p>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <th></th>
                            <th>
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                Customer Name
                            </th>
                            <th>
                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                                Email
                            </th>
                            <th>
                                <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
                                Phone
                            </th>
                            <th>
                                <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                                Repair Center
                            </th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>
                                    <a href="{{ URL::route('more-customer-details', [ 'customerId' => $customer->id ]) }}">
                                       <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ URL::route('more-customer-details', [ 'customerId' => $customer->id ]) }}">
                                    {{ $customer->first_name . " " . $customer->last_name }}
                                </td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->name }}</td>
                                <td class="table-data-wrap">
                                    <a id="customer-edit" href="{{ URL::route('customer-get-edit', [ 'customerId' => $customer->id ])  }}">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </a>
                                </td>
                                <td class="table-data-wrap">
                                    <a href="{{ URL::route('customer.delete', [ 'customerId' => $customer->id ])  }}">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
@endsection

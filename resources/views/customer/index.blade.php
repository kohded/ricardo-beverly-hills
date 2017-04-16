@extends('layouts.master')

@section('content')
    <div id="customer-list">
        <div class="row">
            <div class="col-xs-12">
                <h2>
                    Customers

                    {{--Create button--}}
                    <a href="{{ URL::route('customer-create') }}" class="btn btn-primary pull-right">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        Create New Customer
                    </a>
                </h2>
                <hr>
            </div>
        </div>

        @include('customer.filter-form')

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
                                    <a href="{{ URL::route('more-customer-details', [ 'customerId' => $customer->customer_id ]) }}">
                                       <span class="glyphicon glyphicon-file" aria-hidden="true" title="View Customer Details"></span>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ URL::route('more-customer-details', [ 'customerId' => $customer->customer_id ]) }}">
                                    {{ $customer->first_name . " " . $customer->last_name }}
                                </td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->name }}</td>
                                <td class="table-data-wrap">
                                    <a id="customer-edit" href="{{ URL::route('customer-get-edit', [ 'customerId' => $customer->customer_id ])  }}">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true" title="Edit Customer"></span>
                                    </a>
                                </td>
                                <td class="table-data-wrap">
                                    <a  href=""
                                                id="deleteCustomerBtn"
                                                class="glyphicon glyphicon-remove text-danger" 
                                                aria-hidden="true" 
                                                data-id="{{ $customer->customer_id }}"
                                                data-name="{{ $customer->first_name }} {{ $customer->last_name }}"
                                                data-toggle="modal"
                                                data-target="#deleteCustomerModal"
                                                title="Delete Customer"></a>
                                </td>
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

    @include('customer.delete-customer-modal')
@endsection

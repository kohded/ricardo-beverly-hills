@extends('layouts.master')

@section('content')
    <div id="claim-more-details">

        <div class="row">
            {{--Title--}}
            <div class="col-xs-12">
                <h2>
                	<span class="fa fa-file-text" aria-hidden="true"></span>
                    Claim #{{ $claim[0]->claim_id }}
                </h2>
                <hr>
            </div>

            {{--Buttons--}}
            <div class="col-xs-12">
                {{--Claim PDF--}}
                <a href="{{ URL::route('claim-pdf', ['id' => $claim[0]->claim_id]) }}" 
                    class="btn btn-sm btn-default claim-btn" target="_blank">
                    <span class="fa fa-file-pdf-o" aria-hidden="true"></span>
                    Claim PDF
                </a>

                {{--Invoice PDF--}}
                <a href="{{ URL::route('invoice-pdf', ['id' => $claim[0]->claim_id]) }}" 
                    class="btn btn-sm btn-default claim-btn" target="_blank">
                    <span class="fa fa-file-pdf-o" aria-hidden="true"></span>
                    Invoice PDF
                </a>

                {{--Packing Slip PDF--}}
                <a href="{{ URL::route('packing-slip-pdf', ['id' => $claim[0]->claim_id]) }}" 
                    class="btn btn-sm btn-default claim-btn" target="_blank">
                    <span class="fa fa-file-pdf-o" aria-hidden="true"></span>
                    Packing Slip PDF
                </a>

                {{--Edit Claim button--}}
                <a href="{{ URL::route('claim.edit', ['id' => $claim[0]->claim_id]) }}" 
                    class="btn btn-sm btn-primary claim-btn">
                    <span class="fa fa-pencil-square-o" aria-hidden="true"></span>
                    Edit Claim
                </a>

                {{--Close Claim button--}}
                <a href="{{ URL::route('close-claim', ['id' => $claim[0]->claim_id]) }}" 
                    class="btn btn-sm btn-primary claim-btn">
                    <span class="fa fa-check-circle" aria-hidden="true"></span>
                    Close Claim
                </a>
            </div>
        </div>

        {{--Session messages--}}
        @if(Session::has('message'))
            <div class="row">
                <div class="col-xs-12">
                    <br>
                    <p class="alert alert-success">
                        {{ Session::get('message') }}
                    </p>
                </div>
            </div>
        @endif
        @if(Session::has('email-message'))
            <div class="row">
                <div class="col-xs-12">
                    <ul class="alert alert-success list-unstyled">
                        <li>{{ Session::get('email-message')['message'] }}</li>
                        @if(isset(Session::get('email-message')['customer']))
                            <li>{{ Session::get('email-message')['customer'] }}</li>
                        @endif
                        @if(isset(Session::get('email-message')['repair-center']))
                            <li>{{ Session::get('email-message')['repair-center'] }}</li>
                        @endif
                        @if(isset(Session::get('email-message')['rbh']))
                            <li>{{ Session::get('email-message')['rbh'] }}</li>
                        @endif
                        @if(isset(Session::get('email-message')['twc']))
                            <li>{{ Session::get('email-message')['twc'] }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        @endif

        {{--Form validation errors--}}
        @if(count($errors) > 0)
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <div class="row mt-20">
            <div class="col-sm-12 col-md-6">
                {{--Claim Info Panel--}}
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="fa fa-file-text" aria-hidden="true"></span>
                            Claim Info
                        </h3>
                    </div>
                    <div class="panel-body">
                        {{--Claim Number--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    Claim Number
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                <p>{{ $claim[0]->claim_id }}</p>
                            </div>
                        </div>
                        {{--Created By--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    Created By
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                <p>{{ $claim[0]->created_by }}</p>
                            </div>
                        </div>
                        {{--Status--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    Status
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                <p>
                                    @if ($claim[0]->claim_date_closed)
                                        Closed
                                    @else
                                        Open
                                    @endif
                                </p>
                            </div>
                        </div>
                        {{--Claim Type--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    Claim Type
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                @if ($claim[0]->replace_order == 1)
                                    <p><span class="fa fa-suitcase" aria-hidden="true"></span>
                                        Replace Order
                                    </p>
                                @else
                                    <p><span class="fa fa-wrench" aria-hidden="true"></span>
                                        Repair Order
                                    </p>
                                    <!-- Convert to Replace Order button -->
                                    <button type="button" id="convert-to-replace-order"
                                            data-claim="{{ $claim[0]->claim_id }}"
                                            data-toggle="modal"
                                            data-target="#convertToReplaceOrderModal"
                                            @if ($claim[0]->parts_available == 0 && $claim[0]->part_needed)
                                            class="btn btn-warning btn-xs mb-10">
                                        <span class="fa fa-exclamation-triangle"
                                              aria-hidden="true"></span>
                                        @else
                                            class="btn btn-primary btn-xs mb-10">
                                        @endif
                                            Convert to Replace Order
                                    </button>
                                @endif
                            </div>
                        </div>
                        {{--Opened Date--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    <span class="fa fa-calendar-o" aria-hidden="true"></span>
                                    Opened Date
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                <p>{{ $claim[0]->claim_created_at }}</p>
                            </div>
                        </div>
                        {{--Purchase Order--}}
                        @if ($claim[0]->purchase_order)
                            <div class="row">
                                <div class="col-sm-3 col-md-4">
                                    <p class="detail-label bold-text">
                                        <span class="fa fa-file-text" aria-hidden="true"></span>
                                        Purchase Order
                                    </p>
                                </div>
                                <div class="col-sm-9 col-md-8">
                                    <p>{{ $claim[0]->purchase_order }}</p>
                                </div>
                            </div>
                        @endif
                        {{--Closed Date--}}
                        @if ($claim[0]->claim_date_closed)
                            <div class="row">
                                <div class="col-sm-3 col-md-4">
                                    <p class="detail-label bold-text">
                                        <span class="fa fa-calendar-o" aria-hidden="true"></span>
                                        Closed Date
                                    </p>
                                </div>
                                <div class="col-sm-9 col-md-8">
                                    <p>{{ $claim[0]->claim_date_closed }}</p>
                                </div>
                            </div>
                        @endif
                        {{--Email Sent--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    <span class="fa fa-envelope" aria-hidden="true"></span>
                                    Email Sent
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                <p>
                                    @if ($claim[0]->claim_email_sent > 0)
                                        Yes
                                    @else
                                        No
                                    @endif
                                </p>
                            </div>
                        </div>

                        {{--Invoice Amount--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    <span class="fa fa-money" aria-hidden="true"></span>
                                    Invoice Amount
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                ${{ number_format($claim[0]->invoice_amount, 2) }}<br>
                                {{--Update Invoice Amount--}}
                                <button type="button" id="enter-tracking"
                                        class="btn btn-warning btn-xs"
                                        data-claim="{{ $claim[0]->claim_id }}"
                                        data-toggle="modal"
                                        data-target="#updateInvoiceAmountModal">
                                    Update Invoice Amount
                                </button>
                            </div>
                        </div>
                        <hr class="mt-10">
                        {{--Parts--}}
                        @if ($claim[0]->replace_order == 0)
                            <div class="row">
                                {{--Parts Required--}}
                                <div class="col-sm-3 col-md-4">
                                    <p class="detail-label bold-text">
                                        <span class="fa fa-cog" aria-hidden="true"></span>
                                        Parts Required?
                                    </p>
                                </div>
                                @if ($claim[0]->part_needed == 0)
                                    <div class="col-sm-9 col-md-8">
                                        <p>No</p>
                                    </div>
                                @else
                                    <div class="col-sm-9 col-md-8">
                                        <p>Yes</p>
                                    </div>
                                    {{--Part Needed--}}
                                    <div class="col-sm-3 col-md-4">
                                        <p class="detail-label bold-text">
                                            Parts Needed
                                        </p>
                                    </div>
                                    <div class="col-sm-9 col-md-8">
                                        <p>{{ $claim[0]->parts_needed }}</p>
                                    </div>
                                    {{--Ship Parts To--}}
                                    <div class="col-sm-3 col-md-4">
                                        <p class="detail-label bold-text">
                                            <span class="fa fa-truck" aria-hidden="true"></span>
                                            Ship Parts To
                                        </p>
                                    </div>
                                    <div class="col-sm-9 col-md-8">
                                        <p>{{ $claim[0]->ship_to }}</p>
                                    </div>
                                    {{--Parts Available--}}
                                    <div class="col-sm-3 col-md-4">
                                        <p class="detail-label bold-text">
                                            Parts Available?
                                        </p>
                                    </div>
                                    <div class="col-sm-9 col-md-8">
                                        <p>
                                            @if (!isset($claim[0]->parts_available))
                                                Waiting for response from TWC...
                                            @elseif ($claim[0]->parts_available == 0)
                                                Parts unavailable from TWC
                                            @elseif ($claim[0]->parts_available == 1)
                                                Parts are available from TWC
                                            @endif
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @endif
                        {{--TWC Comment--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    <span class="fa fa-comment" aria-hidden="true"></span>
                                    TWC Comment
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                <p>{{ $claim[0]->part_company_comment }}</p>
                            </div>
                        </div>
                        {{--Tracking Number--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    <span class="fa fa-truck" aria-hidden="true"></span>
                                    Tracking Number
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                            @if ($claim[0]->replace_order == 1 && !isset($claim[0]->tracking_number))
                                <!-- Enter Tracking # -->
                                    <button type="button" id="enter-tracking"
                                            class="btn btn-warning btn-xs"
                                            data-claim="{{ $claim[0]->claim_id }}"
                                            data-toggle="modal"
                                            data-target="#enterTrackingModal">
                                        <span class="fa fa-exclamation-triangle"
                                              aria-hidden="true"></span>
                                        Enter Tracking Number
                                    </button>
                                @else
                                    {{ $claim[0]->tracking_number }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{--Product Panel--}}
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="fa fa-suitcase" aria-hidden="true"></span>
                            Product
                        </h3>
                    </div>
                    <div class="panel-body">
                        {{--Product Style--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    <span class="fa fa-home" aria-hidden="true"></span>
                                    Product Style
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                <p>{{ $claim[0]->product_style }}</p>
                            </div>
                        </div>
                        {{--Damage Code--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    <span class="fa fa-fire" aria-hidden="true"></span>
                                    Damage Code
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                <p>{{ $claim[0]->dc_id }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Customer Panel--}}
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="fa fa-user" aria-hidden="true"></span>
                            Customer
                        </h3>
                    </div>
                    <div class="panel-body">
                        {{--Name--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    <span class="fa fa-user" aria-hidden="true"></span>
                                    Name
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                <p>{{ $claim[0]->cust_first_name }} {{ $claim[0]->cust_last_name }}</p>
                            </div>
                        </div>
                        {{--Phone--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    <span class="fa fa-mobile" aria-hidden="true"></span>
                                    Phone
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                <p>{{ $claim[0]->cust_phone }}</p>
                            </div>
                        </div>
                        {{--Email--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    <span class="fa fa-envelope" aria-hidden="true"></span>
                                    Email
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                <p>
                                    <a href="mailto:{{ $claim[0]->cust_email }}?subject=RBH Warranty Claim #{{ $claim[0]->claim_id }}"
                                       target="_top">
                                        {{ $claim[0]->cust_email }}
                                    </a>
                                </p>
                            </div>
                        </div>
                        {{--Address--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    <span class="fa fa-home" aria-hidden="true"></span>
                                    Address
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                <p>
                                    {{ $claim[0]->cust_address }}
                                    {{--Only display address 2 if it's not blank--}}
                                    @if($claim[0]->cust_address_2)
                                        {{ $claim[0]->cust_address_2 }}
                                    @endif
                                    <br>
                                    {{ $claim[0]->cust_city }},
                                    {{ $claim[0]->cust_state }}
                                    {{ $claim[0]->cust_zip }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Repair Center Panel--}}
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="fa fa-cogs" aria-hidden="true"></span>
                            Repair Center
                        </h3>
                    </div>
                    <div class="panel-body">
                        {{--Name--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    <span class="fa fa-cogs" aria-hidden="true"></span>
                                    Name
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                <p>{{ $claim[0]->rc_name }}</p>
                            </div>
                        </div>
                        {{--Contact Name--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    <span class="fa fa-user" aria-hidden="true"></span>
                                    Contact Name
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                <p>{{ $claim[0]->rc_contact }}</p>
                            </div>
                        </div>
                        {{--Phone--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    <span class="fa fa-mobile" aria-hidden="true"></span>
                                    Phone
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                <p>{{ $claim[0]->rc_phone }}</p>
                            </div>
                        </div>
                        {{--Email--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    <span class="fa fa-envelope" aria-hidden="true"></span>
                                    Email
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                <p>
                                    <a href="mailto:{{ $claim[0]->rc_email }}?subject=RBH Warranty Claim #{{ $claim[0]->claim_id }}"
                                       target="_top">
                                        {{ $claim[0]->rc_email }}
                                    </a>
                                </p>
                            </div>
                        </div>
                        {{--Address--}}
                        <div class="row">
                            <div class="col-sm-3 col-md-4">
                                <p class="detail-label bold-text">
                                    <span class="fa fa-home" aria-hidden="true"></span>
                                    Address
                                </p>
                            </div>
                            <div class="col-sm-9 col-md-8">
                                <p>
                                    {{ $claim[0]->rc_address }}
                                    <br>
                                    {{ $claim[0]->rc_city }},
                                    {{ $claim[0]->rc_state }}
                                    {{ $claim[0]->rc_zip }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--Comments--}}
            @include('claim.comments')
        </div>

        {{--Back Button--}}
        <div class="row">
            <div class="col-xs-12">
                <hr class="mt-15">
                <a href="{{ route('claim-index') }}" class="btn btn-primary">
                    Back
                </a>
            </div>
        </div>
    </div>

    <!-- Include modal views -->
    @include('claim.repl-order-modal')
    @include('claim.tracking-number-modal')
    @include('claim.invoice-amount-modal')
@endsection
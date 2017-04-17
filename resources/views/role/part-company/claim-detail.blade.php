@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <h2>
        	<span class="fa fa-file-text" aria-hidden="true"></span>
            Claim #{{ $claim[0]->claim_id }}

            {{--Action button--}}
        </h2>
        <hr>
    </div>
</div>
    {{--Claim--}}
    <div class="row">
        @if(Session::has('email-message'))
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
        @endif
    </div>

    @if(Session::has('message'))
    	<div class="row">
            <ul class="alert alert-success">
               	{{ Session::get('message') }}
            </ul>
        </div>
    @endif

<div class="row">
    <div id="claim-detail" class="col-md-6">
        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        Claim #{{ $claim[0]->claim_id }}
                    </h3>
                </div>
                <div class="panel-body">
                    <dl class="dl-horizontal">
                        <dt>Status</dt>
                        <dd>
                            @if ($claim[0]->claim_date_closed)
                                Closed
                            @else
                                Open
                            @endif
                        </dd>
                        <dt>Claim Type</dt>
                        <dd>
                            @if ($claim[0]->replace_order == 1)
                                <span class="glyphicon glyphicon-briefcase"
                                      aria-hidden="true"></span>
                                Replace Order
                            @else
                                <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                                Repair Order
                            @endif
                        </dd>

                        <dt>Opened Date</dt>
                        <dd>{{ $claim[0]->claim_created_at }}</dd>
                        @if ($claim[0]->claim_date_closed)
                            <dt>Closed Date</dt>
                            <dd>{{ $claim[0]->claim_date_closed }}</dd>
                        @endif
                        <dt>Email Sent</dt>
                        <dd>
                            @if ($claim[0]->claim_email_sent > 0)
                                Yes
                            @else
                                No
                            @endif
                        </dd>

                        @if ($claim[0]->replace_order == 0)
                            <hr>
                            <dt>Parts Required?</dt>

                            @if ($claim[0]->part_needed == 0)
                                <dd>No</dd>
                            @else
                                <dd>Yes</dd>
                                <dt>Parts Needed</dt>
                                <dd>{{ $claim[0]->parts_needed }}</dd>
                                <dt>Ship Parts To</dt>
                                <dd>{{ $claim[0]->ship_to }}</dd>
                                <dt>Parts Available?</dt>
                                <dd>
                                    @if (!isset($claim[0]->parts_available))
                                        @role('ricardo-beverly-hills')
                                            Waiting for response from TWC...
                                        @endrole
                                        @role('part-company')
                                            <!-- Enter part availability -->
                                            <div>
                                                <button 
                                                    type="button"
                                                    id="enter-part-availability" 
                                                    class="btn btn-warning btn-xs"
                                                    data-claim="{{ $claim[0]->claim_id }}"
                                                    data-parts="{{ $claim[0]->parts_needed }}"
                                                    data-toggle="modal"
                                                    data-target="#enterPartAvailabilityModal">
                                                <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
                                                    Enter Part Availability
                                                </button>
                                            </div>
                                        @endrole
                                    @elseif ($claim[0]->parts_available == 0)
                                        Parts unavailable from TWC
                                    @elseif ($claim[0]->parts_available == 1)
                                        Parts are available from TWC
                                    @endif
                                    @role('ricardo-beverly-hills')
                                        @if ($claim[0]->replace_order == 0)
                                            <!-- Convert to Replace Order button -->
                                            <div>
                                            	@if($claim[0]->parts_available == 0)
	                                                <button 
	                                                    type="button"
	                                                    id="convert-to-replace-order" 
	                                                    class="btn btn-warning btn-xs"
	                                                    data-claim="{{ $claim[0]->claim_id }}"
	                                                    data-toggle="modal"
	                                                    data-target="#convertToReplaceOrderModal">
	                                                <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
	                                            @else
		                                            <button 
		                                                    type="button"
		                                                    id="convert-to-replace-order" 
		                                                    class="btn btn-primary btn-xs"
		                                                    data-claim="{{ $claim[0]->claim_id }}"
		                                                    data-toggle="modal"
		                                                    data-target="#convertToReplaceOrderModal">
	                                            @endif
                                                    Convert to Replace Order
                                                </button>
                                            </div>
                                        @endif
                                    @endrole
                                </dd>
                            @endif
                        @endif
                        <dt>TWC Comment</dt>
                        <dd>{{ $claim[0]->part_company_comment }}</dd>
                        <dt>Tracking Number</dt>
                        <dd>
                            @if ($claim[0]->parts_available && !isset($claim[0]->tracking_number))
                                @role('part-company')
                                    <!-- Enter Tracking # -->
                                    <div>
                                        <button 
                                            type="button"
                                            id="enter-tracking" 
                                            class="btn btn-warning btn-xs"
                                            data-claim="{{ $claim[0]->claim_id }}"
                                            data-toggle="modal"
                                            data-target="#enterTrackingModal">
                                            <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
                                            Enter Tracking Number
                                        </button>
                                    </div>
                                @endrole
                            @endif
                            {{ $claim[0]->tracking_number }}
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                        Product
                    </h3>
                </div>
                <div class="panel-body">
                    <dl class="dl-horizontal">
                        <dt>Product Style</dt>
                        <dd>{{ $claim[0]->product_style }}</dd>
                        <dt>Damage Code</dt>
                        <dd>{{ $claim[0]->dc_id }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        Customer
                    </h3>
                </div>
                <div class="panel-body">
                    <dl class="dl-horizontal">
                        <dt>Name</dt>
                        <dd>{{ $claim[0]->cust_first_name }} {{ $claim[0]->cust_last_name }}</dd>
                        <dt>
                            <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
                            Phone
                        </dt>
                        <dd>{{ $claim[0]->cust_phone }}</dd>
                        <dt>
                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                            Email
                        </dt>
                        <dd>
                            <a href="mailto:{{ $claim[0]->cust_email }}?Subject=RBH Warranty Claim #{{ $claim[0]->claim_id }}"
                               target="_top">
                                {{ $claim[0]->cust_email }}
                            </a>
                        </dd>
                        <dt>
                            <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                            Address
                        </dt>
                        <dd>
                            {{ $claim[0]->cust_address }}<br>
                            <!-- Only display address 2 if it's not blank -->
                            @if($claim[0]->cust_address_2)
                                {{ $claim[0]->cust_address_2 }}<br>
                            @endif
                            {{ $claim[0]->cust_city }}, {{ $claim[0]->cust_state }}
                            , {{ $claim[0]->cust_zip }}
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                        Repair Center
                    </h3>
                </div>
                <div class="panel-body">
                    <dl class="dl-horizontal">
                        <dt>Name</dt>
                        <dd>{{ $claim[0]->rc_name }}</dd>
                        <dt>Contact Name</dt>
                        <dd>{{ $claim[0]->rc_contact }}</dd>
                        <dt>
                            <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
                            Phone
                        </dt>
                        <dd>{{ $claim[0]->rc_phone }}</dd>
                        <dt>
                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                            Email
                        </dt>
                        <dd>
                            <a href="mailto:{{ $claim[0]->rc_email }}?Subject=RBH Warranty Claim #{{ $claim[0]->claim_id }}"
                               target="_top">
                                {{ $claim[0]->rc_email }}
                            </a>
                        </dd>
                        <dt>
                            <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                            Address
                        </dt>
                        <dd>
                            {{ $claim[0]->rc_address }}<br>
                            {{ $claim[0]->rc_city }}, {{ $claim[0]->rc_state }}
                                                    , {{ $claim[0]->rc_zip }}
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5 col-md-offset-1">
        @include('claim.comments')
    </div>
</div>

<div class="row">
    <div class="col-xs-4">
        <a href="{{ route('claim-index') }}" class="btn btn-primary">
            Back
        </a>
    </div>
</div>

    <!-- Include modal views -->
    @include('role.part-company.tracking-number-modal')
    @include('role.part-company.part-availability-modal')
@endsection
@extends('layouts.master-narrow')

@section('content')
    <div id="customer-more-details">
        <div class="row">
            <div class="col-xs-12">
                <h2><span class="fa fa-user" aria-hidden="true"></span>
                    {{ $customerDetail[0]->first_name . ' ' . $customerDetail[0]->last_name }}
                </h2>
                <hr>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Details
                </h3>
            </div>
            <div class="panel-body">
                {{--Phone--}}
                <div class="row">
                    <div class="col-xs-4 col-sm-3">
                        <p class="pull-right bold">
                            <span class="fa fa-mobile" aria-hidden="true"></span>
                            Phone
                        </p>
                    </div>
                    <div class="col-xs-8 col-sm-9">
                        <p>{{ $customerDetail[0]->phone }}</p>
                    </div>
                </div>
                {{--Email--}}
                <div class="row">
                    <div class="col-xs-4 col-sm-3">
                        <p class="pull-right bold">
                            <span class="fa fa-envelope" aria-hidden="true"></span>
                            Email
                        </p>
                    </div>
                    <div class="col-xs-8 col-sm-9">
                        <p>{{ $customerDetail[0]->email }}</p>
                    </div>
                </div>
                {{--Address--}}
                <div class="row">
                    <div class="col-xs-4 col-sm-3">
                        <p class="pull-right bold">
                            <span class="fa fa-home" aria-hidden="true"></span>
                            Address
                        </p>
                    </div>
                    <div class="col-xs-8 col-sm-9">
                        <p>{{ $customerDetail[0]->address }}
                            @if($customerDetail[0]->address_2)
                                {{ $customerDetail[0]->address_2 }}
                            @endif
                            <br>
                            {{ $customerDetail[0]->city }}
                            {{ $customerDetail[0]->state }}
                            {{ $customerDetail[0]->zip }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Claims</h3>
            </div>
            <div class="panel-body">
                @foreach ($customerClaims as $claim)
                    <div class="row">
                        <div class="col-xs-4 col-sm-3">
                            <p class="pull-right bold-text">
                                <span class="fa fa-file-text" aria-hidden="true"></span>
                                Claim
                            </p>
                        </div>
                        <div class="col-xs-8 col-sm-9">
                            <a href="{{ URL::route('claim', ['id' => $claim->claim_id]) }}">
                                <button class="btn btn-primary btn-xs col-xs-6">
                                    #{{ $claim->claim_id }}
                                </button>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

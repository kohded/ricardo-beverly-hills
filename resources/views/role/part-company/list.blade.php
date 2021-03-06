@extends('layouts.master')

@section('content')
    <div id="claim-list">
        <div class="row">
            <div class="col-xs-12">
                <h2>
                	<span class="fa fa-file-text"></span>
                    Claims
                </h2>
                <hr>
            </div>
        </div>

        @include('claim.filter-form')

        <div class="row">
            <div class="col-xs-12">
                {{--Alert Messages--}}
                @if(Session::has('message'))
                    <p class="alert alert-danger">
                        {{ Session::get('message') }}
                    </p>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>
                                <span class="glyphicon glyphicon-alert" aria-hidden="true" title="Action needed!"></span>
                            </th>
                            <th>
                                <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                @if(session::get('filterTypeClaims') == 'claim_id' && session::get('filterOrder') == 'desc')
                                    <a href="{{ URL::route('pc-claim-filter-index', ['filterType' => 'claim_id', 'filterOrder' => 'asc' ]) }}">Claim</a>
                                @else
                                    <a href="{{ URL::route('pc-claim-filter-index', ['filterType' => 'claim_id', 'filterOrder' => 'desc' ]) }}">Claim</a>
                                @endif
                            </th>
                            <th>
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                @if(session::get('filterTypeClaims') == 'last' && session::get('filterOrder') == 'desc')
                                    <a href="{{ URL::route('pc-claim-filter-index', ['filterType' => 'last', 'filterOrder' => 'asc' ]) }}">Customer</a>
                                @else
                                    <a href="{{ URL::route('pc-claim-filter-index', ['filterType' => 'last', 'filterOrder' => 'desc' ]) }}">Customer</a>
                                @endif
                            </th>
                            <th>
                                <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                                @if(session::get('filterTypeClaims') == 'style' && session::get('filterOrder') == 'desc')
                                    <a href="{{ URL::route('pc-claim-filter-index', ['filterType' => 'style', 'filterOrder' => 'asc' ]) }}">Product Style</a>
                                @else
                                    <a href="{{ URL::route('pc-claim-filter-index', ['filterType' => 'style', 'filterOrder' => 'desc' ]) }}">Product Style</a>
                                @endif
                            </th>
                            <th>
                                <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                                @if(session::get('filterTypeClaims') == 'repair_center' && session::get('filterOrder') == 'desc')
                                    <a href="{{ URL::route('pc-claim-filter-index', ['filterType' => 'repair_center', 'filterOrder' => 'asc' ]) }}">Repair Center</a>
                                @else
                                    <a href="{{ URL::route('pc-claim-filter-index', ['filterType' => 'repair_center', 'filterOrder' => 'desc' ]) }}">Repair Center</a>
                                @endif
                            </th>
                            <th>
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                @if(session::get('filterTypeClaims') == 'created_at' && session::get('filterOrder') == 'desc')
                                    <a href="{{ URL::route('pc-claim-filter-index', ['filterType' => 'created_at', 'filterOrder' => 'asc' ]) }}">Date Opened</a>
                                @else
                                    <a href="{{ URL::route('pc-claim-filter-index', ['filterType' => 'created_at', 'filterOrder' => 'desc' ]) }}">Date Opened</a>
                                @endif
                            </th>
                            <th>
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                @if(session::get('filterTypeClaims') == 'closed_at' && session::get('filterOrder') == 'desc')
                                    <a href="{{ URL::route('pc-claim-filter-index', ['filterType' => 'closed_at', 'filterOrder' => 'asc' ]) }}">Date Closed</a>
                                @else
                                    <a href="{{ URL::route('pc-claim-filter-index', ['filterType' => 'closed_at', 'filterOrder' => 'desc' ]) }}">Date Closed</a>
                                @endif
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($claims as $claim)
                            <a href="{{ URL::route('pc-claim-details', ['id' => $claim->claim_id]) }}">
                                <tr>
                                    <td>
                                        <!-- TWC Needs to enter tracking or select no parts -->
                                        @if (!isset($claim->parts_available) ||
                                             $claim->parts_available && !isset($claim->tracking_number))
                                            <span class="glyphicon glyphicon-alert text-warning" aria-hidden="true" title="Action Needed!"></span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($claim->replace_order == 0)
                                            <span class="glyphicon glyphicon-wrench" aria-hidden="true" title="Repair Order"></span>
                                        @else
                                            <span class="glyphicon glyphicon-briefcase" aria-hidden="true" title="Replace Order"></span>
                                        @endif

                                        <a id="claim-detail" href="{{ URL::route('pc-claim-details', ['id' => $claim->claim_id]) }}">
                                            <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                            {{ $claim->claim_id }}
                                        </a>

                                    </td>
                                    <td>{{ $claim->first . ' ' . $claim->last }}</td>
                                    <td>{{ $claim->style }}</td>
                                    <td>{{ $claim->repair_center }}</td>
                                    <td>{{ $claim->created_at }}</td>
                                    <td>{{ $claim->closed_at }}</td>
                                    </a>
                                </tr>
                            </a>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                {{ $claims->links() }}
            </div>
        </div>
    </div>
@endsection
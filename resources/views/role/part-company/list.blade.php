@extends('layouts.master')

@section('content')
    <div id="claim-list">
        <div class="row">
            <div class="col-xs-12">
                <h2>
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
                                Claim
                            </th>
                            <th>
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                Customer
                            </th>
                            <th>
                                <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                                Product Style
                            </th>
                            <th>
                                <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                                Repair Center
                            </th>
                            <th>
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                Date Opened
                            </th>
                            <th>
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                Date Closed
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
@extends('layouts.master')

@section('content')
    <div id="claim-list">
        <div class="row">
            <div class="col-xs-12">
                <h2>
                    Claims

                    {{--Create button--}}
                    <a id="create-claim" href="{{ URL::route('claim-create') }}" class="btn btn-primary pull-right">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        Create New Claim
                    </a>
                </h2>
                <hr>
            </div>
        </div>

        @include('claim.filter-form')

        <div class="row">
            <div class="col-xs-12">
                {{--Delete claim alert--}}
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
                            <!-- For edit / delete button <td>s -->
                            @role('ricardo-beverly-hills')
                                <th></th><th></th>
                            @endrole
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($claims as $claim)
                            <a href="{{ URL::route('claim', ['id' => $claim->claim_id]) }}">
                                <tr>
                                    <td>
                                        <!-- Ricardo needs to authorize replace order -->
                                        @role('ricardo-beverly-hills')
                                            @if ($claim->part_needed && isset($claim->parts_available) && $claim->parts_available == 0 && !$claim->replace_order)
                                                <span class="glyphicon glyphicon-alert text-warning" aria-hidden="true" title="Action Needed!"></span>
                                            @endif
                                        @endrole
                                        <!-- TWC Needs to enter tracking or select no parts -->
                                        @role('part-company')
                                            @if (!isset($claim->parts_available) ||
                                                 $claim->parts_available && !isset($claim->tracking_number))
                                                <span class="glyphicon glyphicon-alert text-warning" aria-hidden="true" title="Action Needed!"></span>
                                            @endif
                                        @endrole
                                    </td>
                                    <td>
                                        @if ($claim->replace_order == 0)
                                            <span class="glyphicon glyphicon-wrench" aria-hidden="true" title="Repair Order"></span>
                                        @else
                                            <span class="glyphicon glyphicon-briefcase" aria-hidden="true" title="Replace Order"></span>
                                        @endif
                                        @role('ricardo-beverly-hills')
                                            <a id="claim-detail" href="{{ URL::route('claim', ['id' => $claim->claim_id]) }}">
                                                <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                                {{ $claim->claim_id }}
                                            </a>
                                        @endrole
                                        @role('part-company')
                                            <a id="claim-detail" href="{{ URL::route('claim', ['id' => $claim->claim_id]) }}">
                                                <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                                {{ $claim->claim_id }}
                                            </a>
                                        @endrole
                                    </td>
                                    <td>{{ $claim->first . ' ' . $claim->last }}</td>
                                    <td>{{ $claim->style }}</td>
                                    <td>{{ $claim->repair_center }}</td>
                                    <td>{{ $claim->created_at }}</td>
                                    <td>{{ $claim->closed_at }}</td>
                                    </a>

                                    @role('ricardo-beverly-hills')
                                        <td class="table-data-wrap">
                                            <a href="{{ URL::route('claim.edit', [ 'id' => $claim->claim_id])  }}">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true" title="Edit Claim"></span></a>
                                        </td>
                                        <td class="table-data-wrap">
                                            <a  href=""
                                                id="deleteClaimBtn"
                                                class="glyphicon glyphicon-remove text-danger" 
                                                aria-hidden="true" 
                                                data-claim="{{ $claim->claim_id }}"
                                                data-toggle="modal"
                                                data-target="#deleteClaimModal"
                                                title="Delete Claim"></a>
                                        </td>
                                    @endrole


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

    @include('claim.delete-modal')   
@endsection
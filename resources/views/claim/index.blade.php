@extends('layouts.master')

@section('content')
    <div id="claim-list">
        <div class="row">
            <div class="col-xs-12">
                <h2>
                	<span class="fa fa-file-text" aria-hidden="true"></span>
                    Claims

                    {{--Create button--}}
                    <a id="create-claim" href="{{ URL::route('claim-create') }}" class="btn btn-primary pull-right">
                        <span class="fa fa-plus-circle" aria-hidden="true"></span>
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
                                <span class="fa fa-exclamation-triangle" aria-hidden="true" title="Action needed!"></span>
                            </th>
                            <th>
                                <span class="fa fa-file-text" aria-hidden="true"></span>
                                Claim
                            </th>
                            <th>
                                <span class="fa fa-user" aria-hidden="true"></span>
                                Customer
                            </th>
                            <th>
                                <span class="fa fa-suitcase" aria-hidden="true"></span>
                                Product Style
                            </th>
                            <th>
                                <span class="fa fa-cogs" aria-hidden="true"></span>
                                Repair Center
                            </th>
                            <th>
                                <span class="fa fa-calendar-o" aria-hidden="true"></span>
                                Date Opened
                            </th>
                            <th>
                                <span class="fa fa-calendar" aria-hidden="true"></span>
                                Date Closed
                            </th>
                            <!-- For edit / delete button <td>s -->
                            <th></th><th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($claims as $claim)
                            <a href="{{ URL::route('claim', ['id' => $claim->claim_id]) }}">
                                <tr>
                                    <td>
                                        <!-- Ricardo needs to authorize replace order -->
                                        @if ($claim->part_needed && isset($claim->parts_available) && $claim->parts_available == 0 && !$claim->replace_order)
                                            <span class="fa fa-suitcase text-warning" aria-hidden="true" title="Action Needed!"></span>
                                        @endif
                                        <!-- Ricardo needs to enter tracking # -->
                                        @if ($claim->replace_order && !isset($claim->tracking_number))
                                            <span class="fa fa-truck text-warning" aria-hidden="true" title="Action Needed!"></span>
                                        @endif
                                    </td>
                                    <td>
                                    	<a id="claim-detail" href="{{ URL::route('claim', ['id' => $claim->claim_id]) }}">
	                                        @if ($claim->replace_order == 0)
	                                            <span class="fa fa-wrench" aria-hidden="true" title="Repair Order"></span>
	                                        @else
	                                            <span class="fa fa-suitcase" aria-hidden="true" title="Replace Order"></span>
	                                        @endif
                                       
                                            {{ $claim->claim_id }}
                                        </a>
                                    </td>
                                    <td>{{ $claim->first . ' ' . $claim->last }}</td>
                                    <td>{{ $claim->style }}</td>
                                    <td>{{ $claim->repair_center }}</td>
                                    <td>{{ $claim->created_at }}</td>
                                    <td>{{ $claim->closed_at }}</td>
                                    </a>
                                    <td class="table-data-wrap">
                                        <a href="{{ URL::route('claim.edit', [ 'id' => $claim->claim_id])  }}">
                                        <span class="fa fa-pencil-square-o" aria-hidden="true" title="Edit Claim"></span></a>
                                    </td>
                                    <td class="table-data-wrap">
                                        <a  href=""
                                            id="deleteClaimBtn"
                                            class="fa fa-trash text-danger" 
                                            aria-hidden="true" 
                                            data-claim="{{ $claim->claim_id }}"
                                            data-toggle="modal"
                                            data-target="#deleteClaimModal"
                                            title="Delete Claim"></a>
                                    </td>
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
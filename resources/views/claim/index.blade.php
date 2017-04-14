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
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($claims as $claim)
                            <a href="{{ URL::route('claim', ['id' => $claim->claim_id]) }}">
                                <tr>
                                    <td>
                                        <a id="claim-detail" href="{{ URL::route('claim', ['id' => $claim->claim_id]) }}">
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
                                    <!--
                                    <td class="table-data-wrap">
                                        <a href="{{ URL::route('claim.edit', [ 'id' => $claim->claim_id])  }}"
                                           class="btn btn-success btn-sm">Edit</a></td>
                                    <td class="table-data-wrap">
                                        <a href="{{ URL::route('claim.delete', [ 'id' => $claim->claim_id])  }}"
                                           class="btn btn-danger btn-sm">Delete</a></td>
                                    -->

                                    <td class="table-data-wrap">
                                        <a href="{{ URL::route('claim.edit', [ 'id' => $claim->claim_id])  }}">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
                                    <td class="table-data-wrap">
                                        <a href="{{ URL::route('claim.delete', [ 'id' => $claim->claim_id])  }}">
                                           <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>


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
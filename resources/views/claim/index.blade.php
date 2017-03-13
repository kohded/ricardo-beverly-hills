@extends('layouts.master')

@section('content')
    <div id="claim-list">
        <div class="row">
            <div class="col-xs-12">
                <h1>All Claims</h1>

                {{--Delete repair center alert--}}
                @if(Session::has('message'))
                    <p class="alert alert-danger">
                        {{ Session::get('message') }}
                    </p>
                @endif

                {{--Create button--}}
                <a href="{{ URL::route('claim-create') }}" class="btn btn-primary">
                    Create New Claim
                </a>
            </div>
        </div>
        <hr>

        @include('claim.filter-form')

        <div class="row">
            <div class="col-xs-12">
                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>Claim Number</th>
                            <th>Customer</th>
                            <th>Product Style</th>
                            <th>Repair Center</th>
                            <th>Date Opened</th>
                            <th>Date Closed</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($claims as $claim)
                            <a href="{{ URL::route('claim', ['id' => $claim->claim_id]) }}">
                                <tr>
                                    <td>
                                        <a href="{{ URL::route('claim', ['id' => $claim->claim_id]) }}">
                                            <button class="btn btn-primary btn-sm col-xs-12">
                                                {{ $claim->claim_id }}
                                            </button>
                                        </a></td>
                                    <td>{{ $claim->first . ' ' . $claim->last }}</td>
                                    <td>{{ $claim->style }}</td>
                                    <td>{{ $claim->repair_center }}</td>
                                    <td>{{ $claim->created_at }}</td>
                                    <td>{{ $claim->closed_at }}</td>
                                    <td class="table-data-wrap">
                                        <a href="{{ URL::route('claim.edit', [ 'id' => $claim->claim_id])  }}"
                                           class="btn btn-success btn-sm">Edit</a></td>
                                    <td class="table-data-wrap">
                                        <a href="{{ URL::route('claim.delete', [ 'id' => $claim->claim_id])  }}"
                                           class="btn btn-danger btn-sm">Delete</a></td>
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
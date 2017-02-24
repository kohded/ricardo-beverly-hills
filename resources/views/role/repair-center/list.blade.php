@extends('layouts.master')

@section('content')
    <div id="role-repair-center-list">
        <div class="row">
            <div class="col-xs-12">
                <h1>All Claims</h1>
            </div>
        </div>

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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($claims as $claim)
                            <tr>
                                <td>
                                    <a href="{{ route('repair-center-claim.more-details', [
                                        'id' => $claim->claim_id
                                        ]) }}" class="btn btn-primary btn-sm col-xs-12">
                                        {{ $claim->claim_id }}
                                    </a>
                                </td>
                                <td>{{ $claim->first . ' ' . $claim->last }}</td>
                                <td>{{ $claim->style }}</td>
                                <td>{{ $claim->repair_center }}</td>
                                <td>{{ $claim->created_at }}</td>
                                <td>{{ $claim->closed_at }}</td>
                            </tr>
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
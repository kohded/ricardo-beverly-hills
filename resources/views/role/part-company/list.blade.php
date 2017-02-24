@extends('layouts.master')

@section('content')
    <div id="role-part-company-claims-list">
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

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
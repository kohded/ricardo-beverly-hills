@extends('layouts.master')

@section('content')
    <div id="repair-center-list">
        <div class="row">
            <div class="col-xs-12">
                <h2>
                    Repair Centers

                    {{--Create button--}}
                    <a href="{{ route('repair-center.create') }}" class="btn btn-primary pull-right">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        Create Repair Center
                    </a>
                </h2>
                <hr>
            </div>
        </div>


        @include('repair-center.search-form')

        <div class="row">
            <div class="col-xs-12">
                {{--Delete repair center alert--}}
                @if(Session::has('message'))
                    <p class="alert alert-danger">
                        {{ Session::get('message') }}
                    </p>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contact Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Preferred</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($repairCenters as $repairCenter)
                            <tr>
                                <td>{{ $repairCenter->name }}</td>
                                <td>{{ $repairCenter->contact_name }}</td>
                                <td>{{ $repairCenter->phone }}</td>
                                <td>{{ $repairCenter->email }}</td>
                                <td>{{ $repairCenter->address }}</td>
                                <td>{{ $repairCenter->city }}</td>
                                <td>{{ $repairCenter->state }}</td>
                                <td>{{ $repairCenter->preferred ? 'Yes' : 'No' }}</td>
                                <td class="table-data-wrap">
                                    <a id="rc-edit" href="{{ route('repair-center.edit', [
                                        'id' => $repairCenter->id
                                        ]) }}">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </a>
                                </td>
                                <td class="table-data-wrap">
                                    <a href="{{ route('repair-center.delete', [
                                            'id' => $repairCenter->id,
                                            'name' => $repairCenter->name
                                        ]) }}">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                {{ $repairCenters->links() }}
            </div>
        </div>
    </div>
@endsection
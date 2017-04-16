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
                            <th>
                                <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                                Repair Center
                            </th>
                            <th>
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                Contact
                            </th>
                            <th>   
                                <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
                                Phone
                            </th>
                            <th>
                                <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                                Email
                            </th>
                            <th>
                                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                                Address
                            </th>
                            <th>City</th>
                            <th>State</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($repairCenters as $repairCenter)
                            <tr>
                                <td>
                                    @if ($repairCenter->preferred)
                                        <span class="glyphicon glyphicon-star" aria-hidden="true" title="Preferred Repair Center"></span>
                                    @endif
                                    {{ $repairCenter->name }}
                                </td>
                                <td>{{ $repairCenter->contact_name }}</td>
                                <td>{{ $repairCenter->phone }}</td>
                                <td>{{ $repairCenter->email }}</td>
                                <td>{{ $repairCenter->address }}</td>
                                <td>{{ $repairCenter->city }}</td>
                                <td>{{ $repairCenter->state }}</td>
                                <td class="table-data-wrap">
                                    <a id="rc-edit" href="{{ route('repair-center.edit', [
                                        'id' => $repairCenter->id
                                        ]) }}">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true" title="Edit Repair Center"></span>
                                    </a>
                                </td>
                                <td class="table-data-wrap">
                                    <a  href=""
                                                id="deleteRepairCenterBtn"
                                                class="glyphicon glyphicon-remove text-danger" 
                                                aria-hidden="true" 
                                                data-id="{{ $repairCenter->id }}"
                                                data-name="{{ $repairCenter->name }}"
                                                data-toggle="modal"
                                                data-target="#deleteRepairCenterModal"
                                                title="Delete Repair Center">
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

    @include('repair-center.delete-rc-modal')
@endsection
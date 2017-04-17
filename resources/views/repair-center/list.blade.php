@extends('layouts.master')

@section('content')
    <div id="repair-center-list">
        <div class="row">
            <div class="col-xs-12">
                <h2>
                    Repair Centers

                    {{--Create button--}}
                    <a href="{{ route('repair-center.create') }}" class="btn btn-primary pull-right">
                        <span class="fa fa-plus-circle" aria-hidden="true"></span>
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
                                <span class="fa fa-cogs" aria-hidden="true"></span>
                                Repair Center
                            </th>
                            <th>
                                <span class="fa fa-user" aria-hidden="true"></span>
                                Contact
                            </th>
                            <th>   
                                <span class="fa fa-mobile" aria-hidden="true"></span>
                                Phone
                            </th>
                            <th>
                                <span class="fa fa-envelope" aria-hidden="true"></span>
                                Email
                            </th>
                            <th>
                                <span class="fa fa-home" aria-hidden="true"></span>
                                Address
                            </th>
                            <th>
                            	<span class="fa fa-map-marker" aria-hidden="true"></span>
                            	City
                            </th>
                            <th>
                            	<span class="fa fa-map-marker" aria-hidden="true"></span>
                            	State
                            </th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($repairCenters as $repairCenter)
                            <tr>
                                <td>
                                    @if ($repairCenter->preferred)
                                        <span class="fa fa-star" aria-hidden="true" title="Preferred Repair Center"></span>
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
                                        <span class="fa fa-pencil-square-o" aria-hidden="true" title="Edit Repair Center"></span>
                                    </a>
                                </td>
                                <td class="table-data-wrap">
                                    <a  href=""
                                                id="deleteRepairCenterBtn"
                                                class="fa fa-trash text-danger" 
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
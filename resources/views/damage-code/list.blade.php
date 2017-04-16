@extends('layouts.master')

@section('content')
    <div id="repair-center-list">
        <div class="row">
            <div class="col-xs-12">
                <h2>
                    Damage Codes
                    {{--Create button--}}
                    <a href="{{ route('damage-code.create') }}" class="btn btn-primary pull-right">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        Create New Damage Code
                    </a>
                </h2>
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                {{--Delete damage code alert--}}
                @if(Session::has('message'))
                    <p class="alert alert-danger">
                        {{ Session::get('message') }}
                    </p>
                @endif

                <div class="table-responsive col-xs-12 col-md-6">
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>
                                <span class="glyphicon glyphicon-fire" aria-hidden="true"></span>
                                Damage Code</th>
                            <th>Part/Description</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($damageCodes as $damageCode)
                            <tr>
                                <td>{{ $damageCode->id }}</td>
                                <td>{{ $damageCode->part }}</td>
                                <td class="table-data-wrap">
                                    <a id="dc-edit" href="{{ route('damage-code.edit', [
                                        'id' => $damageCode->id
                                        ]) }}">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true" title="Edit Damage Code"></span>
                                    </a>
                                </td>
                                <td class="table-data-wrap">
                                    <a  href=""
                                                id="deleteDamageCodeBtn"
                                                class="glyphicon glyphicon-remove text-danger" 
                                                aria-hidden="true" 
                                                data-id="{{ $damageCode->id }}"
                                                data-name="{{ $damageCode->part }}"
                                                data-toggle="modal"
                                                data-target="#deleteDamageCodeModal"
                                                title="Delete Damage Code">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('damage-code.delete-dc-modal')
@endsection
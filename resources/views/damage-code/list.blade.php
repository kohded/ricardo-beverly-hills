@extends('layouts.master')

@section('content')
    <div id="repair-center-list">
        <div class="row">
            <div class="col-xs-12">
                <h1>Damage Codes</h1>

                {{--Create button--}}
                <a href="{{ route('damage-code.create') }}" class="btn btn-primary">
                    Create Damage Code
                </a>
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
                            <th>Damage Code</th>
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
                                    <a href="{{ route('damage-code.edit', [
                                        'id' => $damageCode->id
                                        ]) }}" class="btn btn-success btn-sm">Edit
                                    </a>
                                </td>
                                <td class="table-data-wrap">
                                    <a href="{{ route('damage-code.delete', [
                                            'id' => $damageCode->id,
                                            'part' => $damageCode->part
                                        ]) }}" class="btn btn-danger btn-sm">Delete
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
@endsection
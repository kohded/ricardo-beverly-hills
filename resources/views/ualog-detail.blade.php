@extends('layouts.master')

@section('content')
    <h1>UA LOG</h1>
    <p>If a value was deleted then this page will show you the data that was deleted. Other wise this page will show you the new values that where added or changed.</p>

    <div class="table-responsive">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>
                    Value Type
                </th>
                <th>
                    Value
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($logDetails as $logDetail)
                <tr>
                    <td>
                        {{ str_replace("_", " ", $logDetail->value_type) }}
                    </td>
                    <td>
                        {{ $logDetail->value }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
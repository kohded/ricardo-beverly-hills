@extends('layouts.master-narrow')
@section('content')

        <div class="jumbotron">
            <h1>A {{ $type }} with the id of {{ $id }} does not exist</h1>
            <p>The {{ $type }} you were looking for doesn't exist. Please return to the previous page and try again. </p>
        </div>

        <a href="{{ back() }}" class="btn btn-default">Return to Claims Index</a>

@endsection

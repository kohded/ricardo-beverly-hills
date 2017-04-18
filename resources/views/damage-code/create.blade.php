@extends('layouts.master-narrow')

@section('content')
    <div id="damage-code-create">
        <div class="row">
            <div class="col-xs-12">
                <h2>Create Damage Code</h2>
                <hr>
            </div>
        </div>
        {{--Form successfully created damage code--}}
        @if(Session::has('message'))
            <div class="row">
                <div class="col-xs-12">
                    <p class="alert alert-success">
                        {{ Session::get('message') }}
                    </p>
                </div>
            </div>
        @endif
        {{--Form validation errors--}}
        @if(count($errors) > 0)
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <form action="{{ route('damage-code.create') }}" method="post">
                {{--Damage Code ID--}}
                <div class="form-group col-xs-4">
                    <label for="damage-code-name">Code</label>
                    <input type="text" class="form-control"
                           id="damage-code-id" name="id"
                           value="{{ old('id') }}">
                </div>
                {{--Part/Description--}}
                <div class="form-group col-xs-8">
                    <label for="damage-code-part">Part/Description</label>
                    <input type="text" class="form-control"
                           id="damage-code-part" name="part"
                           value="{{ old('part') }}">
                </div>
                {{--Submit--}}
                <div class="form-group col-xs-12">
                    <hr>
                    <a href="{{ route('damage-code') }}" class="btn btn-primary">
                        Back
                    </a>
                    <button type="submit" class="btn btn-primary pull-right">
                        Submit
                    </button>
                </div>
                {{--Token--}}
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection
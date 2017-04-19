@extends('layouts.master-narrow')

@section('content')
    <div id="email-password-reset">
        <div class="row">
            <div class="col-xs-12">
                <h2>Email Password Reset</h2>
                <hr>
            </div>
        </div>
        {{--Form successfully emailed password reset--}}
        @if (session('status'))
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        @endif
        {{--Form validation errors--}}
        @if(count($errors) > 0)
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <form role="form" method="POST" action="{{ url('/password/email') }}">
                {{--Email--}}
                <div class="form-group col-xs-12 {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email"
                           value="{{ old('email') }}" required>
                </div>
                {{--Submit--}}
                <div class="form-group col-xs-12">
                    <hr>
                    <button type="submit" class="btn btn-primary pull-right">
                        Email Password Reset Link
                    </button>
                </div>
                {{--Token--}}
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection

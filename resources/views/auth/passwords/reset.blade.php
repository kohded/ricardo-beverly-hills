@extends('layouts.master-narrow')

@section('content')
    <div id="reset-password">
        <div class="row">
            <div class="col-xs-12">
                <h2>Reset Password</h2>
                <hr>
            </div>
        </div>
        {{--Form successfully reset password--}}
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
            <form role="form" method="POST" action="{{ url('/password/reset') }}">
                {{--Email--}}
                <div class="form-group col-xs-12 {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email"
                           value="{{ $email or old('email') }}" required autofocus>
                </div>
                {{--Password--}}
                <div class="form-group col-xs-12 {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control"
                           name="password" required>
                </div>
                {{--Confirm Password--}}
                <div class="form-group col-xs-12 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control"
                           name="password_confirmation" required>
                </div>
                {{--Submit--}}
                <div class="form-group col-xs-12">
                    <hr>
                    <button type="submit" class="btn btn-primary pull-right">
                        Reset Password
                    </button>
                </div>
                {{--Reset Token--}}
                <input type="hidden" name="token" value="{{ $token }}">
                {{--Token--}}
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection

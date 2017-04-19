@extends('layouts.master-narrow')

@section('content')
    <div id="login-user">
        <div class="row">
            <div class="col-xs-12">
                <h2>Login</h2>
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
            <form role="form" method="POST" action="{{ url('/login') }}">
                {{--Email--}}
                <div class="form-group col-xs-12 {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email"
                           value="{{ old('email') }}" required autofocus>
                </div>
                {{--Password--}}
                <div class="form-group col-xs-12 {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password"
                           required>
                </div>
                <div class="form-group">
                    {{--Forgot Your Password--}}
                    <div class="col-xs-6">
                        <a href="{{ url('/password/reset') }}" class="btn btn-link" id="forgot-password">
                            Forgot Your Password?
                        </a>
                    </div>
                    {{--Remember Me--}}
                    <div class="checkbox col-xs-6">
                        <label class="pull-right">
                            <input type="checkbox"
                                   name="remember" {{ old('remember') ? 'checked' : ''}}>
                            Remember Me
                        </label>
                    </div>
                </div>
                {{--Submit--}}
                <div class="form-group col-xs-12">
                    <hr>
                    <button type="submit" class="btn btn-primary pull-right">
                        Login
                    </button>
                </div>
                {{--Token--}}
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection

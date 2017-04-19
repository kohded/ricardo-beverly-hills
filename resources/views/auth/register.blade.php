@extends('layouts.master-narrow')

@section('content')
    <div id="register">
        <div class="row">
            <div class="col-xs-12">
                <h2>Register User</h2>
                <hr>
            </div>
        </div>
        {{--Form successfully registered user--}}
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
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <form role="form" method="POST" action="{{ url('/register') }}">
                {{--Name--}}
                <div class="form-group col-xs-12{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>
                    <input id="name" type="text" class="form-control" name="name"
                           value="{{ old('name') }}" required autofocus>
                </div>
                {{--Email--}}
                <div class="form-group col-xs-12 {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email"
                           value="{{ old('email') }}" required>
                </div>
                {{--Password--}}
                <div class="form-group col-xs-12 {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password"
                           required>
                </div>
                {{--Confirm Password--}}
                <div class="form-group col-xs-12">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control"
                           name="password_confirmation" required>
                </div>
                {{--Role--}}
                <div class="form-group col-xs-12">
                    <label for="role">User Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="ricardo-beverly-hills">Ricardo Beverly Hills</option>
                        <option value="part-company">Part Company</option>
                        <option value="repair-center">Repair Center</option>
                    </select>
                </div>
                {{--Submit--}}
                <div class="form-group col-xs-12">
                    <hr>
                    <button type="submit" class="btn btn-primary pull-right">
                        Register
                    </button>
                </div>
                {{--Token--}}
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection

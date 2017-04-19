@extends('layouts.master-narrow')

@section('content')
    <div id="repair-center-create">
        <div class="row">
            <div class="col-xs-12">
                <h2>Create Repair Center</h2>
                <hr>
            </div>
        </div>
        {{--Form successfully created repair center--}}
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
            <form action="{{ route('repair-center.create') }}" method="post">
                {{--Name--}}
                <div class="form-group col-sm-6">
                    <label for="repair-center-name">Name</label>
                    <input type="text" class="form-control"
                           id="repair-center-name" name="name"
                           value="{{ old('name') }}">
                </div>
                {{--Contact Name--}}
                <div class="form-group col-sm-6">
                    <label for="repair-center-contact-name">Contact Name</label>
                    <input type="text" class="form-control"
                           id="repair-center-contact-name" name="contact-name"
                           value="{{ old('contact-name') }}">
                </div>
                {{--Phone--}}
                <div class="form-group col-sm-6">
                    <label for="repair-center-phone">Phone #</label>
                    <input type="tel" class="form-control"
                           id="repair-center-phone" name="phone"
                           value="{{ old('phone') }}">
                </div>
                {{--Email--}}
                <div class="form-group col-sm-6">
                    <label for="repair-center-email">Email</label>
                    <input type="email" class="form-control"
                           id="repair-center-email" name="email"
                           value="{{ old('email') }}">
                </div>
                {{--Address--}}
                <div class="form-group col-xs-12">
                    <label for="repair-center-address">Address</label>
                    <input type="text" class="form-control"
                           id="repair-center-address" name="address"
                           value="{{ old('address') }}">
                </div>
                {{--City--}}
                <div class="form-group col-sm-6">
                    <label for="repair-center-city">City</label>
                    <input type="text" class="form-control"
                           id="repair-center-city" name="city"
                           value="{{ old('city') }}">
                </div>
                {{--State--}}
                <div class="form-group col-xs-6 col-sm-3">
                    <label for="repair-center-state">State</label>
                    <input type="text" class="form-control"
                           id="repair-center-state" name="state"
                           value="{{ old('state') }}">
                </div>
                {{--Zip--}}
                <div class="form-group col-xs-6 col-sm-3">
                    <label for="repair-center-zip">Zip</label>
                    <input type="text" class="form-control"
                           id="repair-center-zip" name="zip"
                           value="{{ old('zip') }}">
                </div>
                {{--Preferred--}}
                <div class="form-check col-xs-6 col-xs-offset-6">
                    <label for="repair-center-preferred" class="pull-right"
                           id="repair-center-preferred-label">
                        <input type="checkbox" class="form-check-input"
                               id="repair-center-preferred" name="preferred" value="1">
                        Preferred
                    </label>
                </div>
                {{--Submit--}}
                <div class="form-group col-xs-12">
                    <hr>
                    <a href="{{ route('repair-center') }}" class="btn btn-primary">
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
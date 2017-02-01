@extends('layouts.master')

@section('content')
    <div id="product-create">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                {{--<h4>{{ $title }}</h4>--}}

                <form action="{{ route('product.create') }}" method="post">

                    <legend>New Product</legend>

                    <div class="form-group col-xs-6">
                        <label for="product-style">Style #</label>
                        <input type="text" class="form-control" id="product-style" name="style" placeholder="11 Digit Style Code">
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="product-description">Description</label>
                        <input type="text" class="form-control" id="product-description" name="description" placeholder="">
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="product-brand">Brand</label>
                        <input type="text" class="form-control" id="product-brand" name="brand" placeholder="">
                    </div>

                    <div class="form-group col-xs-3">
                        <label for="product-warranty-years">Warranty</label>
                        <input type="text" class="form-control" id="product-warranty-years" name="warranty" placeholder="# of years">
                    </div>

                    <div class="form-group col-xs-3">
                        <label for="product-color">Color</label>
                        <input type="text" class="form-control" id="product-color" name="color" placeholder="Color">
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="product-class">Class</label>
                        <input type="text" class="form-control" id="product-class" name="class" placeholder="Class">
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="product-class-description">Class Description</label>
                        <input type="text" class="form-control" id="product-class-description" name="class-desc" placeholder="Class Description">
                    </div>

                    <div class="form-group col-xs-4 col-xs-offset-2">
                        <label for="product-launch-date">Launch Date</label>
                        <input type="text" class="form-control" id="product-launch-date" name="launch" placeholder="mm/dd/yyyy">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="product-discontinued">Discontinued Date</label>
                        <input type="text" class="form-control" id="product-discontinued" name="discontinued" placeholder="mm/dd/yyyy">
                    </div>

                    <div class="form-group col-xs-12">
                        <hr />
                        <button type="submit" class="btn btn-primary col-xs-4 col-xs-offset-4">Submit</button>
                        {{--Token--}}
                        {{ csrf_field() }}
                    </div>
                </form>
            </div>
        </div>

        {{--Form successfully added product--}}
        @if(Session::has('message'))
            <div class="row">
                <div class="col-md-12">
                    <p class="alert alert-success">
                        {{ Session::get('message') }}
                    </p>
                </div>
            </div>
        @endif

        {{--Form validation errors--}}
        @if(count($errors) > 0)
            <div class="row">
                <div class="col-md-12">
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
        
    </div>
@endsection
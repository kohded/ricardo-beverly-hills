@extends('layouts.master-narrow')

@section('content')
    <div id="product-create">
        <div class="row">
            <div class="col-xs-12">
                <h2>Create Product</h2>
                <hr>
            </div>
        </div>
        {{--Form successfully created product--}}
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
            <form action="{{ route('product.create') }}" method="post">
                {{--Brand--}}
                <div class="form-group col-sm-6">
                    <label for="product-brand">Brand</label>
                    <input type="text" class="form-control" id="product-brand" name="brand"
                           placeholder="">
                </div>
                {{--Collection--}}
                <div class="form-group col-sm-6">
                    <label for="product-class">Collection</label>
                    <input type="text" class="form-control" id="product-collection"
                           name="collection">
                </div>
                {{--Style--}}
                <div class="form-group col-xs-6">
                    <label for="product-style">Style</label>
                    <input type="text" class="form-control" id="product-style" name="style"
                           placeholder="11 Character Code">
                </div>
                {{--Color--}}
                <div class="form-group col-xs-6">
                    <label for="product-color">Color</label>
                    <input type="text" class="form-control" id="product-color" name="color">
                </div>
                {{--Launch Date--}}
                <div class="form-group col-xs-6">
                    <label for="product-launch-date">Launch Date</label>
                    <input type="text" class="form-control" id="product-launch-date" name="launch"
                           placeholder="mm/dd/yyyy">
                </div>
                {{--Warranty--}}
                <div class="form-group col-xs-3">
                    <label for="product-warranty-years">Warranty</label>
                    <input type="text" class="form-control" id="product-warranty-years"
                           name="warranty" placeholder="# of Years">
                </div>
                {{--Guarantee--}}
                <div class="form-group col-xs-3">
                    <label for="product-guarantee-years">Guarantee</label>
                    <input type="text" class="form-control" id="product-guarantee-years"
                           name="guarantee" placeholder="# of Years">
                </div>
                {{--Description--}}
                <div class="form-group col-xs-12">
                    <label for="product-description">Description</label>
                    <input type="text" class="form-control" id="product-description"
                           name="description">
                </div>
                {{--Submit--}}
                <div class="form-group col-xs-12">
                    <hr/>
                    <a href="{{ route('product') }}" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
                {{--Token--}}
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection
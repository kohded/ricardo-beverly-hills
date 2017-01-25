@extends('layouts.master')

@section('content')
    <div id="product">
        <div class="row">
            <div class="col-xs-12">
                {{--<h4>{{ $title }}</h4>--}}

                <form>

                    <legend>New Product</legend>

                    <div class="form-group col-xs-3">
                        <label for="inputClaimNumber">Style #</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="">
                    </div>

                    <div class="form-group col-xs-3">
                        <label for="inputClaimNumber">Pieces</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="">
                    </div>

                    <div class="form-group col-xs-3">
                        <label for="inputClaimNumber">By</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="">
                    </div>

                    <div class="form-group col-xs-3">
                        <label for="inputClaimNumber">Warranty</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="inputClaimNumber">Color</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="Color">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="inputClaimNumber">Class</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="Class">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="inputClaimNumber">Class Description</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="Class Description">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="inputClaimNumber">Product PO#</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="">
                    </div>

                    <div class="form-group col-xs-8">
                        <label for="inputClaimNumber">Vendor</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="inputClaimNumber">Launching</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="mm/dd/yy">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="inputClaimNumber">Discontinued</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="Class Description">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="inputClaimNumber">Approximate Wholesale Price</label>
                        <input type="text" class="form-control" id="inputClaimNumber" placeholder="">
                    </div>

                    <button type="submit" class="btn btn-primary col-xs-12">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
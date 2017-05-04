@extends('pdf.layout')

@section('title')
<span class="fa fa-cog"></span>    
Packing Slip
@endsection

@section('content')
<div class="pdf row top-line">
    {{--Part Needed--}}
    <div class="col-xs-3">
        <p class="detail-label bold-text pull-right">
            Parts Included
        </p>
    </div>
    <div class="col-xs-3">
        <p>{{ $claim[0]->parts_needed }}</p>
    </div>
</div>
@endsection
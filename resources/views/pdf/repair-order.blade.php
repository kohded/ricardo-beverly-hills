@extends('pdf.layout')

@section('title')
<span class="fa fa-wrench"></span>    
Repair Order
@endsection

@section('content')
<div class="pdf row top-line">
    {{--Parts Required--}}
    <div class="col-xs-3">
        <p class="detail-label bold-text pull-right">
            <span class="fa fa-cog" aria-hidden="true"></span>
            Parts Required?
        </p>
    </div>
    @if ($claim[0]->part_needed == 0)
    <div class="col-xs-3">
        <p>No</p>
    </div>
    @else
    <div class="col-xs-3">
        <p>Yes</p>
    </div>
</div>
<div class="pdf row">
    {{--Part Needed--}}
    <div class="col-xs-3">
        <p class="detail-label bold-text pull-right">
            Parts Needed
        </p>
    </div>
    <div class="col-xs-3">
        <p>{{ $claim[0]->parts_needed }}</p>
    </div>
</div>
<div class="pdf row">
    {{--Ship Parts To--}}
    <div class="col-xs-3">
        <p class="detail-label bold-text pull-right">
            <span class="fa fa-truck" aria-hidden="true"></span>
            Ship Parts To
        </p>
    </div>
    <div class="col-xs-3">
        <p>{{ $claim[0]->ship_to }}</p>
    </div>
</div>
<div class="pdf row">
    {{--Parts Available--}}
    <div class="col-xs-3">
        <p class="detail-label bold-text pull-right">
            Parts Available?
        </p>
    </div>
    <div class="col-xs-3">
        <p>
            @if (!isset($claim[0]->parts_available))
                Waiting for response from TWC...
            @elseif ($claim[0]->parts_available == 0)
                Parts unavailable from TWC
            @elseif ($claim[0]->parts_available == 1)
                Parts are available from TWC
            @endif
        </p>
    </div>
    @endif
</div>
@endsection
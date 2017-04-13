{{--Image and Title--}}
<div class="row clearfix">
    <div class="col-xs-12">
        <img src="{{$message->embed(public_path() . '/img/logo.jpg')}}"
             class="img-responsive center-block" alt="">
    </div>
    <div class="col-xs-12">
        <h2 class="text-center">
            @if(@isset($claimType))
                {{ $claimType }}
            @endif
        </h2>
        <hr>
        {{ $claimMessage }}
    </div>
</div>

{{--Claim--}}
<div class="row clearfix">
    <div class="col-xs-12">
        <h3>Claim #{{ $claim[0]->claim_id }}</h3>
        <hr>
    </div>
    <div class="col-xs-12">
        <p><strong>Status: </strong>
            @if ($claim[0]->claim_date_closed)
                Closed
            @else
                Open
            @endif
        </p>
        <p><strong>Opened Date: </strong>{{ $claim[0]->claim_created_at }}</p>
        @if ($claim[0]->claim_date_closed)
            <p><strong>Closed Closed: </strong>{{ $claim[0]->claim_date_closed }}</p>
        @endif
        <p><strong>Claim Type: </strong>
            @if ($claim[0]->replaced === 1)
                Replace Order
            @else
                Repair Order
            @endif
        </p>

    </div>
</div>

{{--Part--}}
<div class="row clearfix">
    <div class="col-xs-12">
        <h3>Part</h3>
        <hr>
    </div>
    @if ($claim[0]->replaced === 0)
        <div class="col-xs-12">
            <p><strong>Parts Required: </strong>
                @if ($claim[0]->part_needed === 0)
                    No
                @else
                    Yes
                @endif
            </p>
            @if ($claim[0]->part_needed === 1)
                <p><strong>Parts Needed: </strong>{{ $claim[0]->parts_needed }}</p>
                <p><strong>Parts Available: </strong>
                    @if ($claim[0]->parts_available === 0)
                        Parts unavailable from TWC.
                    @elseif ($claim[0]->parts_available === 1)
                        Parts available from TWC.
                    @else
                        Waiting for response from TWC.
                    @endif
                </p>
                <p><strong>Parts Ship To: </strong>{{ $claim[0]->ship_to }}</p>
            @endif
        </div>
    @endif
</div>

{{--Product--}}
<div class="row clearfix">
    <div class="col-xs-12">
        <h3>Product</h3>
        <hr>
    </div>
    <div class="col-xs-12">
        <p><strong>Product Style: </strong>{{ $claim[0]->product_style }}</p>
        <p><strong>Damage Code: </strong>{{ $claim[0]->dc_id }}</p>
    </div>
</div>

{{--Customer--}}
<div class="row clearfix">
    <div class="col-xs-12">
        <h3>Customer</h3>
        <hr>
    </div>
    <div class="col-xs-12">
        <p>
            <strong>Name: </strong>{{ $claim[0]->cust_first_name }} {{ $claim[0]->cust_last_name }}
        </p>
        <p><strong>Phone: </strong>{{ $claim[0]->cust_phone }}</p>
        <p><strong>Email: </strong>{{ $claim[0]->cust_email }}</p>
        <p><strong>Address: </strong>{{ $claim[0]->cust_address }}
            @if($claim[0]->cust_address_2)
                {{ $claim[0]->cust_address_2 }}
            @endif
            {{ $claim[0]->cust_city }}, {{ $claim[0]->cust_state }} {{ $claim[0]->cust_zip }}
        </p>
    </div>
</div>

{{--Repair Center--}}
<div class="row clearfix">
    <div class="col-xs-12">
        <h3>Repair Center</h3>
        <hr>
    </div>
    <div class="col-xs-12">
        <p><strong>Name: </strong>{{ $claim[0]->rc_name }}</p>
        <p><strong>Contact Name: </strong>{{ $claim[0]->rc_contact }}</p>
        <p><strong>Phone: </strong>{{ $claim[0]->rc_phone }}</p>
        <p><strong>Email: </strong>{{ $claim[0]->rc_email }}</p>
        <p>
            <strong>Address: </strong>{{ $claim[0]->rc_address }} {{ $claim[0]->rc_city }},
            {{ $claim[0]->rc_state }} {{ $claim[0]->rc_zip }}
        </p>
    </div>
</div>
@extends('layouts.master')

@section('content')
    <div id="claim-detail">
        {{--Claim--}}
        <div class="row">
            <div class="col-xs-12">
                <h1>Claim #{{ $claim[0]->claim_id }} </h1>
                <hr>
            </div>
            <div class="col-sm-6">
                <p><strong>Opened Date: </strong>{{ $claim[0]->claim_created_at }}</p>
            </div>
            <div class="col-sm-6">
                <p><strong>Closed Closed: </strong>{{ $claim[0]->claim_date_closed }}</p>
            </div>
        </div>

        {{--Product--}}
        <div class="row">
            <div class="col-xs-12">
                <h3>Product</h3>
                <hr>
            </div>
            <div class="col-sm-6">
                <p><strong>Product Style: </strong>{{ $claim[0]->product_style }}</p>
            </div>
            <div class="col-sm-6">
                <p><strong>Damage Code: </strong>{{ $claim[0]->dc_id }}</p>
            </div>
        </div>

        {{--Customer--}}
        <div class="row">
            <div class="col-xs-12">
                <h3>Customer</h3>
                <hr>
            </div>
            <div class="col-sm-6">
                <p><strong>First Name: </strong>{{ $claim[0]->cust_first_name }}</p>
                <p><strong>Last Name: </strong>{{ $claim[0]->cust_last_name }}</p>
                <p><strong>Phone: </strong>{{ $claim[0]->cust_phone }}</p>
                <p><strong>Email: </strong>{{ $claim[0]->cust_email }}</p>
            </div>
            <div class="col-sm-6">
                <p><strong>Address: </strong>{{ $claim[0]->cust_address }}</p>
                <p><strong>Address 2: </strong>{{ $claim[0]->cust_address_2 }}</p>
                <p><strong>City: </strong>{{ $claim[0]->cust_city }}</p>
                <p><strong>State: </strong>{{ $claim[0]->cust_state }}</p>
                <p><strong>Zip: </strong>{{ $claim[0]->cust_zip }}</p>
            </div>
        </div>

        {{--Repair Center--}}
        <div class="row">
            <div class="col-xs-12">
                <h3>Repair Center</h3>
                <hr>
            </div>
            <div class="col-sm-6">
                <p><strong>Name: </strong>{{ $claim[0]->rc_name }}</p>
                <p><strong>Contact Name: </strong>{{ $claim[0]->rc_contact }}</p>
                <p><strong>Phone: </strong>{{ $claim[0]->rc_phone }}</p>
                <p><strong>Email: </strong>{{ $claim[0]->rc_email }}</p>
            </div>
            <div class="col-sm-6">
                <p><strong>Address: </strong>{{ $claim[0]->rc_address }}</p>
                <p><strong>City: </strong>{{ $claim[0]->rc_city }}</p>
                <p><strong>State: </strong>{{ $claim[0]->rc_state }}</p>
                <p><strong>Zip: </strong>{{ $claim[0]->rc_zip }}</p>
            </div>
        </div>

        {{--Comments--}}
        <div class="row">
            <div class="col-xs-12">
                <h3>Comments</h3>
                <hr>
            </div>

            @foreach ($comments as $comment)
                <div class="col-xs-6">
                    <p><strong>Name: </strong>{{ $comment->author }}</p>
                </div>
                <div class="col-xs-6">
                    <p><strong>Created: </strong>{{ $comment->created_at }}</p>
                </div>
                <div class="col-xs-12">
                    <p><strong>Comment: </strong>{{ $comment->comment }}</p>
                    <hr/>
                </div>
            @endforeach
        </div>

        <div class="row">
            {{--Back Button--}}
            <div class="col-xs-4">
                <a href="{{ route('claim-index') }}" class="btn btn-primary">
                    Back
                </a>
            </div>

            {{--Email Button--}}
            <div class="col-xs-8">
                <form action="{{ route('mail.claim-confirmation') }}"
                      method="post" class="pull-right">
                    {{--Claim Id--}}
                    <input type="number" name="claim-id" value="{{ $claim[0]->claim_id }}" hidden>
                    <button type="submit" class="btn btn-primary">Send Email</button>
                    {{ csrf_field() }}
                </form>

                {{--Emails Sent--}}
                <p class="pull-right mt-10 mr-20"><strong>Emails Sent: </strong>0</p>
            </div>
        </div>
    </div>
@endsection
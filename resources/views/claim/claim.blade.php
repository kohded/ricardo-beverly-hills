@extends('layouts.master')

@section('content')
    <div id="claim-detail" class="col-md-8 col-md-offset-2">
        {{--Claim--}}
        <div class="row">
            <div class="col-xs-12">
                <h1>Claim #{{ $claim[0]->claim_id }} </h1>

                @if(Session::has('message'))
                    <p class="alert alert-success">
                        {{ Session::get('message') }}
                    </p>
                @endif

                <hr>
            </div>
            <div class="col-sm-6">
                <p><strong>Opened Date: </strong>{{ $claim[0]->claim_created_at }}</p>
            </div>
            <div class="col-sm-6">
                <p><strong>Closed Date: </strong>{{ $claim[0]->claim_date_closed }}</p>
            </div>
        </div>

        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">Product</div>
                <div class="panel-body">
                    <div class="col-sm-6">
                        <p><strong>Product Style: </strong>{{ $claim[0]->product_style }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p><strong>Damage Code: </strong>{{ $claim[0]->dc_id }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">Customer</div>
                <div class="panel-body">
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
            </div>
        </div>

        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">Repair Center</div>
                <div class="panel-body">
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
            </div>
        </div>

        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">Comments</div>

                <table class="table table-conensed">
                @foreach ($comments as $comment)
                    <tr>
                        <td><strong>Name: </strong>{{ $comment->author }}</td>
                        <td><strong>Posted: </strong>{{ $comment->created_at }}</td>
                        <td><strong>Comment: </strong>{{ $comment->comment }}</td>
                    </tr>
                @endforeach
                    <tr><td colspan="3">
                        <form action="{{ route('claim.add-comment') }}" method="post">
                            <input type="hidden" name="claim_id" value="{{ $claim[0]->claim_id }}">
                            <div class="form-group col-xs-9">
                                <input type="text" class="form-control" id="comment-comment" name="comment" placeholder="Enter new comment...">
                            </div>
                            <div class="form-group col-xs-3">
                                <button class="btn btn-primary" type="submit">Add Comment</button>
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </td></tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-4">
                <a href="{{ route('claim-index') }}" class="btn btn-primary">
                    Back
                </a>
            </div>

            <div class="col-xs-8">
                <form action="{{ route('mail.claim-confirmation') }}"
                      method="post" class="pull-right">
                    <input type="number" name="claim-id" value="{{ $claim[0]->claim_id }}" hidden>
                    <button type="submit" class="btn btn-primary">Send Email</button>
                    {{ csrf_field() }}
                </form>

                <p class="pull-right mt-10 mr-20"><strong>Emails Sent: </strong>0</p>
            </div>
        </div>
    </div>
@endsection
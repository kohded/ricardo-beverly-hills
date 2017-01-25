@extends('layouts.master')

@section('content')
	<h1>All Part Orders</h1>

	<a href="{{ URL::route('part-order-create') }}" class="btn btn-lg btn-primary" role="button">Create New Part Order</a>

	<table class="table">
		<thead>
			<tr>
				<th>Part Order #</th>
				<th>For Claim</th>
				<th>Order Date</th>
				<th>Ship Date</th>
			</tr>
		</thead>

		<tbody>
		@foreach ($part_orders as $part_order)
			<tr>
				<td>{{ $part_order->id }}</td>
				<td>{{ $part_order->claim_id }}</td>
				<td>{{ $part_order->order_date }}</td>
				<td>{{ $part_order->ship_date }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
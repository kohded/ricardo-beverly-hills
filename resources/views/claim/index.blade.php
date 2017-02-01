@extends('layouts.master')

@section('content')
	<h1>All Claims</h1>

	<a href="{{ URL::route('claim-create') }}" class="btn btn-primary" role="button">Create New Claim</a>

	<table class="table">
		<thead>
		<tr>
			<th>Claim ID</th>
			<th>Customer</th>
			<th>Product Style</th>
			<th>Repair Center</th>
			<th>Date Opened</th>
			<th>Date Closed</th>
		</tr>
		</thead>

		<tbody>
		@foreach ($claims as $claim)
			<tr>
				<td>{{ $claim->id }}</td>
				<td>{{ $claim->customer_id }}</td>
				<td>{{ $claim->product_style }}</td>
				<td>{{ $claim->repair_center_id }}</td>
				<td>{{ $claim->date_opened }}</td>
				<td>{{ $claim->date_closed }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
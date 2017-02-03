@extends('layouts.master')

@section('content')
	<h1>All Claims</h1>

	<a href="{{ URL::route('claim-create') }}" class="btn btn-primary" role="button">Create New Claim</a>

	<table class="table">
		<thead>
		<tr>
			<th>Claim Number</th>
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
				<td>{{ $claim->first_name . ' ' . $claim->last_name }}</td>
				<td>{{ $claim->product_style }}</td>
				<td>{{ $claim->name }}</td>
				<td>{{ $claim->created_at }}</td>
				<td>{{ $claim->date_closed }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
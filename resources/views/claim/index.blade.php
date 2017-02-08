@extends('layouts.master')

@section('content')
	<h1>All Claims</h1>

	<a href="{{ URL::route('claim-create') }}" class="btn btn-primary" role="button">Create New Claim</a>

	<table class="table table-hover">
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
			<a href="{{ URL::route('claim', ['id' => $claim->claim_id]) }}">
				<tr>
					<td><a href="{{ URL::route('claim', ['id' => $claim->claim_id]) }}">
					<button class="btn btn-primary col-xs-12">
						{{ $claim->claim_id }}
					</button>
					</a></td>
					<td>{{ $claim->first . ' ' . $claim->last }}</td>
					<td>{{ $claim->style }}</td>
					<td>{{ $claim->repair_center }}</td>
					<td>{{ $claim->created_at }}</td>
					<td>{{ $claim->closed_at }}</td>
				</tr>
			</a>
		@endforeach
		</tbody>
	</table>
	
	<div class="col-xs-12 text-center">
		{{ $claims->links() }}
	</div>
@endsection
@extends('layouts.master')

@section('content')
	<h1>All Products</h1>

	<a href="{{ URL::route('product-create') }}" class="btn btn-lg btn-primary" role="button">Create New Product</a>

	<table class="table">
		<thead>
			<tr>
				<th>Style</th>
				<th>Description</th>
				<th>Brand</th>
				<th>Warranty</th>
				<th>Class</th>
				<th>Launched</th>
			</tr>
		</thead>

		<tbody>
		@foreach ($products as $product)
			<tr>
				<td>{{ $product->style }}</td>
				<td>{{ $product->description }}</td>
				<td>{{ $product->brand }}</td>
				<td>{{ $product->warranty_years }}</td>
				<td>{{ $product->class }} - {{ $product->class_description }}</td>
				<td>{{ $product->launch_date }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
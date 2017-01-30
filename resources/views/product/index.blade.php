@extends('layouts.master')

@section('content')
	<div id="product-list">
		<div class="row">
			<div class="col-xs-12">
				<h1>All Products</h1>

				{{--Delete product alert--}}
				@if(Session::has('message'))
					<p class="alert alert-danger">
					{{ Session::get('message') }}
					</p>
				@endif

				{{--Create button--}}
				<a href="{{ URL::route('product.create') }}" class="btn btn-primary" role="button">Create New Product</a>
			</div>
		</div>

		<div class="row">
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
						<td>
							<a href="{{ route('product.edit', [
								'style' => $product->style
								]) }}" class="btn btn-success">Edit
							</a>
						</td>
						<td>
							<a href="{{ route('product.delete', [
								'style' => $product->style,
								'description' => $product->description
								]) }}" class="btn btn-danger">Delete
							</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
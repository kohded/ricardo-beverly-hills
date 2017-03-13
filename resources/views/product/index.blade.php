@extends('layouts.master')

@section('content')
	<div id="product-list">
		<div class="row">
			<div class="col-xs-12">
				<h1>All Products</h1>

				{{--Create button--}}
				<a href="{{ URL::route('product.create') }}" class="btn btn-primary" role="button">Create New Product</a>
			</div>
		</div>

		<hr>
		@include('product.filter-form')
		<hr>

		<div class="row">
			<div class="col-xs-12">
				{{--Delete product alert--}}
				@if(Session::has('message'))
					<p class="alert alert-danger">
						{{ Session::get('message') }}
					</p>
				@endif

				<div class="table-responsive">
					<table class="table table-hover table-condensed">
						<thead>
							<tr>
								<th>Style</th>
								<th>Description</th>
								<th>Brand</th>
								<th>Warranty</th>
								<th>Collection</th>
								<th>Launched</th>
								<th></th>
								<th></th>
							</tr>
						</thead>

						<tbody>
						@foreach ($products as $product)
							<tr>
								<td>{{ $product->style }}</td>
								<td>{{ $product->description }}</td>
								<td>{{ $product->brand }}</td>
								<td>{{ $product->warranty_years }}</td>
								<td>{{ $product->collection }}</td>
								<td>{{ $product->launch_date }}</td>
								<td class="table-data-wrap">
									<a href="{{ route('product.edit', [
										'style' => $product->style
										]) }}" class="btn btn-success btn-sm">Edit
									</a>
								</td>
								<td class="table-data-wrap">
									<a href="{{ route('product.delete', [
										'style' => $product->style,
										'description' => $product->description
										]) }}" class="btn btn-danger btn-sm">Delete
									</a>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 text-center">
				{{ $products->links() }}
			</div>
		</div>
	</div>
@endsection
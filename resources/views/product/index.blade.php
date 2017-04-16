@extends('layouts.master')

@section('content')
	<div id="product-list">
		<div class="row">
			<div class="col-xs-12">
				<h2>
					Products

					{{--Create button--}}
					<a href="{{ URL::route('product.create') }}" class="btn btn-primary pull-right" role="button">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						Create New Product
					</a>
				</h2>
				<hr>
			</div>
		</div>

		@include('product.filter-form')

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
								<th>
									<span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
									Style
								</th>
								<th>Description</th>
								<th>Brand</th>
								<th>Warranty</th>
								<th>Collection</th>
								<th>
									<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
									Launched</th>
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
									<a id="product-edit" href="{{ route('product.edit', ['style' => $product->style]) }}">
										<span class="glyphicon glyphicon-edit" aria-hidden="true" title="Edit Product"></span>
									</a>
								</td>
								<td class="table-data-wrap">
									<a  href=""
                                                id="deleteProductBtn"
                                                class="glyphicon glyphicon-remove text-danger" 
                                                aria-hidden="true" 
                                                data-style="{{ $product->style }}"
                                                data-toggle="modal"
                                                data-target="#deleteProductModal"
                                                title="Delete Product"></a>
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

	@include('product.delete-product-modal')
@endsection
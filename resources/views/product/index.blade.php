@extends('layouts.master')

@section('content')
	<div id="product-list">
		<div class="row">
			<div class="col-xs-12">
				<h2>
					<span class="fa fa-suitcase" aria-hidden="true"></span>
					Products

					{{--Create button--}}
					<a href="{{ URL::route('product.create') }}" class="btn btn-primary pull-right" role="button">
						<span class="fa fa-plus-circle" aria-hidden="true"></span>
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
									Brand
								</th>
								<th>
									Collection
								</th>
								<th>
									<span class="fa fa-suitcase" aria-hidden="true"></span>
									Style
								</th>
								<th>
									<span class="fa fa-pie-chart" aria-hidden="true"></span>
									Color
								</th>
								<th>
									<span class="fa fa-list" aria-hidden="true"></span>
									Description
								</th>
								<th>
									<span class="fa fa-file-text" aria-hidden="true"></span>
									Warranty
								</th>
								<th>
									<span class="fa fa-calendar-o" aria-hidden="true"></span>
									Launched</th>
								<th></th>
								<th></th>
							</tr>
						</thead>

						<tbody>
						@foreach ($products as $product)
							<tr>
								<td>{{ $product->brand }}</td>
								<td>{{ $product->collection }}</td>
								<td>{{ $product->style }}</td>
								<td>{{ $product->color }}</td>
								<td>{{ $product->description }}</td>
								<td>{{ $product->warranty_years }}</td>
								<td>{{ $product->launch_date }}</td>
								<td class="table-data-wrap">
									<a id="product-edit" href="{{ route('product.edit', ['style' => $product->style]) }}">
										<span class="fa fa-pencil-square-o" aria-hidden="true" title="Edit Product"></span>
									</a>
								</td>
								<td class="table-data-wrap">
									<a  href=""
                                                id="deleteProductBtn"
                                                class="fa fa-trash text-danger" 
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
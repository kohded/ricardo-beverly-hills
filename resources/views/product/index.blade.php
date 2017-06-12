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
									@if(session::get('filterTypeProduct') == 'brand' && session::get('filterOrder') == 'desc')
										<a href="{{ URL::route('product-filter-index', ['filterType' => 'brand', 'filterOrder' => 'asc' ]) }}">Brand</a>
									@else
										<a href="{{ URL::route('product-filter-index', ['filterType' => 'brand', 'filterOrder' => 'desc' ]) }}">Brand</a>
									@endif
								</th>
								<th>
									@if(session::get('filterTypeProduct') == 'collection' && session::get('filterOrder') == 'desc')
										<a href="{{ URL::route('product-filter-index', ['filterType' => 'collection', 'filterOrder' => 'asc' ]) }}">Collection</a>
									@else
										<a href="{{ URL::route('product-filter-index', ['filterType' => 'collection', 'filterOrder' => 'desc' ]) }}">Collection</a>
									@endif
								</th>
								<th>
									<span class="fa fa-suitcase" aria-hidden="true"></span>
									@if(session::get('filterTypeProduct') == 'style' && session::get('filterOrder') == 'desc')
										<a href="{{ URL::route('product-filter-index', ['filterType' => 'style', 'filterOrder' => 'asc' ]) }}">Style</a>
									@else
										<a href="{{ URL::route('product-filter-index', ['filterType' => 'style', 'filterOrder' => 'desc' ]) }}">Style</a>
									@endif
								</th>
								<th>
									<span class="fa fa-pie-chart" aria-hidden="true"></span>
									@if(session::get('filterTypeProduct') == 'color' && session::get('filterOrder') == 'desc')
										<a href="{{ URL::route('product-filter-index', ['filterType' => 'color', 'filterOrder' => 'asc' ]) }}">Color</a>
									@else
										<a href="{{ URL::route('product-filter-index', ['filterType' => 'color', 'filterOrder' => 'desc' ]) }}">Color</a>
									@endif
								</th>
								<th>
									<span class="fa fa-list" aria-hidden="true"></span>
									@if(session::get('filterTypeProduct') == 'description' && session::get('filterOrder') == 'desc')
										<a href="{{ URL::route('product-filter-index', ['filterType' => 'description', 'filterOrder' => 'asc' ]) }}">Description</a>
									@else
										<a href="{{ URL::route('product-filter-index', ['filterType' => 'description', 'filterOrder' => 'desc' ]) }}">Description</a>
									@endif
								</th>
								<th>
									@if(session::get('filterTypeProduct') == 'warranty_years' && session::get('filterOrder') == 'desc')
										<a href="{{ URL::route('product-filter-index', ['filterType' => 'warranty_years', 'filterOrder' => 'asc' ]) }}">Wnty</a>
									@else
										<a href="{{ URL::route('product-filter-index', ['filterType' => 'warranty_years', 'filterOrder' => 'desc' ]) }}">Wnty</a>
									@endif
								</th>
								<th>
									@if(session::get('filterTypeProduct') == 'guarantee_years' && session::get('filterOrder') == 'desc')
										<a href="{{ URL::route('product-filter-index', ['filterType' => 'warranty_years', 'filterOrder' => 'asc' ]) }}">Guar</a>
									@else
										<a href="{{ URL::route('product-filter-index', ['filterType' => 'warranty_years', 'filterOrder' => 'desc' ]) }}">Guar</a>
									@endif
								</th>
								<th>
									<span class="fa fa-calendar-o" aria-hidden="true"></span>
									@if(session::get('filterTypeProduct') == 'launch_date' && session::get('filterOrder') == 'desc')
										<a href="{{ URL::route('product-filter-index', ['filterType' => 'launch_date', 'filterOrder' => 'asc' ]) }}">Launched</a>
									@else
										<a href="{{ URL::route('product-filter-index', ['filterType' => 'launch_date', 'filterOrder' => 'desc' ]) }}">Launched</a>
									@endif
								</th>
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
								<td>{{ $product->guarantee_years }}</td>
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
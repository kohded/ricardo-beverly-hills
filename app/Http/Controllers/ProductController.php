<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $title = 'All Products';

        $products = DB::table('product')->get();

        return view('product.index', [
        	'title' => $title,
        	'products' => $products
        ]);
    }

    public function create()
    {
    	$title = 'Create Product';

    	return view('product.product-form', [
    		'title' => $title
    	]);
    }
}
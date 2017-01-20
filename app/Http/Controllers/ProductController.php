<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProductView()
    {
        $title = 'Product';

        return view('product', ['title' => $title]);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getCustomerView()
    {
        $title = 'Customer';

        return view('customer', ['title' => $title]);
    }
}

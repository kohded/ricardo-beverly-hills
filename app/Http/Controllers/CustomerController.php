<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;

class CustomerController extends Controller
{
    public function getCustomerView()
    {
        $customersModel = new CustomerModel();

        $title = 'Customers';

        $customers = $customersModel->getCustomerData();

        return view('customer.index', ['title' => $title, 'customers' => $customers]);
    }

    public function create()
    {
        $title = "Create New Customer";

        return view('customer.customer-form', ['title' => $title]);
    }
}

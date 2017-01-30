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

    public function getCreateView()
    {
        $title = "Create New Customer";

        return view('customer.customer-form', ['title' => $title]);
    }

    public function addCustomer(Request $request, \Illuminate\Validation\Factory $validator){
        $validation = $validator->make($request->all(), [
            'name' => 'required|min:5',
            'address1' => 'required|alpha_numeric',
            'address2' => 'nullable',
            'city' => 'required|alpha',
            'state' => 'required|max:2|min:2|alpha',
            'zip' => 'required|numeric',
            'phone' => 'required|numeric',
            'ext' => 'nullable|numeric',
            'email' => 'required|alpha_numeric|unique:customer',
            'comments' => 'nullable'
        ]);

        if($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

    }
}

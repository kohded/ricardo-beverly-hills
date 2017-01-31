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
            'name' => 'required|min:2|max:40',
            'address1' => 'required|max:60',
            'address2' => 'nullable|max:60',
            'city' => 'required|max:30|alpha',
            'state' => 'required|max:2|min:2|alpha',
            'zip' => 'required|numeric',
            'phone' => 'required|numeric',
            'ext' => 'nullable|max:99999|numeric',
            'email' => 'required|max:50|unique:customer',
            'comments' => 'nullable'
        ]);

        if($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        } else {

            $createCustomer = new CustomerModel();

            $createCustomer->insertCustomerData(
                $request->input('name'),
                $request->input('address1'),
                $request->input('address2'),
                $request->input('city'),
                strtoupper($request->input('state')),
                $request->input('zip'),
                $request->input('phone'),
                $request->input('ext'),
                $request->input('email'),
                $request->input('comments')
            );

            return redirect()->route('customer-create')
                ->with('message', 'Added new customer: ' . $request->input('name'));

        }




    }
}

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

    public function addCustomer(Request $request, \Illuminate\Validation\Factory $validator)
    {
        if ($this->dataIsNotValid($request, $validator)->fails()) {
            return redirect()->back()->withErrors($this->dataIsNotValid($request, $validator));
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

    public function getEditView($customerId)
    {
        $getCustomerDetail = new CustomerModel();

        $customerDetail = $getCustomerDetail->getCustomerDetailedData($customerId);

        return view('customer.edit-form', ['customerDetail' => $customerDetail]);

    }


    public function editCustomer(Request $request, \Illuminate\Validation\Factory $validator)
    {
        if ($this->dataIsNotValid($request, $validator)->fails()) {
            return redirect()->back()->withErrors($this->dataIsNotValid($request, $validator));
        } else {

            $editCustomer = new CustomerModel();

            $editCustomer->editCustomerData(
                $request->input('id'),
                $request->input('firstname'),
                $request->input('lastname'),
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


            return redirect()->route('more-customer-details', ['customerId' => 1]);
        }
    }

    public function getCustomerDetails($customerId){
        $getCustomerDetail = new CustomerModel();

        $customerDetail = $getCustomerDetail->getCustomerDetailedData($customerId);

        return view('customer.more-detail', ['customerDetail' => $customerDetail]);
    }

    private function dataIsNotValid($request, $validator){
        $validation = $validator->make($request->all(), [
            'firstname' => 'required|min:2|max:40',
            'lastname' => 'required|min:2|max:40',
            'address1' => 'required|max:60',
            'address2' => 'nullable|max:60',
            'city' => 'required|max:30|alpha',
            'state' => 'required|max:2|min:2|alpha',
            'zip' => 'required|numeric',
            'phone' => 'required|numeric',
            'ext' => 'nullable|max:99999|numeric',
            'email' => 'required|max:50',
            'comments' => 'nullable'
        ]);

        return $validation;
    }
}

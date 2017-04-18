<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;

class CustomerController extends Controller
{
    //If this commented code is still here delete it,
//    private $customerModel;
//
//    public function __construct()
//    {
//        $this->customerModel = new CustomerModel();
//    }


    public function getCustomerView(Request $request)
    {
        $customersModel = new CustomerModel();

        $customers = $customersModel->getCustomerData(20, $request);

        return view('customer.index', ['customers' => $customers]);
    }

    public function getCreateView()
    {
        return view('customer.customer-form');
    }

    public function addCustomer(Request $request, \Illuminate\Validation\Factory $validator)
    {
        if ($this->inputValidation($request, $validator)->fails()) {
            return redirect()->back()->withErrors($this->inputValidation($request, $validator));
        } else {
                $createCustomer = new CustomerModel();

                $createCustomer->insertCustomerData(
                    $request->input('firstname'),
                    $request->input('lastname'),
                    $request->input('address1'),
                    $request->input('address2'),
                    $request->input('city'),
                    strtoupper($request->input('state')),
                    $request->input('zip'),
                    $request->input('phone'),
                    $request->input('email')
                );

                return redirect()->route('customer-create')
                    ->with('message', $request->input('firstname') . ' ' . $request->input('lastname') . ' added.');

            }

    }

    public function getEditView($customerId)
    {
        $getCustomerDetail = new CustomerModel();

        $customerDetail = $getCustomerDetail->getCustomerDetailedData($customerId);

        return view('customer.edit-form', ['customerDetails' => $customerDetail]);

    }


    public function editCustomer(Request $request, \Illuminate\Validation\Factory $validator )
    {
        if ($this->inputValidation($request, $validator)->fails()) {
            return redirect()->back()->withErrors($this->inputValidation($request, $validator));
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
                $request->input('email'),
                $request->input('comments')
            );

            return redirect()->route('customer-get-edit', ['id' => $request->input('id')])
                ->with('message', $request->input('firstname') . ' ' . $request->input('lastname') . ' edited.');
        }
    }

    public function getCustomerDetails($customerId){
        $getCustomerDetail = new CustomerModel();

        $customerDetail = $getCustomerDetail->getCustomerDetailedData($customerId)['customer'];
        $customerClaims = $getCustomerDetail->getCustomerDetailedData($customerId)['claim-customer'];
        return view('customer.more-detail', [
            'customerDetail' => $customerDetail, 
            'customerClaims' => $customerClaims
        ]);
    }

    public function deleteCustomer(Request $request){
        $customerId = $request->customer_id;
        $customerName = $request->customer_name;

        $deleteCustomer = new CustomerModel();
        $deleteCustomer->deleteCustomer($customerId);

        return redirect()->route('customer')
            ->with('message', 'Customer ' . $customerName . ' with ID ' . $customerId . ' deleted.');
    }

    private function inputValidation($request, $validator){
        $validation = $validator->make($request->all(), [
            'firstname' => 'required|min:2|max:40',
            'lastname' => 'required|min:2|max:40',
            'address1' => 'required|max:60',
            'address2' => 'nullable|max:60',
            'city' => 'required|max:30',
            'state' => 'required|max:2|min:2|alpha',
            'zip' => 'required|numeric',
            'phone' => 'required|numeric',
            'email' => 'required|email|max:50',
            'comments' => 'nullable'
        ]);

        return $validation;
    }
}

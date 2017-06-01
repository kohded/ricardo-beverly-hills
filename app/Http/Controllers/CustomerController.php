<?php namespace App\Http\Controllers;
/*
Ricardo Beverly Hills - Parts, Repair, & Warranty Management System
@author Arnold Koh <arnold@kohded.com>
@author Chris Knoll <cknoll3@gmail.com>
@author Peter Kim <peterlk.dev@gmail.com>
@version 1.0, developed 1/17/17
@url http://rbh.greenrivertech.net
CustomerController.php - Controller for Customer related pages
*/

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Exceptions\IdDoesntExistException;

class CustomerController extends Controller {
    // List of customers view
    public function getCustomerIndex(Request $request)
    {
        $customersModel = new CustomerModel();

        $customers = $customersModel->getCustomerData(20, $request);

        return view('customer.index', ['customers' => $customers]);
    }

    // Filter for sorting list of customers
    public function setFilter($filterType, $filterOrder, Request $request)
    {

        $request->session()->flash('filterTypeCustomer', $filterType);
        $request->session()->flash('filterOrder', $filterOrder);

        return $this->getCustomerIndex($request);
    }

    // New customer form
    public function getCreateView()
    {
        return view('customer.customer-form');
    }

    // Add new customer after form is submitted
    public function addCustomer(Request $request)
    {
        // Strip everything but numbers
        $request['phone'] = preg_replace("/[^0-9]/","", $request->input('phone'));
        $request['zip'] = preg_replace("/[^0-9]/","", $request->input('zip'));

        $this->validate($request, $this->getValidationRules());

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

        return redirect()->route('customer')
            ->with('message', $request->input('firstname') . ' ' . $request->input('lastname') . ' added.');
    }

    // Edit customer view
    public function getEditView($customerId)
    {
        $getCustomerDetail = new CustomerModel();

        $customerDetail = $getCustomerDetail->getCustomerDetailedData($customerId);

        if(count($customerDetail['customer']) > 0) {
            return view('customer.edit-form', ['customerDetails' => $customerDetail]);
        } else {
            throw new IdDoesntExistException($customerId, 'Customer');
        }
    }

    // Edit customer after form is submitted
    public function editCustomer(Request $request)
    {
        // Strip everything but numbers
        $request['phone'] = preg_replace("/[^0-9]/","", $request->input('phone'));
        $request['zip'] = preg_replace("/[^0-9]/","", $request->input('zip'));

        $this->validate($request, [
            'firstname' => 'required|min:2|max:40',
            'lastname' => 'required|min:2|max:40',
            'address1' => 'required|max:60',
            'address2' => 'nullable|max:60',
            'city' => 'required|max:30',
            'state' => 'required|size:2|alpha',
            'zip' => 'required|size:5',
            'phone' => 'required|size:10',
            'email' => 'required|email|max:50',
            'comments' => 'nullable'
        ]);

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

    // More-details page for customer
    public function getCustomerDetails($customerId)
    {
        $getCustomerDetail = new CustomerModel();

        $customerDetail = $getCustomerDetail->getCustomerDetailedData($customerId)['customer'];
        $customerClaims = $getCustomerDetail->getCustomerDetailedData($customerId)['claim-customer'];

        if(count($customerDetail) > 0) {

        return view('customer.more-detail', [
            'id' => $customerId,
            'customerDetail' => $customerDetail, 
            'customerClaims' => $customerClaims
        ]);
        } else {
         throw new IdDoesntExistException($customerId, 'Customer');
        }
    }

    // Delete a customer
    public function deleteCustomer(Request $request)
    {
        $customerId = $request->customer_id;
        $customerName = $request->customer_name;

        $deleteCustomer = new CustomerModel();
        $deleteCustomer->deleteCustomer($customerId);

        return redirect()->route('customer')
            ->with('message', 'Customer ' . $customerName . ' with ID ' . $customerId . ' deleted.');
    }

    // Validation rules for adding or editing a customer
    private function getValidationRules()
    {
        return [
            'firstname' => 'required|min:2|max:40',
            'lastname' => 'required|min:2|max:40',
            'address1' => 'required|max:60',
            'address2' => 'nullable|max:60',
            'city' => 'required|max:30',
            'state' => 'required|size:2|alpha',
            'zip' => 'required|size:5',
            'phone' => 'required|size:10',
            'email' => 'required|email|max:50|unique:customer,email',
            'comments' => 'nullable'
        ];
    }
}

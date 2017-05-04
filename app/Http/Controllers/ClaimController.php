<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Mail\MailClaimController;
use App\Models\DamageCodeModel;
use DB;
use PDF;
use Illuminate\Http\Request;
use App\Models\ClaimModel;
use App\Models\ProductModel;
use App\Models\RepairCenterModel;
use App\Models\CustomerModel;

class ClaimController extends Controller
{
    public function getClaimIndex(Request $request)
    {
        $claimModel = new ClaimModel();
        $claims = $claimModel->getClaims(20, $request, "ricardo");

        $rcModel = new RepairCenterModel();
        $repair_centers = $rcModel->getRepairCenters(null, $request);

        $productModel = new ProductModel;
        $products = $productModel->getProducts(null, $request);

        return view('claim.index', [
            'claims' => $claims,
            'products' => $products,
            'repair_centers' => $repair_centers
        ]);
    }

    public function getCreateView(Request $request)
    {
        return view('claim.claim-form');
    }

    public function getClaimDetails($id)
    {
        $claimModel = new ClaimModel();
        $claim = $claimModel->getClaim($id);
        $comments = $claimModel->getComments($id);


        return view('claim.claim', [
            'claim' => $claim,
            'comments' => $comments
        ]);
    }

    public function addClaim(Request $request)
    {
        // Strip everything but numbers
        $request['phone'] = preg_replace("/[^0-9]/","", $request->input('phone'));
        $request['zip'] = preg_replace("/[^0-9]/","", $request->input('zip'));

        // Validate based on whether it's an existing or new customer
        if ($request->input('edit_type_switch') === "1")
        {
            $this->validate($request, $this->getExistingCustomerValidationRules());
        }
        else
        {
            $this->validate($request, $this->getNewCustomerValidationRules());
        }

        //Associative Array of All customer Data from form.
        $customerData = array(
            'first_name' => $request->input('firstname'),
            'last_name' => $request->input('lastname'),
            'address' => $request->input('address1'),
            'address_2' => $request->input('address2'),
            'city' => $request->input('city'),
            'state' => strtoupper($request->input('state')),
            'zip' => $request->input('zip'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email')
        );

        $claimModel = new ClaimModel();
        $claimModel->insertClaim(
            $request->input('existing_customer_email'),
            $customerData,
            $request->input('comment'),
            $request->input('product-style'),
            $request->input('damage-code-id'),
            $request->input('repair-center-id'),
            $request->input('replace_order'),
            $request->input('ship_to'),
            $request->input('part_needed'),
            $request->input('parts_needed'),
            $request->input('edit_type_switch')
        );

        $claimId = $claimModel->getMostRecentClaimId();

        // Mail claim
        $request->request->add(['claim-id' => $claimId]);
        (new MailClaimController($request))->sendNewWarrantyClaimMail();

        return redirect()->route('claim', ['id' => $claimId]);
    }

    public function addComment(Request $request)
    {
        $claimModel = new ClaimModel();
        $claimModel->insertComment(
            $request->input('claim_id'),
            $request->input('comment')
        );

        return redirect()->route('claim', ['id' => $request->input('claim_id')])
            ->with('message', 'Comment successfully added to claim.');
    }

    public function convertToReplaceOrder(Request $request) {
        $claimId = $request->input('claim_id');
        $claimModel = new ClaimModel();
        $claimModel->convertToReplaceOrder($claimId);

        // Mail claim
        $request->request->add(['claim-id' => $claimId]);
        (new MailClaimController($request))->sendConvertToReplaceOrderMail();

        return redirect()->route('claim', ['id' => $claimId])
            ->with('message', 'Claim successfully converted to a Replace Order.');
    }

    public function enterTrackingNumber(Request $request) {
        $claimId = $request->input('claim_id');
        $partsAvailable = $request->input('parts_available');
        $trackingNumber = $request->input('tracking_number');

        $claimModel = new ClaimModel();
        $claimModel->enterTrackingNumber($claimId, $trackingNumber);

        // Send replace order tracking number mail.
        $request->request->add(['claim-id' => $claimId]);
        (new MailClaimController($request))->sendReplaceOrderTrackingNumberMail();

        return redirect()->route('claim', ['id' => $claimId])
            ->with('message', 'Added tracking number to claim.');            
    }

    public function closeClaim($id) {
        $claimModel = new ClaimModel();
        $claimModel->closeClaim($id);
        
        return redirect()->route('claim', ['id' => $id])
            ->with('message', 'Successfully closed claim!');
    }

    public function deleteClaim(Request $request)
    {
        $claimId = $request->input('claim_id');

        $claimModel = new ClaimModel();
        $claimModel->deleteClaim($claimId);

        return redirect()->route('claim-index')
            ->with('message', 'Deleted claim ' . $claimId . '.');
    }

    public function editClaim($id, Request $request)
    {
        $rcModel = new RepairCenterModel();
        $repair_centers = $rcModel->getRepairCenters(null, $request);

        $claimDetails = new ClaimModel();
        $claimDetails = $claimDetails->getClaim($id);

        $customerDetails = new CustomerModel();
        $customerDetails = $customerDetails->getCustomerDetailedData($claimDetails[0]->cust_id);

        $productModel = new ProductModel;
        $product = $productModel->getProduct($claimDetails[0]->product_style);

        return view('claim.claim-edit', [
            'claimDetails' => $claimDetails[0],
            'customerDetails' => $customerDetails,
            'repair_centers' => $repair_centers,
            'product' => $product[0]
        ]);
    }

    public function updateClaim(Request $request) 
    {
        $this->validate($request, $this->getExistingCustomerValidationRules());

        //Data from form
        $claimId = $request->input('claim_id');
        $existingCustomerEmail = $request->input('existing_customer_email');
        $product = $request->input('product-style');
        $repairCenter = $request->input('repair-center-id');
        $damageCode = $request->input('damage-code-id');
        $claimType = $request->input('replace_order');
        $partsRequired = $request->input('part_needed');
        $partsNeeded = $request->input('parts_needed');
        $shipPartsTo = $request->input('ship_to');

        // Get the customer id using their email
        $customerModel = new CustomerModel();
        $customerId = $customerModel->getCustomerIdByEmail($existingCustomerEmail);

        $claimModel = new ClaimModel();
        $claimModel->updateClaim($claimId, $customerId->id, $product, $repairCenter, 
                                 $damageCode, $claimType, $partsRequired, $partsNeeded, 
                                 $shipPartsTo);

        return redirect()->route('claim', ['id' => $claimId])
            ->with('message', 'Successfully edited claim.');
    }

    // Display PDF version of claim if clicked on in claim details
    public function displayClaimPDF($id) {
        $claimModel = new ClaimModel();
        $claim = $claimModel->getClaim($id);
        $comments = $claimModel->getComments($id);

        if($claim[0]->replace_order == 1) {
        return PDF::loadView('pdf.replace-order', ['claim' => $claim, 'comments' => $comments])
            ->inline('replace-order-' . $id . '.pdf');
        } else {
            return PDF::loadView('pdf.repair-order', ['claim' => $claim, 'comments' => $comments])
                ->inline('repair-order-' . $id . '.pdf');            
        }
    }

    public function setFilter($filterType, $filterOrder, Request $request){

        $request->session()->flash('filterTypeClaims', $filterType);
        $request->session()->flash('filterOrder', $filterOrder);

        return $this->getClaimIndex($request);
    }

    private function getExistingCustomerValidationRules() {
        return [
            'existing_customer_email' => 'required|max:50|exists:customer,email',
            'comments' => 'nullable',
            'products' => 'required',
            'damage_code' => 'required',
            'repair_center' => 'required',
            'replace_order' => 'required',
            'part_needed' => 'required_if:replace_order,0',
            'parts_needed' => 'required_if:part_needed,1',
            'ship_to' => 'required_if:part_needed,1'
        ];
    }

    private function getNewCustomerValidationRules() {
        return [
            'firstname' => 'required|min:2|max:40',
            'lastname' => 'required|min:2|max:40',
            'address1' => 'required|max:60',
            'address2' => 'nullable|max:60',
            'city' => 'required|max:30|alpha',
            'state' => 'required|size:2|alpha',
            'zip' => 'required|size:5',
            'phone' => 'required|size:10',
            'email' => 'required|max:50|unique:customer,email',
            'comments' => 'nullable',
            'products' => 'required',
            'damage_code' => 'required',
            'repair_center' => 'required',
            'replace_order' => 'required',
            'part_needed' => 'required_if:replace_order,0',
            'parts_needed' => 'required_if:part_needed,1',
            'ship_to' => 'required_if:part_needed,1'
        ];
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Mail\MailClaimController;
use DB;
use Illuminate\Http\Request;
use App\Models\ClaimModel;
use App\Models\ProductModel;
use App\Models\RepairCenterModel;
use App\Models\CustomerModel;

class ClaimController extends Controller
{
    public function getClaimIndex(Request $request, $role)
    {
        $claimModel = new ClaimModel();
        if ($role == 'ricardo') {
            $claims = $claimModel->getClaims(20, $request, "ricardo");
        } else if ($role == 'partCompany') {
            $claims = $claimModel->getClaims(20, $request, "partCompany");
        }

        $rcModel = new RepairCenterModel();
        $repair_centers = $rcModel->getRepairCenters();

        $productModel = new ProductModel;
        $products = $productModel->getProducts();

        return view('claim.index', [
            'claims' => $claims,
            'products' => $products,
            'repair_centers' => $repair_centers
        ]);
    }

    public function getRicardoIndex(Request $request)
    {
        return $this->getClaimIndex($request, 'ricardo');
    }

    public function getPartCompanyIndex(Request $request)
    {
        return $this->getClaimIndex($request, 'partCompany');
    }

    public function getCreateView()
    {
        $damage_codes = DB::table('damage_code')->get();

        $rcModel = new RepairCenterModel();
        $repair_centers = $rcModel->getRepairCenters();

        foreach ($repair_centers as $repair_center)
        {
            $street = substr($repair_center->address, strpos($repair_center->address, " "), 10);
            $repair_center->streetName = $street;
        }

        $productModel = new ProductModel;
        $products = $productModel->getProducts();

        return view('claim.claim-form', [
            'damage_codes' => $damage_codes,
            'repair_centers' => $repair_centers,
            'products' => $products
        ]);
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

    public function addClaim(Request $request, \Illuminate\Validation\Factory $validator)
    {

        if ($this->inputValidation($request, $validator)->fails()) {
            return redirect()->back()->withErrors($this->inputValidation($request, $validator));
        } else {

            $claimModel = new ClaimModel();

            $claimModel->insertClaim(
                $request->input('existingcustomeremail'),
                $request->input('firstname'),
                $request->input('lastname'),
                $request->input('address1'),
                $request->input('address2'),
                $request->input('city'),
                strtoupper($request->input('state')),
                $request->input('zip'),
                $request->input('phone'),
                $request->input('email'),
                $request->input('comment'),
                $request->input('products'),
                $request->input('damagecode'),
                $request->input('repaircenter'),
                $request->input('replace_order'),
                $request->input('ship_to'),
                $request->input('part_needed'),
                $request->input('parts_needed')
            );

            $claimId = $claimModel->getMostRecentClaimId();

            // Mail claim
            $request->request->add(['claim-id' => $claimId]);
            (new MailClaimController($request))->sendNewWarrantyClaimMail();

            return redirect()->route('claim', ['id' => $claimId]);
        }
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

    public function enterPartAvailability(Request $request) {
        $claimId = $request->input('claim_id');
        $partsAvailable = $request->input('parts_available');
        $partCompanyComment = $request->input('part_company_comment');

        $claimModel = new ClaimModel();
        $claimModel->enterPartAvailability($claimId, $partsAvailable, $partCompanyComment);

        // Mail claim

        return redirect()->route('claim', ['id' => $claimId])
            ->with('message', 'Added part availability information to claim.');        
    }

    public function deleteClaim($id)
    {

        $claimModel = new ClaimModel();
        $claimModel->deleteClaim($id);

        return redirect('claim');
    }

    public function editClaim($id)
    {
        $damage_codes = DB::table('damage_code')->get();

        $rcModel = new RepairCenterModel();
        $repair_centers = $rcModel->getRepairCenters();

        $productModel = new ProductModel;
        $products = $productModel->getProducts();

        $claimDetails = new ClaimModel();
        $claimDetails = $claimDetails->getClaim($id);

        $customerDetails = new CustomerModel();
        $customerDetails = $customerDetails->getCustomerDetailedData($claimDetails[0]->cust_id);

        return view('claim.claim-edit', [
            'claimDetails' => $claimDetails[0],
            'customerDetails' => $customerDetails,
            'damage_codes' => $damage_codes,
            'repair_centers' => $repair_centers,
            'products' => $products
        ]);
    }

    public function updateClaim(Request $request, \Illuminate\Validation\Factory $validator) {

    }

    private function inputValidation($request, $validator)
    {

        if ($request->input('existingcustomeremail') != '') {

            $validation = $validator->make($request->all(), [
                'existingcustomeremail' => 'required|max:50',
                'comments' => 'nullable',
                'products' => 'required',
                'repaircenter' => 'required',
                'replace_order' => 'required',
                'firstname' => 'max:0',
                'lastname' => 'max:0',
                'address1' => 'max:0',
                'address2' => 'max:0',
                'city' => 'max:0',
                'state' => 'max:0',
                'zip' => 'max:0',
                'phone' => 'max:0',
                'email' => 'max:0'
            ]);

        } else {

            $validation = $validator->make($request->all(), [
                'firstname' => 'required|min:2|max:40',
                'lastname' => 'required|min:2|max:40',
                'address1' => 'required|max:60',
                'address2' => 'nullable|max:60',
                'city' => 'required|max:30|alpha',
                'state' => 'required|max:2|min:2|alpha',
                'zip' => 'required|numeric',
                'phone' => 'required|numeric',
                'email' => 'required|max:50',
                'comments' => 'nullable',
                'products' => 'required',
                'repaircenter' => 'required',
                'replace_order' => 'required'
            ]);
        }

        return $validation;
    }
}
<?php

namespace App\Http\Controllers\Role\PartCompany;

use App\Http\Controllers\Mail\MailClaimController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClaimModel;
use App\Models\RepairCenterModel;
use App\Models\ProductModel;



class PartCompanyController extends Controller
{
    /**
     * Get list view populated with claims for this part company.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListView(Request $request)
    {
    	$claimModel = new ClaimModel();
        $claims = $claimModel->getClaims(20, $request, "partCompany");
        $rcModel = new RepairCenterModel();
        $repair_centers = $rcModel->getRepairCenters();

        $productModel = new ProductModel;
        $products = $productModel->getProducts();

        return view('role.part-company.list', [
            'claims' => $claims,
            'products' => $products,
            'repair_centers' => $repair_centers
        ]);
    }

    public function getClaimDetails($id)
    {
        $claimModel = new ClaimModel();
        $claim = $claimModel->getClaim($id);
        $comments = $claimModel->getComments($id);


        return view('role.part-company.claim-detail', [
            'claim' => $claim,
            'comments' => $comments
        ]);
    }

    public function enterPartAvailability(Request $request) {
        $claimId = $request->input('claim_id');
        $partsAvailable = $request->input('parts_available');
        $partCompanyComment = $request->input('part_company_comment');

        $claimModel = new ClaimModel();
        $claimModel->enterPartAvailability($claimId, $partsAvailable, $partCompanyComment);

        if($partsAvailable === '0') {
            // Send no part mail.
            $request->request->add(['claim-id' => $claimId]);
            (new MailClaimController($request))->sendNoPartMail();
        }

        return redirect()->route('pc-claim-details', ['id' => $claimId])
            ->with('message', 'Added part availability information to claim.');        
    }

    public function enterTrackingNumber(Request $request) {
        $claimId = $request->input('claim_id');
        $partsAvailable = $request->input('parts_available');
        $trackingNumber = $request->input('tracking_number');

        $claimModel = new ClaimModel();
        $claimModel->enterTrackingNumber($claimId, $trackingNumber);

        // Send part order tracking number mail.
        $request->request->add(['claim-id' => $claimId]);
        (new MailClaimController($request))->sendPartOrderTrackingNumberMail();

        return redirect()->route('pc-claim-details', ['id' => $claimId])
            ->with('message', 'Added tracking number to claim.');            
    }
}

<?php namespace App\Http\Controllers\Role\PartCompany;

use App\Http\Controllers\Mail\MailClaimController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClaimModel;
use App\Models\RepairCenterModel;
use App\Models\ProductModel;
use PDF;

class PartCompanyController extends Controller {
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
        $repair_centers = $rcModel->getRepairCenters(null, $request);

        $productModel = new ProductModel;
        $products = $productModel->getProducts(null, $request);

        return view('role.part-company.list', [
            'claims' => $claims,
            'products' => $products,
            'repair_centers' => $repair_centers
        ]);
    }

    // Filter for list sorting
    public function setFilter($filterType, $filterOrder, Request $request)
    {

        $request->session()->flash('filterTypeClaims', $filterType);
        $request->session()->flash('filterOrder', $filterOrder);

        return $this->getListView($request);
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

        if($partsAvailable === '0') 
        {
            // Send no part mail.
            $request->request->add(['claim-id' => $claimId]);
            (new MailClaimController($request))->sendNoPartMail();
        }

        return redirect()->route('pc-claim-details', ['id' => $claimId])
            ->with('message', 'Added part availability information to claim.');        
    }

    public function enterTrackingNumber(Request $request) 
    {
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

    public function addComment(Request $request)
    {
        $claimModel = new ClaimModel();
        $claimModel->insertComment(
            $request->input('claim_id'),
            $request->input('comment')
        );

        return redirect()->route('pc-claim-details', ['id' => $request->input('claim_id')])
            ->with('message', 'Comment successfully added to claim.');
    }

    // Display PDF version of claim if clicked on in claim details
    public function displayPackingSlipPDF($id) 
    {
        $claimModel = new ClaimModel();
        $claim = $claimModel->getClaim($id);

        return PDF::loadView('pdf.packing-slip', ['claim' => $claim])
            ->inline('packing-slip-' . $id . '.pdf');            
    }

    // Display PDF version of claim if clicked on in claim details
    public function displayClaimPDF($id) 
    {
        $claimModel = new ClaimModel();
        $claim = $claimModel->getClaim($id);
        $comments = $claimModel->getComments($id);

        if($claim[0]->replace_order == 1) 
        {
            return PDF::loadView('pdf.replace-order', ['claim' => $claim, 'comments' => $comments])
                ->inline('replace-order-' . $id . '.pdf');
        } 
        else 
        {
            return PDF::loadView('pdf.repair-order', ['claim' => $claim, 'comments' => $comments])
                ->inline('repair-order-' . $id . '.pdf');            
        }
    }
}

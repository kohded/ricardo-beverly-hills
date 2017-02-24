<?php

namespace App\Http\Controllers\Role\RepairCenter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClaimModel;
use App\Models\Role\RepairCenter\RepairCenterModel;
use Auth;

class RepairCenterController extends Controller
{
    /**
     * Get list view populated with claims for this repair center.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListView()
    {
        $id = Auth::user()->id;

        $claims = new RepairCenterModel();
        $claims = $claims->getClaims($id);

        return view('role.repair-center.list', [
            'claims' => $claims,
        ]);
    }

    /**
     * Get more details about claim by id.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMoreDetailsView($id)
    {
        $claimModel = new ClaimModel();
        $claim = $claimModel->getClaim($id);
        $comments = $claimModel->getComments($id);

        return view('role.repair-center.more-details', [
            'claim'    => $claim,
            'comments' => $comments
        ]);
    }

    public function addComment(Request $request)
    {
        $comment = new ClaimModel();
        $comment->insertComment(
            $request->input('claim_id'),
            $request->input('comment')
        );

        return redirect()->route('repair-center-claim.more-details', [
            'id' => $request->input('claim_id')
        ])->with('message', 'Comment successfully added to claim.');
    }
}

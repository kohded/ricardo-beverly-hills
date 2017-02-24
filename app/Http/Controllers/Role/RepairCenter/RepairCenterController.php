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
}

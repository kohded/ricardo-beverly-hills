<?php

namespace App\Http\Controllers\Autocomplete;

use App\Http\Controllers\Controller;
use App\Models\Autocomplete\AutocompleteModel;
use App\Models\ClaimModel;

class AutocompleteController extends Controller
{
    /**
     * Return results of matching customer email.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function getCustomerEmail(\Illuminate\Http\Request $request)
    {
        $email = new AutocompleteModel();

        return $email->getCustomerEmail($request->input('email'));
    }

    /**
     * Return results of matching damage code.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function getDamageCode(\Illuminate\Http\Request $request)
    {
        $damageCode = new AutocompleteModel();

        return $damageCode->getDamageCode($request->input('dc'));
    }

    /**
     * Return results of matching product.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function getProduct(\Illuminate\Http\Request $request)
    {
        $product = new AutocompleteModel();

        return $product->getProduct($request->input('product'));
    }

    /**
     * Return results of matching repair center.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function getRepairCenter(\Illuminate\Http\Request $request)
    {
        $repairCenter = new AutocompleteModel();

        return $repairCenter->getRepairCenter($request->input('rc'));
    }

    /**
     * Return customer latest claim id.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function getCustomerLatestClaimId(\Illuminate\Http\Request $request)
    {
        $claimIdModel = new ClaimModel();
        $claimId = $claimIdModel->getLatestClaimIdByEmail($request->input('email'));

        return $claimId->id;
    }
}

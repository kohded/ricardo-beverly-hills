<?php

namespace App\Http\Controllers\Autocomplete;

use App\Models\Autocomplete\AutocompleteModel;
use App\Http\Controllers\Controller;

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
}

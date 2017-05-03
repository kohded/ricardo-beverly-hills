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
}

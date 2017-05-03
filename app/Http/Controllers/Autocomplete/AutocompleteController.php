<?php

namespace App\Http\Controllers\Autocomplete;

use App\Models\Autocomplete\AutocompleteModel;
use App\Http\Controllers\Controller;

class AutocompleteController extends Controller
{
    public function getCustomerEmail(\Illuminate\Http\Request $request)
    {
        $customer = new AutocompleteModel();

        return $customer->getCustomerEmail($request->input('email'));
    }
}

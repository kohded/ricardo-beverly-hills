<?php

namespace App\Http\Controllers\Role\PartCompany;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartCompanyController extends Controller
{
    /**
     * Get list view populated with claims for this part company.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListView()
    {
        return view('role.part-company.list');
    }
}

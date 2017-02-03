<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index()
    {
        $title = 'All Claims';

        $claims = DB::table('claim')
            ->join('customer', 'claim.customer_id', '=', 'customer.id')
            ->join('repair_center', 'claim.repair_center_id', '=', 'repair_center.id')
            ->get();

        return view('claim.index', [
        	'title' => $title,
        	'claims' => $claims
        ]);
    }

    public function create()
    {
    	$title = 'Create Claim';

        $damage_codes = DB::table('damage_code')->get();
        $repair_centers = DB::table('repair_center')->get();
        $products = DB::table('product')->orderBy('style', 'asc')->get();

    	return view('claim.claim-form', [
    		'title'          => $title,
            'damage_codes'   => $damage_codes,
            'repair_centers' => $repair_centers,
            'products'       => $products
    	]);
    }
}
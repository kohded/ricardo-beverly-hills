<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\ClaimModel;

class ClaimController extends Controller
{
    public function index()
    {
        $title = 'All Claims';

        $claims = new ClaimModel();
        $claims = $claims->getClaims();        

        return view('claim.index', [
        	'title' => $title,
        	'claims' => $claims
        ]);
    }

    public function create()
    {
    	$title = 'Create Claim';

        $damage_codes = DB::table('damage_code')->get();
        $repair_centers = DB::table('repair_center')->orderBy('name', 'asc')->get();
        $products = DB::table('product')->orderBy('style', 'asc')->get();

    	return view('claim.claim-form', [
    		'title'          => $title,
            'damage_codes'   => $damage_codes,
            'repair_centers' => $repair_centers,
            'products'       => $products
    	]);
    }
}
<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index()
    {
        $title = 'All Claim';

        $claims = DB::table('claim')->get();

        return view('claim.index', [
        	'title' => $title,
        	'claims' => $claims
        ]);
    }

    public function create()
    {
    	$title = 'Create Claim';

    	return view('claim.claim-form', [
    		'title' => $title
    	]);
    }
}
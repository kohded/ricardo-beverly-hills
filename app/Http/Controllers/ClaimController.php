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

    public function claim($id)
    {
        $claimModel = new ClaimModel();
        $claim = $claimModel->getClaim($id);
        $comments = $claimModel->getComments($id);


        return view('claim.claim', [
            'claim' => $claim,
            'comments' => $comments
        ]);
    }

    public function addClaim(Request $request, \Illuminate\Validation\Factory $validator){

        if ($this->inputValidation($request, $validator)->fails()) {
            return redirect()->back()->withErrors($this->inputValidation($request, $validator));
        } else {

            $claimModel = new ClaimModel();

            $claimModel->insertClaim(
                $request->input('firstname'),
                $request->input('lastname'),
                $request->input('address1'),
                $request->input('address2'),
                $request->input('city'),
                strtoupper($request->input('state')),
                $request->input('zip'),
                $request->input('phone'),
                $request->input('email'),
                $request->input('comment'),
                $request->input('products'),
                $request->input('damagecode'),
                $request->input('repaircenter'),
                $request->input('replaced')
            );

            return redirect()->route('claim', ['id' => $claimModel->getMostRecentClaimId()]);
    }

    }

    private function inputValidation($request, $validator){
        $validation = $validator->make($request->all(), [
            'firstname' => 'required|min:2|max:40',
            'lastname' => 'required|min:2|max:40',
            'address1' => 'required|max:60',
            'address2' => 'nullable|max:60',
            'city' => 'required|max:30|alpha',
            'state' => 'required|max:2|min:2|alpha',
            'zip' => 'required|numeric',
            'phone' => 'required|numeric',
            'email' => 'required|max:50',
            'comments' => 'nullable',
            'products' => 'required',
            'repaircenter' => 'required',
            'replaced' => 'required'
        ]);

        return $validation;
    }
}
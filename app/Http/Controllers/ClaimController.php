<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function getClaimView()
    {
        $title = 'Claim';

        return view('claim', ['title' => $title]);
    }
}
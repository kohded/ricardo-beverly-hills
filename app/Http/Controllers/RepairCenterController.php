<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepairCenterController extends Controller
{
    public function getRepairCenterView()
    {
        $title = 'Repair Center';

        return view('repair-center', ['title' => $title]);
    }
}
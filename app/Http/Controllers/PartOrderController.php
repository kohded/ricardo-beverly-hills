<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartOrderController extends Controller
{
    public function getPartOrderView()
    {
        $title = 'Part Order';

        return view('part-order', ['title' => $title]);
    }
}
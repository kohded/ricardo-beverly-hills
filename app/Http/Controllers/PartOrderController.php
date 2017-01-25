<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class PartOrderController extends Controller
{
    public function index()
    {
        $title = 'All Part Orders';

        $part_orders = DB::table('part_order')->get();

        return view('part-order.index', [
        	'title' => $title,
        	'part_orders' => $part_orders
        ]);
    }

    public function create()
    {
    	$title = 'Create Part Order';

    	return view('part-order.part-order-form', [
    		'title' => $title
    	]);
    }
}
<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class ClaimModel
{
	// Select all products
	public function getClaims()
	{
		$claims = DB::table('claim')
            ->join('customer', 'claim.customer_id', '=', 'customer.id')
            ->join('repair_center', 'claim.repair_center_id', '=', 'repair_center.id')
            ->select('claim.id as claim_id', 
                    'customer.first_name as first', 
                    'customer.last_name as last', 
                    'claim.product_style as style', 
                    'repair_center.name as repair_center', 
                    'claim.created_at as created_at', 
                    'claim.date_closed as closed_at')
            ->paginate(20);

		return $claims;
	}
}
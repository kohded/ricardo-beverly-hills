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

    // Select claim by ID
    public function getClaim($id)
    {
        //$claim = DB::table('claim')->where('id', '=', $id)->get();
        $claim = DB::table('claim')
            ->join('customer', 'claim.customer_id', '=', 'customer.id')
            ->join('repair_center', 'claim.repair_center_id', '=', 'repair_center.id')
            ->join('damage_code', 'claim.damage_code_id', '=', 'damage_code.id')
            ->join('product', 'claim.product_style', '=', 'product.style')
            ->select(
                'claim.id as claim_id',
                'claim.created_at as claim_created_at',
                'claim.date_closed as claim_date_closed',
                'customer.address as cust_address',
                'customer.address_2 as cust_address_2',
                'customer.city as cust_city',
                'customer.email as cust_email',
                'customer.first_name as cust_first_name',
                'customer.last_name as cust_last_name',
                'customer.phone as cust_phone',
                'customer.state as cust_state',
                'customer.zip as cust_zip',
                'product.style as product_style',
                'repair_center.id as rc_id',
                'repair_center.name as rc_name',
                'repair_center.city as rc_city',
                'repair_center.state as rc_state',
                'repair_center.phone as rc_phone',
                'repair_center.email as rc_email',
                'repair_center.zip as rc_zip',
                'damage_code.id as dc_id',
                'damage_code.part as dc_part')
            ->where('customer.id', '=', $id)
            ->get();
        return $claim;
    }
}
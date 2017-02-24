<?php

namespace App\Models\Role\RepairCenter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RepairCenterModel extends Model
{
    /**
     * Select all claims for repair center by id.
     *
     * @param $id
     * @return mixed
     */
    public function getClaims($id)
    {
        return DB::table('claim')
            ->join('customer', 'claim.customer_id', '=', 'customer.id')
            ->join('repair_center', 'claim.repair_center_id', '=', 'repair_center.id')
            ->select(
                'claim.id as claim_id',
                'customer.first_name as first',
                'customer.last_name as last',
                'claim.product_style as style',
                'repair_center.name as repair_center',
                'claim.created_at as created_at',
                'claim.date_closed as closed_at')
            ->where('claim.repair_center_id', '=', $id)
            ->orderBy('customer.last_name', 'ASC')
            ->paginate(20);
    }
}

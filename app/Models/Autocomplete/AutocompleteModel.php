<?php

namespace App\Models\Autocomplete;

use Illuminate\Database\Eloquent\Model;

class AutocompleteModel extends Model
{
    /**
     * Return results of matching customer email from database.
     *
     * @param $email
     * @return string
     */
    public function getCustomerEmail($email)
    {
        $emails = \DB::table('customer')
            ->select(
                'email as value'
            )
            ->where('email', 'like', '%' . $email . '%')
            ->limit(6)
            ->orderBy('email', 'asc')
            ->get();

        return json_encode($emails);
    }

    /**
     * Return results of matching damage code from database.
     *
     * @param $damageCode
     * @return string
     */
    public function getDamageCode($damageCode)
    {
        $damageCodes = \DB::table('damage_code')
            ->select(
                \DB::raw('CONCAT(id, " - ", part) as value'),
                'id as data'
            )
            ->where('id', 'like', '%' . $damageCode . '%')
            ->orWhere('part', 'like', '%' . $damageCode . '%')
            ->limit(6)
            ->orderBy('id', 'asc')
            ->orderBy('part', 'asc')
            ->get();

        return json_encode($damageCodes);
    }

    /**
     * Return results of matching product from database.
     *
     * @param $product
     * @return string
     */
    public function getProduct($product)
    {
        $products = \DB::table('product')
            ->select(
                \DB::raw('CONCAT(collection, " - ", style, " - ", color) as value'),
                'style as data'
            )
            ->where('collection', 'like', '%' . $product . '%')
            ->orWhere('style', 'like', '%' . $product . '%')
            ->orWhere('color', 'like', '%' . $product . '%')
            ->limit(60)
            ->orderBy('collection', 'asc')
            ->orderBy('style', 'asc')
            ->orderBy('color', 'asc')
            ->get();

        return json_encode($products);
    }

    /**
     * Return results of matching repair center from database.
     *
     * @param $repairCenter
     * @return string
     */
    public function getRepairCenter($repairCenter)
    {
        $repairCenters = \DB::table('repair_center')
            ->select(
                \DB::raw('CONCAT(name, " - ", address, " ", city, ", ", state, " ", zip) as value'),
                'id as data'
            )
            ->where('name', 'like', '%' . $repairCenter . '%')
            ->orWhere('address', 'like', '%' . $repairCenter . '%')
            ->orWhere('city', 'like', '%' . $repairCenter . '%')
            ->orWhere('state', 'like', '%' . $repairCenter . '%')
            ->orWhere('zip', 'like', '%' . $repairCenter . '%')
            ->limit(60)
            ->orderBy('name', 'asc')
            ->get();

        return json_encode($repairCenters);
    }
}

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
}

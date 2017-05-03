<?php

namespace App\Models\Autocomplete;

use Illuminate\Database\Eloquent\Model;

class AutocompleteModel extends Model
{
    public function getCustomerEmail($email)
    {
        $customer = \DB::table('customer')
            ->select(
                'email as value'
            )
            ->where('email', 'like', '%' . $email . '%')
            ->limit(6)
            ->get();

        return json_encode($customer);
    }
}

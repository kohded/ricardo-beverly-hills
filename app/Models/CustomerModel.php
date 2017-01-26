<?php

namespace App\Models;

use DB;

class CustomerModel
{

    public function getCustomerData()
    {
        return DB::table('customer')->get();
    }
}
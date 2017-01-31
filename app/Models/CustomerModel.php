<?php

namespace App\Models;

use DB;

class CustomerModel
{

    public function getCustomerData()
    {
        return DB::table('customer')->get();
    }

    public function insertCustomerData($name, $address, $address_2, $city, $state, $zip, $phone, $extension, $email, $comments)
    {
        DB::table('customer')->insert([
            'name' => $name,
            'address' => $address,
            'address_2' => $address_2,
            'city' => $city,
            'state' => $state,
            'zip' => $zip,
            'phone' => $phone,
            'extension' => $extension,
            'email' => $email,
            'comments' => $comments
        ]);
    }

    public function getCustomerDetailedData($customerId)
    {
        return DB::table('customer')->where('id', '=', $customerId)->get();
    }
}
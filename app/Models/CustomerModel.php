<?php

namespace App\Models;

use DB;

class CustomerModel
{

    public function getCustomerData($customersPerPage = null, $request = null)
    {
        $searchString = $request->input('search');
        $searchField = $request->input('field');

        return DB::table('customer')
            ->when($searchString, function($query) use($searchString, $searchField) {
                if ($searchField === 'name')
                {
                    return $query->where('first_name', 'like', '%' . $searchString . '%')
                        ->orWhere('last_name', 'like', '%' . $searchString . '%');
                }
                else if ($searchField === 'address')
                {
                    return $query->where('address', 'like', '%' . $searchString . '%');
                }
                else if ($searchField === 'city')
                {
                    return $query->where('city', 'like', '%' . $searchString . '%');
                }
                else if ($searchField === 'state')
                {
                    return $query->where('state', 'like', '%' . $searchString . '%');
                }
                else if ($searchField === 'email')
                {
                    return $query->where('email', 'like', '%' . $searchString . '%');
                }
                else
                {
                    return $query->where('first_name', 'like', '%' . $searchString . '%')
                        ->orWhere('last_name', 'like', '%' . $searchString . '%')
                        ->orWhere('address', 'like', '%' . $searchString . '%')
                        ->orWhere('city', 'like', '%' . $searchString . '%')
                        ->orWhere('state', 'like', '%' . $searchString . '%')
                        ->orWhere('email', 'like', '%' . $searchString . '%');
                }
            })
            ->when($customersPerPage, function ($query) use ($customersPerPage) {
                return $query->paginate($customersPerPage);
            }, function ($query) {
                return $query->get();
            });
    }

    public function insertCustomerData($first_name, $last_name, $address, $address_2, $city, $state, $zip, $phone, $email)
    {
        DB::table('customer')->insert([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'address' => $address,
            'address_2' => $address_2,
            'city' => $city,
            'state' => $state,
            'zip' => $zip,
            'phone' => $phone,
            'email' => $email
        ]);
    }

    public function getCustomerDetailedData($customerId)
    {
        $tempArr = [];

         $tempArr['claim-customer'] = DB::table('claim_customer')->where('customer_id', '=', $customerId)->get();
         $tempArr['customer'] = DB::table('customer')->where('id', '=', $customerId)->get();

         return $tempArr;
    }

    public function editCustomerData($customerId, $first_name, $last_name, $address, $address_2, $city, $state, $zip, $phone, $email)
    {

        DB::table('customer')->where('id', '=', $customerId)->update([
            'id' => $customerId,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'address' => $address,
            'address_2' => $address_2,
            'city' => $city,
            'state' => $state,
            'zip' => $zip,
            'phone' => $phone,
            'email' => $email
        ]);
    }

    public function deleteCustomer($customerId)
    {
        DB::table('customer')->delete($customerId);
    }
}
<?php

namespace App\Models;

use app\Log\UserActivityLog;
use DB;
use Illuminate\Support\Facades\Auth;

class CustomerModel
{

    public function getCustomerData($customersPerPage = null, $request = null)
    {
        $searchString = $request->input('search');
        $searchField = $request->input('field');

        if(isset($searchString)){
            $request->session()->put('searchCustomer', $searchString);
        }
        if(isset($searchField)){
            $request->session()->put('fieldCustomer', $searchField);
        }

        $searchString = $request->session()->get('searchCustomer');
        $searchField = $request->session()->get('fieldCustomer');

        $filterType = $request->session()->get('filterTypeCustomer');
        $filterOrder = $request->session()->get('filterOrder');

        if(empty($filterType) || empty($filterOrder)) {
            $filterType = 'last_name';
            $filterOrder = 'desc';
        }

        return DB::table('customer')
            ->leftJoin('claim', 'customer.id', '=', 'claim.customer_id')
            ->leftJoin('repair_center', 'claim.repair_center_id', '=', 'repair_center.id')
            ->select(
                'customer.id',
                \DB::raw("CONCAT(first_name, ' ', last_name) as cust_name"),
                'customer.address',
                'customer.city',
                'customer.state',
                'customer.email',
                \DB::raw("CONCAT('(', SUBSTRING(customer.phone, 1, 3), ') ', 
                                      SUBSTRING(customer.phone, 4, 3), '-',
                                      SUBSTRING(customer.phone, 7, 4)) as cust_phone"),
                'customer.zip',
                'repair_center.name as rc_name'
            )
            ->orderBy($filterType, $filterOrder)
            ->when($searchString, function($query) use($searchString, $searchField) {
                if ($searchField === 'name')
                {
                    return $query->where('first_name', 'like', '%' . $searchString . '%')
                        ->orWhere('last_name', 'like', '%' . $searchString . '%');
                }
                else if ($searchField === 'address')
                {
                    return $query->where('customer.address', 'like', '%' . $searchString . '%');
                }
                else if ($searchField === 'city')
                {
                    return $query->where('customer.city', 'like', '%' . $searchString . '%');
                }
                else if ($searchField === 'state')
                {
                    return $query->where('customer.state', 'like', '%' . $searchString . '%');
                }
                else if ($searchField === 'email')
                {
                    return $query->where('customer.email', 'like', '%' . $searchString . '%');
                }
                else
                {
                    return $query->where('first_name', 'like', '%' . $searchString . '%')
                        ->orWhere('last_name', 'like', '%' . $searchString . '%')
                        ->orWhere('customer.address', 'like', '%' . $searchString . '%')
                        ->orWhere('customer.city', 'like', '%' . $searchString . '%')
                        ->orWhere('customer.state', 'like', '%' . $searchString . '%')
                        ->orWhere('customer.email', 'like', '%' . $searchString . '%');
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
        $customerId = DB::table('customer')->insertGetId([
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

        //Stores User Activity Log Data into the DB
        $customerInsertValues = UserActivityLog::getResultsAsArr('customer', $customerId);
        $UALog = new UserActivityLog(Auth::user()->id, Auth::user()->name, 'New Customer Inserted');
        $UALog->insertAllValues(array_keys($customerInsertValues), array_values($customerInsertValues));
    }

    public function getCustomerDetailedData($customerId)
    {
        $tempArr = [];

        $tempArr['claim-customer'] = DB::table('claim_customer')->where('customer_id', '=', $customerId)->get();
        $tempArr['customer'] = DB::table('customer')
            ->select(
                'id',
                'first_name',
                'last_name',
                'address',
                'address_2',
                'city',
                'state',
                'zip',
                'email',
                \DB::raw("CONCAT('(', SUBSTRING(phone, 1, 3), ') ', 
                                      SUBSTRING(phone, 4, 3), '-',
                                      SUBSTRING(phone, 7, 4)) as phone")
            )
            ->where('id', '=', $customerId)
            ->get();

         return $tempArr;
    }

    public function editCustomerData($customerId, $first_name, $last_name, $address, 
                                     $address_2, $city, $state, $zip, $phone, $email)
    {
        $editCustomerValues = [
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
        ];

        DB::table('customer')->where('id', '=', $customerId)->update($editCustomerValues);

        //Stores User Activity Log Data into the DB
        $UALog = new UserActivityLog(Auth::user()->id, Auth::user()->name, 'Customer Edited');
        $UALog->insertAllValues(array_keys($editCustomerValues), array_values($editCustomerValues));
    }

    public function deleteCustomer($customerId)
    {
        $customerDeleteValues = UserActivityLog::getResultsAsArr('customer', $customerId);

        DB::table('customer')->delete($customerId);

        //Stores User Activity Log Data into the DB
        $UALog = new UserActivityLog(Auth::user()->id, Auth::user()->name, 'Customer Deleted');
        $UALog->insertAllValues(array_keys($customerDeleteValues), array_values($customerDeleteValues));
    }

    public function getCustomerIdByEmail($email)
    {
        return DB::table('customer')
                    ->where('email', '=', $email)
                    ->select('id')
                    ->first();
    }
}
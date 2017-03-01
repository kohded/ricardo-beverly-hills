<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class RepairCenterModel
{
    /**
     * Select all repair centers.
     *
     * @return mixed
     */
    public function getRepairCenters($rcPerPage = null, $request = null)
    {
        $searchString = null;
        $searchField = null;
        
        if (isset($request))
        {
            $searchString = $request->input('search');
            $searchField = $request->input('field');
        }

        $repairCenters = DB::table('repair_center')
            ->when($searchString, function($query) use($searchString, $searchField) {
                if ($searchField === 'name')
                {
                    return $query->where('name', 'like', '%' . $searchString . '%');
                }
                else if ($searchField === 'contact')
                {
                    return $query->where('contact_name', 'like', '%' . $searchString . '%');
                }
                else if ($searchField === 'email')
                {
                    return $query->where('email', 'like', '%' . $searchString . '%');
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
                else
                {
                    return $query->where('name', 'like', '%' . $searchString . '%')
                                ->orWhere('contact_name', 'like', '%' . $searchString . '%')
                                ->orWhere('address', 'like', '%' . $searchString . '%')
                                ->orWhere('city', 'like', '%' . $searchString . '%')
                                ->orWhere('state', 'like', '%' . $searchString . '%')
                                ->orWhere('email', 'like', '%' . $searchString . '%');
                }
            })
            ->when($rcPerPage, function($query) use($rcPerPage) {
                return $query->paginate($rcPerPage);
            }, function($query) {
                return $query->get();
            });
            
        return $repairCenters;
    }

    /**
     * Select repair center by id.
     *
     * @param $id
     * @return mixed
     */
    public function getRepairCenter($id)
    {
        $repairCenter = DB::table('repair_center')->where('id', $id)->get();

        return $repairCenter;
    }

    /**
     * Insert a repair center into the database.
     *
     * @param $name
     * @param $contactName
     * @param $phone
     * @param $email
     * @param $address
     * @param $city
     * @param $state
     * @param $zip
     */
    public function createRepairCenter($name, $contactName, $phone, $email, $address, $city, $state, $zip)
    {
        DB::table('repair_center')->insert([
            'name'         => $name,
            'contact_name' => $contactName,
            'phone'        => $phone,
            'email'        => $email,
            'address'      => $address,
            'city'         => $city,
            'state'        => $state,
            'zip'          => $zip,
        ]);
    }

    /**
     * Update a repair center by id.
     *
     * @param $name
     * @param $contactName
     * @param $phone
     * @param $email
     * @param $address
     * @param $city
     * @param $state
     * @param $zip
     * @param $id
     */
    public function editRepairCenter($name, $contactName, $phone, $email, $address, $city, $state, $zip, $id)
    {
        DB::table('repair_center')->where('id', $id)->update([
            'name'         => $name,
            'contact_name' => $contactName,
            'phone'        => $phone,
            'email'        => $email,
            'address'      => $address,
            'city'         => $city,
            'state'        => $state,
            'zip'          => $zip,
            'id'           => $id,
        ]);
    }

    /**
     * Delete repair center by id.
     *
     * @param $id
     */
    public function deleteRepairCenter($id)
    {
        DB::table('repair_center')->delete($id);
    }
}
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
    public function getRepairCenters()
    {
        $repairCenters = DB::table('repair_center')->get();

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
     * @param $phone
     * @param $fax
     * @param $address
     * @param $city
     * @param $state
     * @param $zip
     */
    public function createRepairCenter($name, $phone, $fax, $address, $city, $state, $zip)
    {
        DB::table('repair_center')->insert([
            'name'    => $name,
            'phone'   => $phone,
            'fax'     => $fax,
            'address' => $address,
            'city'    => $city,
            'state'   => $state,
            'zip'     => $zip,
        ]);
    }

    /**
     * Update a repair center by id.
     *
     * @param $name
     * @param $phone
     * @param $fax
     * @param $address
     * @param $city
     * @param $state
     * @param $zip
     * @param $id
     */
    public function editRepairCenter($name, $phone, $fax, $address, $city, $state, $zip, $id)
    {
        DB::table('repair_center')->where('id', $id)->update([
            'name'    => $name,
            'phone'   => $phone,
            'fax'     => $fax,
            'address' => $address,
            'city'    => $city,
            'state'   => $state,
            'zip'     => $zip,
            'id'      => $id,
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
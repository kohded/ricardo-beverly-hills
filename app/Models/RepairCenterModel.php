<?php

namespace App\Models;

use app\Log\UserActivityLog;
use Illuminate\Support\Facades\Auth;
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

        if(isset($request)) {
            $searchString = $request->input('searchRC');
            $searchField = $request->input('fieldRC');
        }

        if(isset($searchString)){
            $request->session()->put('searchRC', $searchString);
        }
        if(isset($searchField)){
            $request->session()->put('fieldRC', $searchField);
        }

        $searchString = $request->session()->get('searchRC');
        $searchField = $request->session()->get('fieldRC');

        $filterType = $request->session()->get('filterTypeRC');
        $filterOrder = $request->session()->get('filterOrder');

        if(empty($filterType) || empty($filterOrder)) {

            $filterType = 'id';
            $filterOrder = 'asc';
        }

        $repairCenters = DB::table('repair_center')
            ->select(
                'id',
                'name',
                'contact_name',
                'email',
                'address',
                'city',
                'state',
                'preferred',
                \DB::raw("CONCAT('(', SUBSTRING(phone, 1, 3), ') ', 
                                      SUBSTRING(phone, 4, 3), '-',
                                      SUBSTRING(phone, 7, 4)) as phone")
            )
            ->orderBy($filterType, $filterOrder)
            ->when($searchString, function($query) use ($searchString, $searchField) {
                if($searchField === 'name') {
                    return $query->where('name', 'like', '%' . $searchString . '%');
                } else {
                    if($searchField === 'contact') {
                        return $query->where('contact_name', 'like', '%' . $searchString . '%');
                    } else {
                        if($searchField === 'email') {
                            return $query->where('email', 'like', '%' . $searchString . '%');
                        } else {
                            if($searchField === 'address') {
                                return $query->where('address', 'like', '%' . $searchString . '%');
                            } else {
                                if($searchField === 'city') {
                                    return $query->where('city', 'like', '%' . $searchString . '%');
                                } else {
                                    if($searchField === 'state') {
                                        return $query->where('state', 'like', '%' . $searchString . '%');
                                    } else {
                                        return $query->where('name', 'like', '%' . $searchString . '%')
                                            ->orWhere('contact_name', 'like', '%' . $searchString . '%')
                                            ->orWhere('address', 'like', '%' . $searchString . '%')
                                            ->orWhere('city', 'like', '%' . $searchString . '%')
                                            ->orWhere('state', 'like', '%' . $searchString . '%')
                                            ->orWhere('email', 'like', '%' . $searchString . '%');
                                    }
                                }
                            }
                        }
                    }
                }
            })
            ->when($rcPerPage, function($query) use ($rcPerPage) {
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
        $repairCenter = DB::table('repair_center')
            ->select(
                'id',
                'name',
                'contact_name',
                'email',
                'address',
                'city',
                'state',
                'zip',
                'preferred',
                \DB::raw("CONCAT('(', SUBSTRING(phone, 1, 3), ') ', 
                                      SUBSTRING(phone, 4, 3), '-',
                                      SUBSTRING(phone, 7, 4)) as phone")          
            )
            ->where('id', $id)
            ->get();

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
    public function createRepairCenter($name, $contactName, $phone, $email, $address, $city, $state, $zip, $preferred)
    {
        if($preferred === null) {
            $preferred = 0;
        }

        $rCId = DB::table('repair_center')->insertGetId([
            'name'         => $name,
            'contact_name' => $contactName,
            'phone'        => $phone,
            'email'        => $email,
            'address'      => $address,
            'city'         => $city,
            'state'        => $state,
            'zip'          => $zip,
            'preferred'    => $preferred
        ]);

        //Stores User Activity Log Data into the DB
        $rCInsertValues = UserActivityLog::getResultsAsArr('repair_center', $rCId);
        $UALog = new UserActivityLog(Auth::user()->id, Auth::user()->name, 'New Repair Center Inserted');
        $UALog->insertAllValues(array_keys($rCInsertValues), array_values($rCInsertValues));
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
     * @param $preferred
     * @param $id
     */
    public function editRepairCenter($name, $contactName, $phone, $email, $address, $city, $state, $zip, $preferred, $id)
    {
        if($preferred === null) {
            $preferred = 0;
        }

        $rCEditValues = [
            'name'         => $name,
            'contact_name' => $contactName,
            'phone'        => $phone,
            'email'        => $email,
            'address'      => $address,
            'city'         => $city,
            'state'        => $state,
            'zip'          => $zip,
            'preferred'    => $preferred,
            'id'           => $id,
        ];

        DB::table('repair_center')->where('id', $id)->update($rCEditValues);

        //Stores User Activity Log Data into the DB
        $UALog = new UserActivityLog(Auth::user()->id, Auth::user()->name, 'Repair Center Edited');
        $UALog->insertAllValues(array_keys($rCEditValues), array_values($rCEditValues));
    }

    /**
     * Delete repair center by id.
     *
     * @param $id
     */
    public function deleteRepairCenter($id)
    {
        //get Repair center data before it is deleted to store in logs
        $rCInsertValues = UserActivityLog::getResultsAsArr('repair_center', $id);

        DB::table('repair_center')->delete($id);

        //Stores User Activity Log Data into the DB
        $UALog = new UserActivityLog(Auth::user()->id, Auth::user()->name, 'Repair Center Deleted');
        $UALog->insertAllValues(array_keys($rCInsertValues), array_values($rCInsertValues));
    }
}
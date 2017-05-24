<?php

namespace App\Models;

use app\Log\UserActivityLog;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DamageCodeModel
{
    public function getDamageCodes($request)
    {
        $filterType = $request->session()->get('filterTypeDC');
        $filterOrder = $request->session()->get('filterOrder');

        if(empty($filterType) || empty($filterOrder)) {
            $filterType = 'id';
            $filterOrder = 'asc';
        }

        $damageCodes = DB::table('damage_code')
            ->orderBy($filterType, $filterOrder)
            ->get();

        return $damageCodes;
    }

    public function getDamageCode($id)
    {
        $damageCode = DB::table('damage_code')->where('id', $id)->get();

        return $damageCode;
    }

    public function createDamageCode($id, $part)
    {
        DB::table('damage_code')->insert([
            'id'   => $id,
            'part' => $part
        ]);

        //Stores User Activity Log Data into the DB
        $UALog = new UserActivityLog(Auth::user()->id, Auth::user()->name, 'Damage Code Created');
        $UALog->insertAllValues((array) $id, (array) $part);
    }

    public function editDamageCode($oldId, $newId, $part)
    {
        DB::table('damage_code')->where('id', $oldId)->update([
            'id'   => $newId,
            'part' => $part
        ]);

        $UALog = new UserActivityLog(Auth::user()->id, Auth::user()->name, 'Damage Code Edited');
        $UALog->insertAllValues((array) $newId, (array) $part);
    }

    public function deleteDamageCode($id)
    {
        //Get values before they are deleted
        $deleteDamageCodeValues = UserActivityLog::getResultsAsArr('damage_code', $id);

        DB::table('damage_code')->delete($id);

        //Stores User Activity Log Data into the DB

        $UALog = new UserActivityLog(Auth::user()->id, Auth::user()->name, 'Damage Code Deleted');
        $UALog->insertAllValues(array_keys($deleteDamageCodeValues), array_values($deleteDamageCodeValues));
    }
}

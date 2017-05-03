<?php

namespace App\Models;

use DB;
use Illuminate\Http\Request;

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
    }

    public function editDamageCode($oldId, $newId, $part)
    {
        DB::table('damage_code')->where('id', $oldId)->update([
            'id'   => $newId,
            'part' => $part
        ]);
    }

    public function deleteDamageCode($id)
    {
        DB::table('damage_code')->delete($id);
    }
}

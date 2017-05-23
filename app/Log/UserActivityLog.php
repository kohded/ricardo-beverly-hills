<?php
/**
 * Created by PhpStorm.
 * User: peter
 * Date: 5/22/2017
 * Time: 2:20 PM
 */

namespace app\Log;
use Illuminate\Support\Facades\DB;


class UserActivityLog
{

    private $log_id;

    Public function __construct($userID, $userName, $action) {

        $userRoleId = DB::table('role_user')->where('user_id', '=', $userID)->pluck('role_id');
        $userRole = DB::table('roles')->where('id', '=', $userRoleId)->pluck('name');

        $this->log_id = DB::table('user_activity_log')->insertGetId([
            'user_id' => $userID,
            'username' => $userName,
            'user_role' => $userRole,
            'action' => $action
        ]);

    }


    public function insertAllValues($valueTypes, $values) {

        $valuesAssocArr = array_combine($valueTypes, $values);

        foreach ($valuesAssocArr as $valueTypes => $value) {

                $this->storeValues($valueTypes, $value);
        }
    }

    private function storeValues($valueType, $value) {
        DB::table('log_values_xref')->insert([
            'log_id' => $this->log_id,
            'value_type' => $valueType,
            'value' => $value
        ]);
    }




}
<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class UALogModel
{
    public function getAllUserActivity() {
        return DB::table('user_activity_log')->orderby('id', 'DESC')->get();
    }

    public function getUserActivity($id) {
        return DB::table('log_values_xref')->where('log_id', '=', $id)->orderby('id', 'ASC')->get();
    }
}

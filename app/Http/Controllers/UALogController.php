<?php

namespace App\Http\Controllers;

use App\Models\UALogModel;
use Illuminate\Http\Request;

class UALogController extends Controller
{
    public function getUALogView() {

        $uALogModel = new UALogModel();
        $uALogModel = $uALogModel->getAllUserActivity();

        return view('ualog', [
            'logs' => $uALogModel
        ]);
    }

    public function getUALogDetail($id) {
        $uALogModel = new UALogModel();
        $uALogModel = $uALogModel->getUserActivity($id);

        return view('ualog-detail', [
            'logDetails' => $uALogModel
        ]);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: peter
 * Date: 6/1/2017
 * Time: 1:52 PM
 */

namespace App\Http\Controllers;


class ErrorController extends Controller
{
    public function idDoesntExist($id, $type) {
        return view('errors.idDoesntExist', [
                'id' => $id,
                'type' => $type
            ]);
    }
}
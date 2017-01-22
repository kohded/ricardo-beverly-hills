<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDashboardView()
    {
        $title = 'Dashboard';

        return view('dashboard', ['title' => $title]);
    }
}
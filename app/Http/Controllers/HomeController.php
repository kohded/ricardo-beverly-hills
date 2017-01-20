<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getHomeView()
    {
        $title = 'Home';

        return view('home', ['title' => $title]);
    }
}
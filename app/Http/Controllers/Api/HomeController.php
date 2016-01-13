<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('documentation');
    }

    public function secureTest()
    {
        return ['status' => true];
    }

}
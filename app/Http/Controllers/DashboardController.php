<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // merender file view dashboard/index.blade.php
        return view('dashboard.index');
    }
}

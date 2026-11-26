<?php

namespace App\Http\Controllers\Hairdresser;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index():View
    {
        return view('hairdresser.dashboard');
    }
}

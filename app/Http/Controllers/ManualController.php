<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManualController extends Controller
{
    public function showManual()
    {
        return view('manual');
    }
}

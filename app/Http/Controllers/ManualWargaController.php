<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManualWargaController extends Controller
{
    public function showManual()
    {
        return view('manual_warga');
    }
}

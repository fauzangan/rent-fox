<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeriodeFinalController extends Controller
{
    public function index() {
        return view('dashboard.periode-final.tagihan-scaffolding');
    }
}

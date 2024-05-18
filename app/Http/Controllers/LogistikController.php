<?php

namespace App\Http\Controllers;

use App\Models\Logistik;
use Illuminate\Http\Request;

class LogistikController extends Controller
{
    public function index(){
        $logistiks = Logistik::all();
        return view('dashboard.logistiks.index', [
            'logistiks' => $logistiks
        ]);
    }
}

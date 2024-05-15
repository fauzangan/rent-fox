<?php

namespace App\Http\Controllers;

use App\Models\JenisTagihan;
use App\Models\Order;
use App\Models\StatusTagihan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index(){
        return view('dashboard.tagihans.index');
    }

    public function create(){
        $orders = Order::all();
        $jenisTagihans = JenisTagihan::all();
        $statusTagihans = StatusTagihan::all();
        return view('dashboard.tagihans.create', [
            'orders' => $orders,
            'jenis_tagihans' => $jenisTagihans,
            'status_tagihans' => $statusTagihans
        ]);
    }

    public function store(Request $request) {
        
        dd($request);
    }
}

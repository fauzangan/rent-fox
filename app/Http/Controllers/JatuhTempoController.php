<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class JatuhTempoController extends Controller
{
    public function index(){
        $orders = Order::where('status_order_id', 1)
        ->with(['customer.perusahaan', 'statusOrder', 'statusTransport'])
        ->orderBy('order_id', 'desc')
        ->paginate(10);

        return view('dashboard.jatuh-tempos.index', [
            'orders' => $orders
        ]);
    }
}

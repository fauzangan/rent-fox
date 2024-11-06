<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class JatuhTempoController extends Controller
{
    public function index()
    {
        $orders = Order::where('status_order_id', 1)
            ->with(['customer.perusahaan', 'statusOrder', 'statusTransport'])
            ->orderBy('order_id', 'desc')
            ->paginate(10);

        return view('dashboard.jatuh-tempos.index', [
            'orders' => $orders
        ]);
    }

    // JatuhTempoController.php
    public function getJatuhTempo(Order $order)
    {
        $tanggalJatuhTempo = $order->tanggal_jatuh_tempo;

        return response()->json([
            'jatuh_tempo_lalu' => $tanggalJatuhTempo->copy()->subDays(30)->format('d/m/Y'),
            'jatuh_tempo_ini' => $tanggalJatuhTempo->format('d/m/Y'),
            'jatuh_tempo_perpanjang' => $tanggalJatuhTempo->copy()->addDays(30)->format('d/m/Y')
        ]);
    }
}

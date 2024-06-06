<?php

namespace App\Http\Controllers;

use App\Models\LogistikHarian;
use App\Models\Order;
use App\Models\Tagihan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MainDashboardController extends Controller
{
    public function index(){
        return view('dashboard.main-dashboard.index');
    }

    public function getOrdersByDate(Request $request) {
        $request->validate([
            'date' => ['required', 'date_format:F Y']
        ]);

        $date = $request->input('date');
        $parsedDate = Carbon::createFromFormat('F Y', $date);

        $orders = Order::whereYear('tanggal_order', $parsedDate->year)
                       ->whereMonth('tanggal_order', $parsedDate->month)
                       ->get();

        $totalOrders = $orders->count();
        $statusOrdersAktif = $orders->where('status_order_id', 1)->count();
        $statusOrdersTutup = $orders->where('status_order_id', 2)->count();
        $statusOrdersTunda = $orders->where('status_order_id', 3)->count();
        $statusOrdersDel = $orders->where('status_order_id', 4)->count();

        return response()->json([
            "totalOrders" => $totalOrders, 
            'statusOrderAktif' => $statusOrdersAktif, 
            'statusOrderTutup' => $statusOrdersTutup, 
            'statusOrderTunda' => $statusOrdersTunda,
            'statusOrderDel' => $statusOrdersDel,
        ]);
    }

    public function getTagihansByDate(Request $request) {
        $request->validate([
            'date' => ['required', 'date_format:F Y']
        ]);

        $date = $request->input('date');
        $parsedDate = Carbon::createFromFormat('F Y', $date);

        $tagihans = Tagihan::whereYear('tanggal_ditagihkan', $parsedDate->year)
                       ->whereMonth('tanggal_ditagihkan', $parsedDate->month)
                       ->get();

        $totalTagihans = $tagihans->count();
        $statusTagihansDitagihkan = $tagihans->where('status_tagihan_id', 1)->count();
        $statusTagihansDibayarSebagian = $tagihans->where('status_tagihan_id', 2)->count();
        $statusTagihansLunas = $tagihans->where('status_tagihan_id', 3)->count();
        $statusTagihansLebihBayar = $tagihans->where('status_tagihan_id', 4)->count();
        $statusTagihansBermasalah = $tagihans->where('status_tagihan_id', 5)->count();
        $statusTagihansLunasTanggungan = $tagihans->where('status_tagihan_id', 6)->count();
        $statusTagihansTutupTanggungan = $tagihans->where('status_tagihan_id', 7)->count();
        $statusTagihansTutupDel = $tagihans->where('status_tagihan_id', 8)->count();

        return response()->json([
            "totalTagihans" => $totalTagihans, 
            'statusTagihansDitagihkan' => $statusTagihansDitagihkan, 
            'statusTagihansDibayarSebagian' => $statusTagihansDibayarSebagian, 
            'statusTagihansLunas' => $statusTagihansLunas, 
            'statusTagihansLebihBayar' => $statusTagihansLebihBayar, 
            'statusTagihansBermasalah' => $statusTagihansBermasalah, 
            'statusTagihansLunasTanggungan' => $statusTagihansLunasTanggungan,
            'statusTagihansTutupTanggungan' => $statusTagihansTutupTanggungan,
            'statusTagihansTutupDel' => $statusTagihansTutupDel,
        ]);
    }

    public function getLogistikHariansByDate(Request $request)
    {
        $request->validate([
            'date' => ['required', 'date_format:F Y']
        ]);

        $date = $request->input('date');
        $parsedDate = Carbon::createFromFormat('F Y', $date);

        $logistikHarians = LogistikHarian::whereYear('tanggal_transaksi', $parsedDate->year)
                        ->whereMonth('tanggal_transaksi', $parsedDate->month)
                        ->get();
        
        $totalLogistikHarians = $logistikHarians->count();
        $logistikHariansPengiriman = $logistikHarians->where('status_logistik_id', 1)->count();
        $logistikHariansPengembalian = $logistikHarians->where('status_logistik_id', 2)->count();


        return response()->json([
            "totalLogistikHarians" => $totalLogistikHarians,
            "logistikHariansPengiriman" => $logistikHariansPengiriman,
            "logistikHariansPengembalian" => $logistikHariansPengembalian,
        ]);
    }
}

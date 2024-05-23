<?php

namespace App\Http\Controllers;

use App\Models\Logistik;
use Illuminate\Http\Request;

class LogistikController extends Controller
{
    public function index(){
        $logistiks = Logistik::with(['logistikHarians', 'item', 'reservasiItems.reservasi'])->get();
        foreach($logistiks as $logistik){
            $logistik['baik'] = $logistik->logistikHarians->sum('baik');
            $logistik['x_ringan'] = $logistik->logistikHarians->sum('x_ringan');
            $logistik['x_berat'] = $logistik->logistikHarians->sum('x_berat');
            $logistik['total_harian_log'] = $logistik['baik'] + $logistik['x_ringan'] + $logistik['x_berat'];
            $logistik['total_rental'] = (($logistik['total_harian_log'] + $logistik->claim_hilang) >= 0) ? ($logistik['total_harian_log'] + $logistik->claim_hilang) : 0;
            $logistik['stock_gudang'] = $logistik->total_stock - $logistik['total_rental'];
            $logistik['reservasi'] = $logistik->reservasiItems->where('reservasi.status_reservasi_id', 1)->sum('jumlah_item');
            $logistik['stock_ready'] = $logistik['stock_gudang'] - $logistik['reservasi'];
        }

        // dd($logistiks[0]->total_stock - $logistiks[0]->total_rental);

        return view('dashboard.logistiks.index', [
            'logistiks' => $logistiks
        ]);
    }
}

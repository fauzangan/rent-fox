<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogistikFilterRequest;
use App\Models\CategoryItem;
use App\Models\Logistik;
use Illuminate\Http\Request;

class LogistikController extends Controller
{
    public function index(LogistikFilterRequest $request){
        $logistiks = Logistik::query()
        ->with(['logistikHarians', 'item', 'reservasiItems.reservasi'])
        ->filterByItemId($request->input('item_id'))
        ->filterByItemName($request->input('nama_item'))
        ->filterByCategoryItemId($request->input('category_item_id'))
        ->get();

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

        $categoryItems = CategoryItem::all();
        return view('dashboard.logistiks.index', [
            'logistiks' => $logistiks,
            'category_items' => $categoryItems
        ]);
    }
}

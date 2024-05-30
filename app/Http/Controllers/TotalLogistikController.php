<?php

namespace App\Http\Controllers;

use App\Http\Requests\TotalLogistikFilterRequest;
use App\Models\Logistik;
use Illuminate\Http\Request;
use App\Models\TotalLogistik;
use App\Models\DataTotalLogistik;
use App\Models\StatusTotalLogistik;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class TotalLogistikController extends Controller
{
    public function index(TotalLogistikFilterRequest $request){
        $totalLogistiks = TotalLogistik::query()
        ->with(['logistik.item','statusTotalLogistik', 'dataTotalLogistik'])
        ->filterByStatusTotalLogistikId($request->input('status_total_logistik_id'))
        ->filterByItemId($request->input('item_id'))
        ->filterByItemName($request->input('nama_item'))
        ->filterByDataTotalLogistikId($request->input('data_total_logistik_id'))
        ->filterByTanggalTransaksi($request->input('tanggal_transaksi'))
        ->get();
        $statusTotalLogistiks = StatusTotalLogistik::all();
        $dataTotalLogistiks = DataTotalLogistik::all();
        return view('dashboard.total-logistiks.index', [
            'total_logistiks' => $totalLogistiks,
            'status_total_logistiks' => $statusTotalLogistiks,
            'data_total_logistiks' => $dataTotalLogistiks
        ]);
    }

    public function create(){
        $logistiks = Logistik::all();
        $statusTotalLogistik = StatusTotalLogistik::all();
        $dataTotalLogistik = DataTotalLogistik::all();
        return view('dashboard.total-logistiks.create', [
            'status_total_logistiks' => $statusTotalLogistik,
            'data_total_logistiks' => $dataTotalLogistik,
            'logistiks' => $logistiks
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'status_total_logistik_id' => ['required', 'integer'],
            'tanggal_transaksi' => ['required', 'string'],
            'keterangan' => ['sometimes', 'nullable'],
            'logistik_id' => ['required', 'integer'],
            'data_total_logistik_id' => ['required', 'integer'],
            'jumlah_item' => ['required', 'integer'],
            'vendor' => ['sometimes', 'nullable']
        ]);

        
        try {
            // Memanggil metode createTotalLogistik dari model
            $totalLogistik = TotalLogistik::createTotalLogistik($validatedData);

            // Notifikasi berhasil
            Alert::success('Data Total Logistik ASR ID: ' . $totalLogistik->total_logistik_id . ' berhasil ditambahkan', 'success');

            // Redirect ke halaman index
            return redirect()->route('dashboard.total-logistiks.index');
        } catch (\Exception $e) {
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in creating total logistik data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat menambahkan data Logistik ASR. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data logistik asr.']);
        }
    }

    public function edit(TotalLogistik $totalLogistik){
        $logistiks = Logistik::all();
        $statusTotalLogistiks = StatusTotalLogistik::all();
        $dataTotalLogistiks = DataTotalLogistik::all();
        return view('dashboard.total-logistiks.edit', [
            'total_logistik' => $totalLogistik,
            'logistiks' => $logistiks,
            'status_total_logistiks' => $statusTotalLogistiks,
            'data_total_logistiks' => $dataTotalLogistiks
        ]);
    }

    public function update(Request $request, TotalLogistik $totalLogistik){
        $validatedData = $request->validate([
            'status_total_logistik_id' => ['required', 'integer'],
            'tanggal_transaksi' => ['required', 'string'],
            'keterangan' => ['sometimes', 'nullable'],
            'logistik_id' => ['required', 'integer'],
            'data_total_logistik_id' => ['required', 'integer'],
            'jumlah_item' => ['required', 'integer'],
            'vendor' => ['sometimes', 'nullable']
        ]);

        try {
            // Memanggil metode createTotalLogistik dari model
            $totalLogistik->updateTotalLogistik($validatedData);

            // Notifikasi berhasil
            Alert::success('Data Total Logistik ASR ID: ' . $totalLogistik->total_logistik_id . ' berhasil diedit', 'success');

            // Redirect ke halaman index
            return redirect()->route('dashboard.total-logistiks.index');
        } catch (\Exception $e) {
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in creating total logistik data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat mengedit data Logistik ASR. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengedit data logistik asr.']);
        }
    }
}

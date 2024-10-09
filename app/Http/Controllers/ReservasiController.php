<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservasiFilterRequest;
use App\Models\Item;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use App\Models\StatusReservasi;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class ReservasiController extends Controller
{
    public function index(ReservasiFilterRequest $request){
        $reservasis = Reservasi::query()
        ->with(['statusReservasi'])
        ->filterByTanggalReservasi($request->input('tanggal_reservasi'))
        ->filterByCustomerName($request->input('nama_custome'))
        ->filterByPerusahaanName($request->input('nama_perusahaan'))
        ->filterByHandphone($request->input('handphone'))
        ->orderBy('reservasi_id', 'desc')
        ->get();
        return view('dashboard.reservasis.index', [
            'reservasis' => $reservasis
        ]);
    }

    public function create(){
        $items = Item::all();
        $statusReservasis = StatusReservasi::all();
        return view('dashboard.reservasis.create', [
            'status_reservasis' => $statusReservasis,
            'items' => $items
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'tanggal_reservasi' => ['required', 'string'],
            'status_reservasi_id' => ['required'],
            'nama_customer' => ['required', 'string', 'max:255'],
            'telp_customer' => ['required', 'string'],
            'fax_customer' => ['sometimes', 'nullable', 'string'],
            'handphone' => ['required', 'string'],
            'badan_hukum' => ['sometimes', 'nullable', 'string'],
            'nama_perusahaan' => ['sometimes', 'nullable', 'string'],
            'telp_perusahaan' => ['sometimes', 'nullable', 'string'],
            'fax_perusahaan' => ['sometimes', 'nullable', 'string'],
            'proyek' => ['sometimes', 'nullable', 'string'],
            'keterangan' => ['sometimes', 'nullable', 'string'],
            'items' => ['required'],
            'jumlah_items' => ['required'],
            'waktus' => ['required'],
            'jumlah_hargas' => ['required']
        ]);

        try {
            // Memanggil metode createReservasiwithItem dari model
            $reservasi = Reservasi::createReservasiWithItems($validatedData);

            // Notifikasi berhasil
            Alert::success('Data reservasi ID: ' . $reservasi->reservasi_id . ' berhasil dibuat', 'success');

            // Redirect ke halaman index
            return redirect()->route('dashboard.reservasis.index');
        } catch (\Exception $e) {
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in editing reservasi data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat membuat data reservasi. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat membuat data reservasi.']);
        }
    }

    public function edit(Reservasi $reservasi){
        $statusReservasis = StatusReservasi::all();
        $items = Item::all();
        $reservasi->load('reservasiItems');
        return view('dashboard.reservasis.edit', [
            'status_reservasis' => $statusReservasis,
            'reservasi' => $reservasi,
            'items' => $items
        ]);
    }

    public function update(Request $request, Reservasi $reservasi){
        $validatedData = $request->validate([
            'tanggal_reservasi' => ['required', 'string'],
            'status_reservasi_id' => ['required'],
            'nama_customer' => ['required', 'string', 'max:255'],
            'telp_customer' => ['required', 'string'],
            'fax_customer' => ['sometimes', 'nullable', 'string'],
            'handphone' => ['required', 'string'],
            'badan_hukum' => ['sometimes', 'nullable', 'string'],
            'nama_perusahaan' => ['sometimes', 'nullable', 'string'],
            'telp_perusahaan' => ['sometimes', 'nullable', 'string'],
            'fax_perusahaan' => ['sometimes', 'nullable', 'string'],
            'proyek' => ['sometimes', 'nullable', 'string'],
            'keterangan' => ['sometimes', 'nullable', 'string'],
            'items' => ['required'],
            'jumlah_items' => ['required'],
            'waktus' => ['required'],
            'jumlah_hargas' => ['required']
        ]);
        
        $reservasi = Reservasi::updateReservasiWithItems($validatedData, $reservasi);
        try {
            // Memanggil metode updateReservasiwithItem dari model

            // Notifikasi berhasil
            Alert::success('Data reservasi ID: ' . $reservasi->reservasi_id . ' berhasil diedit', 'success');

            // Redirect ke halaman index
            return redirect()->route('dashboard.reservasis.index');
        } catch (\Exception $e) {
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in editing reservasi data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat mengedit data reservasi. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengedit data reservasi.']);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\JenisTagihan;
use Illuminate\Http\Request;
use App\Models\StatusTagihan;
use App\Models\Tagihan;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class TagihanController extends Controller
{
    public function index(){
        $tagihans = Tagihan::with(['order', 'statusTagihan', 'jenisTagihan'])->paginate(10);
        return view('dashboard.tagihans.index', [
            'tagihans' => $tagihans
        ]);
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
        $validatedData = $request->validate([
            'order_id' => ['required', 'integer'],
            'jenis_tagihan_id' => ['required', 'integer'],
            'tanggal_ditagihkan' => ['required', 'string'],
            'jatuh_tempo_1' => ['required', 'string'],
            'jatuh_tempo_2' => ['required', 'string'],
            'status_tagihan_id' => ['required', 'integer'],
            'jumlah_tagihan' => ['required'],
            'keterangan' => ['sometimes', 'nullable', 'string'],
            'is_dp' => ['required'],
            'total_dp' => ['sometimes', 'required'],
            'dp1' => ['sometimes', 'nullable'],
            'dp2' => ['sometimes', 'nullable'],
            'dp3' => ['sometimes', 'nullable'],
        ]);

        try {
            // Memanggil metode createTagihan dari model
            $tagihan = Tagihan::createTagihan($validatedData);

            // Notifikasi berhasil
            Alert::success('Data Tagihan ID: ' . $tagihan->tagihan_id . ' berhasil ditambahkan', 'success');

            // Redirect ke halaman index
            return redirect()->route('dashboard.tagihans.index');
        } catch (\Exception $e) {
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in storing tagihan data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat menambahkan data tagihan. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data tagihan.']);
        }
    }

    public function edit(Tagihan $tagihan){
        $tagihan->load('order');
        $jenisTagihans = JenisTagihan::all();
        $statusTagihans = StatusTagihan::all();
        return view('dashboard.tagihans.edit', [
            'tagihan' => $tagihan,
            'jenis_tagihans' => $jenisTagihans,
            'status_tagihans' => $statusTagihans,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagihanFilterRequest;
use App\Models\Order;
use App\Models\JenisTagihan;
use Illuminate\Http\Request;
use App\Models\StatusTagihan;
use App\Models\Tagihan;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class TagihanController extends Controller
{
    public function index(TagihanFilterRequest $request){
        $tagihans = Tagihan::query()
        ->with(['order.customer.perusahaan', 'statusTagihan', 'jenisTagihan'])
        ->filterByTagihanId($request->input('tagihan_id'))
        ->filterByOrderId($request->input('order_id'))
        ->filterByCustomerId($request->input('customer_id'))
        ->filterByCustomerName($request->input('nama_customer'))
        ->filterByPerusahaanName($request->input('nama_perusahaan'))
        ->filterByJenisTagihanId($request->input('jenis_tagihan_id'))
        ->filterByStatusTagihanId($request->input('status_tagihan_id'))
        ->filterByTanggalDitagihkan($request->input('tanggal_ditagihkan'))
        ->filterByJatuhTempo1($request->input('jatuh_tempo_1'))
        ->filterByJatuhTempo2($request->input('jatuh_tempo_2'))
        ->orderBy('tagihan_id', 'desc')
        ->paginate(10)
        ->appends($request->except('page'));
        $jenisTagihans = JenisTagihan::all();
        $statusTagihans = StatusTagihan::all();
        return view('dashboard.tagihans.index', [
            'tagihans' => $tagihans,
            'jenis_tagihans' => $jenisTagihans,
            'status_tagihans' => $statusTagihans
        ]);
    }

    public function create(){
        $orders = Order::with(['customer.perusahaan'])->get();
        $jenisTagihans = JenisTagihan::all();
        $statusTagihans = StatusTagihan::all();
        return view('dashboard.tagihans.create', [
            'orders' => $orders,
            'jenis_tagihans' => $jenisTagihans,
            'status_tagihans' => $statusTagihans
        ]);
    }

    public function getOrder(Order $order){
        $order->load(['orderItems', 'tagihans.jenisTagihan', 'tagihans.statusTagihan']);
        return response()->json($order);
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

    public function update(Request $request, Tagihan $tagihan){
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
            $tagihan->updateTagihan($validatedData);

            // Notifikasi berhasil
            Alert::success('Data Tagihan ID: ' . $tagihan->tagihan_id . ' berhasil diedit', 'success');

            // Redirect ke halaman index
            return redirect()->route('dashboard.tagihans.index');
        } catch (\Exception $e) {
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in editing tagihan data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat mengedit data tagihan. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengedit data tagihan.']);
        }
    }
}

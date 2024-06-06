<?php

namespace App\Http\Controllers;

use App\Http\Requests\BukuHarianFilterRequest;
use App\Models\Order;
use App\Models\Customer;
use App\Models\BukuHarian;
use App\Models\GroupBiaya;
use App\Models\PostingBiaya;
use Illuminate\Http\Request;
use App\Models\DataBukuHarian;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class BukuHarianController extends Controller
{
    public function index(BukuHarianFilterRequest $request){
        $bukuHarians = BukuHarian::query()
        ->with(['postingBiaya', 'order', 'dataBukuHarian'])
        ->filterByOrderId($request->input('order_id'))
        ->filterByCustomerId($request->input('customer_id'))
        ->filterByTanggalTransaksi($request->input('tanggal_transaksi'))
        ->filterByGroupBiayaId($request->input('group_biaya_id'))
        ->filterByPostingBiayaId($request->input('posting_biaya_id'))
        ->orderBy('updated_at', 'desc')
        ->get();
        $groupBiayas = GroupBiaya::with(['postingBiayas'])->get();
        return view('dashboard.buku-harians.index', [
            'buku_harians' => $bukuHarians,
            'group_biayas' => $groupBiayas,
        ]);
    }

    public function create(){
        $orders = Order::with('customer')->get();
        $groupBiayas = GroupBiaya::with('postingBiayas')->get();
        $dataBukuHarians = DataBukuHarian::all();
        return view('dashboard.buku-harians.create', [
            'data_buku_harians' => $dataBukuHarians,
            'group_biayas' => $groupBiayas,
            'orders' => $orders
        ]);
    }

    public function getOrderData($orderId){
        $order = Order::where('order_id', $orderId)->with(['orderItems', 'tagihans.jenisTagihan', 'tagihans.statusTagihan'])->first();

        return response()->json($order);
    }

    public function getSaldoData(){
        $kredit = BukuHarian::sum('kredit');
        $debit = BukuHarian::sum('debit');

        $saldo = $kredit - $debit;

        return response()->json($saldo);
    }

    public function getSaldoDataEdit(BukuHarian $bukuHarian){
        $kredit = BukuHarian::where('buku_harian_id', '!=', $bukuHarian->buku_harian_id)->sum('kredit');
        $debit = BukuHarian::where('buku_harian_id', '!=', $bukuHarian->buku_harian_id)->sum('debit');
    
        $saldo = $kredit - $debit;
    
        return response()->json($saldo);
    }

    public function getCustomerData($customerId){
        $customer = Customer::where('customer_id', $customerId)->with(['perusahaan', 'orders'])->first();

        return response()->json($customer);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'posting_biaya_id' => ['required', 'string', 'max:6'],
            'order_id' => ['required', 'integer'],
            'tanggal_transaksi' => ['required', 'string'],
            'keterangan' => ['sometimes', 'nullable'],
            'debit' => ['required'],
            'kredit' => ['required'],
            'data_buku_harian_id' => ['required', 'integer'],
            'vendor' => ['sometimes', 'nullable']
        ]);

        try {
            // Memanggil metode createBukuHarian dari model
            $bukuHarian = BukuHarian::createBukuHarian($validatedData);

            // Notifikasi berhasil
            Alert::success('Data Buku Harian ID: ' . $bukuHarian->buku_harian_id . ' berhasil ditambahkan', 'success');

            // Redirect ke halaman index
            return redirect()->route('dashboard.buku-harians.index');
        } catch (\Exception $e) {
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in storing buku harian data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat menambahkan data buku harian. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data buku harian.']);
        }

        dd($validatedData);
    }

    public function edit(BukuHarian $bukuHarian){
        $orders = Order::with('customer')->get();
        $groupBiayas = GroupBiaya::with('postingBiayas')->get();
        $dataBukuHarians = DataBukuHarian::all();
        return view('dashboard.buku-harians.edit', [
            'buku_harian' => $bukuHarian,
            'orders' => $orders,
            'group_biayas' => $groupBiayas,
            'data_buku_harians' => $dataBukuHarians
        ]);
    }

    public function update(Request $request, BukuHarian $bukuHarian){
        $validatedData = $request->validate([
            'posting_biaya_id' => ['required', 'string', 'max:6'],
            'order_id' => ['required', 'integer'],
            'tanggal_transaksi' => ['required', 'string'],
            'keterangan' => ['sometimes', 'nullable'],
            'debit' => ['required'],
            'kredit' => ['required'],
            'data_buku_harian_id' => ['required', 'integer'],
            'vendor' => ['sometimes', 'nullable']
        ]);

        try {
            // Memanggil metode createBukuHarian dari model
            $bukuHarian->updateBukuHarian($validatedData);

            // Notifikasi berhasil
            Alert::success('Data Buku Harian ID: ' . $bukuHarian->buku_harian_id . ' berhasil diedit', 'success');

            // Redirect ke halaman index
            return redirect()->route('dashboard.buku-harians.index');
        } catch (\Exception $e) {
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in editing buku harian data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat mengedit data buku harian. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengedit data buku harian.']);
        }
    }
}

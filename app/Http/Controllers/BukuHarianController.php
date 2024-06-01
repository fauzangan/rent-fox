<?php

namespace App\Http\Controllers;

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
    public function index(){
        $bukuHarians = BukuHarian::all();
        return view('dashboard.buku-harians.index', [
            'buku_harians' => $bukuHarians
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
        $saldo = BukuHarian::sum('saldo');

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
}

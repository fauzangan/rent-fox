<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Item;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::orderBy('order_id', 'desc')->paginate(5);
        return view('dashboard.orders.index', [
            'orders' => $orders
        ]);
    }

    public function create(){
        $customers = Customer::with('perusahaan')->get();
        $items = Item::all();
        return view('dashboard.orders.create', [
            'customers' => $customers,
            'items' => $items
        ]);
    }

    public function store(Request $request){
        // dd($request);
        $validatedData = $request->validate([
            'tanggal_order' => ['required', 'string'],
            'tanggal_kirim' => ['required', 'string'],
            'customer_id' => ['required'],
            'nama_customer' => ['required', 'string'],
            'identitas_customer' => ['required', 'string'],
            'alamat_customer' => ['required', 'string'],
            'kota_customer' => ['required', 'string'],
            'telp_customer' => ['sometimes', 'nullable'],
            'fax_customer' => ['sometimes', 'nullable'],
            'handphone' => ['required', 'string'],
            'badan_hukum' => ['sometimes', 'nullable', 'string'],
            'nama_perusahaan' => ['sometimes', 'nullable', 'string'],
            'alamat_perusahaan' => ['sometimes', 'nullable', 'string'],
            'kota_perusahaan' => ['sometimes', 'nullable', 'string'],
            'telp_perusahaan' => ['sometimes', 'nullable', 'string'],
            'fax_perusahaan' => ['sometimes', 'nullable', 'string'],
            'kirim_kepada' => ['required', 'string', 'max:255'],
            'alamat_kirim' => ['required', 'string'],
            'nama_proyek' => ['required', 'string', 'max:255'],
            'status_transport' => ['required'],
            'status_order' => ['required'],
            'keterangan' => ['sometimes', 'nullable'],
            'items' => ['required'],
            'jumlah_items' => ['required'],
            'waktus' => ['required'],
            'jumlah_hargas' => ['required']
        ]);

        try {
            // Memanggil metode createCustomer dari model
            $order = Order::createOrderWithItems($validatedData);

            // Notifikasi berhasil
            Alert::success('Data Order ID: ' . $order->order_id . ' berhasil ditambahkan', 'success');

            // Redirect ke halaman index
            return redirect()->route('dashboard.orders.index');
        } catch (\Exception $e) {
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in storing order data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat menambahkan data order. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data item.']);
        }
    }

    public function edit(Order $order){
        $customers = Customer::with('perusahaan')->get();
        $items = Item::all();
        $order->load('orderItems');
        return view('dashboard.orders.edit', [
            'order' => $order,
            'items' => $items,
            'customers' => $customers,
        ]);
    }

    public function update(Request $request, Order $order){
        $validatedData = $request->validate([
            'tanggal_order' => ['required', 'string'],
            'tanggal_kirim' => ['required', 'string'],
            'customer_id' => ['required'],
            'nama_customer' => ['required', 'string'],
            'identitas_customer' => ['required', 'string'],
            'alamat_customer' => ['required', 'string'],
            'kota_customer' => ['required', 'string'],
            'telp_customer' => ['sometimes', 'nullable'],
            'fax_customer' => ['sometimes', 'nullable'],
            'handphone' => ['required', 'string'],
            'badan_hukum' => ['sometimes', 'nullable', 'string'],
            'nama_perusahaan' => ['sometimes', 'nullable', 'string'],
            'alamat_perusahaan' => ['sometimes', 'nullable', 'string'],
            'kota_perusahaan' => ['sometimes', 'nullable', 'string'],
            'telp_perusahaan' => ['sometimes', 'nullable', 'string'],
            'fax_perusahaan' => ['sometimes', 'nullable', 'string'],
            'kirim_kepada' => ['required', 'string', 'max:255'],
            'alamat_kirim' => ['required', 'string'],
            'nama_proyek' => ['required', 'string', 'max:255'],
            'status_transport' => ['required'],
            'status_order' => ['required'],
            'keterangan' => ['sometimes', 'nullable'],
            'items' => ['required'],
            'jumlah_items' => ['required'],
            'waktus' => ['required'],
            'jumlah_hargas' => ['required']
        ]);

        
        try {
            // Memanggil metode updateOrderwithItem dari model
            $order = Order::updateOrderWithItem($order, $validatedData);

            // Notifikasi berhasil
            Alert::success('Data Order ID: ' . $order->order_id . ' berhasil diedit', 'success');

            // Redirect ke halaman index
            return redirect()->route('dashboard.orders.index');
        } catch (\Exception $e) {
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in editing order data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat mengedit data order. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengedit data order.']);
        }

    }
}

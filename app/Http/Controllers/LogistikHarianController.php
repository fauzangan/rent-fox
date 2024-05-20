<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Logistik;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\LogistikHarian;
use App\Models\StatusLogistik;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class LogistikHarianController extends Controller
{

    public function index(){
        $logistikHarians = LogistikHarian::with('statusLogistik', 'logistik.item', 'order.customer')->get();

        return view('dashboard.logistik-harians.index',[
            'logistik_harians' => $logistikHarians,
        ]);
    }

    public function create(){
        $orders = Order::all();
        $statusLogistiks = StatusLogistik::all();
        
        return view('dashboard.logistik-harians.create',[
            'orders' => $orders,
            'status_logistiks' => $statusLogistiks
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'status_logistik_id' => ['required'],
            'order_id' => ['required'],
            'tanggal_transaksi' => ['required'],
            'keterangan' => ['sometimes', 'nullable'],
            'item_id' => ['required'],
            'baik' => ['required', 'integer'],
            'x_ringan' => ['required', 'integer'],
            'x_berat' => ['required', 'integer'],
            'jumlah_item' => ['required', 'integer'],
        ]);

        // Additional validation for the sum of 'baik', 'x_ringan', 'x_berat'
        Validator::make($request->all(), [
            'baik' => function ($attribute, $value, $fail) use ($request) {
                $jumlah_item = $value + $request->x_ringan + $request->x_berat;
                if ($jumlah_item > $request->jumlah_item) {
                    $fail('Jumlah logistik tidak boleh lebih dari jumlah item yang dipesan.');
                }
            },
        ])->validate();

        try {
            // Memanggil metode createLogistik Harian dari model
            $logistikHarian = LogistikHarian::createLogistikHarian($validatedData);
            // Notifikasi berhasil
            Alert::success('Data logistik harian ID: ' . $logistikHarian->logistik_harian_id . ' berhasil ditambahkan', 'success');

            // Redirect ke halaman index
            return redirect()->route('dashboard.logistik-harians.index');
        } catch (\Exception $e) {
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in storing logistik harian data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat menambahkan data logistik harian. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data logistik harian.']);
        }
    }

    public function edit(LogistikHarian $logistikHarian){
        $orders = Order::all();
        $statusLogistiks = StatusLogistik::all();
        return view('dashboard.logistik-harians.edit', [
            'logistik_harian' => $logistikHarian,
            'status_logistiks' => $statusLogistiks,
            'orders' => $orders,
        ]);
    }

    public function update(Request $request, LogistikHarian $logistikHarian){
        $validatedData = $request->validate([
            'status_logistik_id' => ['required'],
            'order_id' => ['required'],
            'tanggal_transaksi' => ['required'],
            'keterangan' => ['sometimes', 'nullable'],
            'logistik_id' => ['required'],
            'baik' => ['required', 'integer'],
            'x_ringan' => ['required', 'integer'],
            'x_berat' => ['required', 'integer'],
            'jumlah_item' => ['required', 'integer'],
        ]);

        // Additional validation for the sum of 'baik', 'x_ringan', 'x_berat'
        Validator::make($request->all(), [
            'baik' => function ($attribute, $value, $fail) use ($request) {
                $jumlah_item = $value + $request->x_ringan + $request->x_berat;
                if ($jumlah_item > $request->jumlah_item) {
                    $fail('Jumlah logistik tidak boleh lebih dari jumlah item yang dipesan.');
                }
            },
        ])->validate();

        $logistikHarian->updateLogistikHarian($validatedData);
        try {
            // Memanggil metode createLogistik Harian dari model
            // Notifikasi berhasil
            Alert::success('Data logistik harian ID: ' . $logistikHarian->logistik_harian_id . ' berhasil diedit', 'success');

            // Redirect ke halaman index
            return redirect()->route('dashboard.logistik-harians.index');
        } catch (\Exception $e) {
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in editing logistik harian data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat mengedit data logistik harian. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengedit data logistik harian.']);
        }
    }

    public function getLogistikHarian($orderId){
        $logistikHarians = LogistikHarian::with('logistik', 'statusLogistik')->where('order_id', '=', $orderId)->get();
        
        return response()->json($logistikHarians);
    }

    public function getOrder($orderId){
        $order = Order::with('orderItems')->where('order_id', '=', $orderId)->get();
        return response()->json($order);
    }

    public function getOrderItems($orderId){
        $orderItems = OrderItem::with('order')->where('order_id', $orderId)->get();

        return response()->json($orderItems);
    }

    public function getCustomerOrders($customerId){
        $customerOrders = Customer::with('orders.orderItems')->where('customer_id', '=', $customerId)->get();

        return response()->json($customerOrders);
    }
}

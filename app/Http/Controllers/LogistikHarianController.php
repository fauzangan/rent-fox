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
use App\Http\Requests\LogistikHarianFilterRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LogistikHarianController extends Controller
{

    public function index(LogistikHarianFilterRequest $request)
    {
        $logistikHarians = LogistikHarian::query()
            ->with('statusLogistik', 'logistik.item', 'order.customer')
            ->filterByStatusLogistikId($request->input('status_logistik_id'))
            ->filterByOrderId($request->input('order_id'))
            ->filterByItemId($request->input('item_id'))
            ->filterByCustomerId($request->input('customer_id'))
            ->filterByItemName($request->input('nama_item'))
            ->filterByTanggalTransaksi($request->input('tanggal_transaksi'))
            ->orderBy('logistik_harian_id', 'desc')
            ->get();

        $statusLogistiks = StatusLogistik::all();
        return view('dashboard.logistik-harians.index', [
            'logistik_harians' => $logistikHarians,
            'status_logistiks' => $statusLogistiks,
        ]);
    }

    public function create()
    {
        $orders = Order::all();
        $statusLogistiks = StatusLogistik::all();

        return view('dashboard.logistik-harians.create', [
            'orders' => $orders,
            'status_logistiks' => $statusLogistiks
        ]);
    }

    public function store(Request $request)
    {
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

    public function edit(LogistikHarian $logistikHarian)
    {
        $orders = Order::all();
        $statusLogistiks = StatusLogistik::all();
        return view('dashboard.logistik-harians.edit', [
            'logistik_harian' => $logistikHarian,
            'status_logistiks' => $statusLogistiks,
            'orders' => $orders,
        ]);
    }

    public function update(Request $request, LogistikHarian $logistikHarian)
    {
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

    public function getLogistikHarian($orderId)
    {
        $logistikHarians = LogistikHarian::with('logistik', 'statusLogistik')->where('order_id', '=', $orderId)->get();

        return response()->json($logistikHarians);
    }

    public function getOrder($orderId)
    {
        try {
            // Load customer with orders that have status_order_id = 1 and their order items
            $order = Order::with(['orderItems', 'customer.perusahaan'])->where('order_id', '=', $orderId)->first();

            // Return the customer data as JSON
            return response()->json([
                "success" => true,
                "orderItems" => $order->orderItems,
                "customerId" => $order->customer_id,
                "namaCustomer" => $order->customer->nama,
                "badanHukumPerusahaan" => $order->customer->perusahaan->badan_hukum ?? '-',
                "namaPerusahaan" => $order->customer->perusahaan->nama ?? '',
                "proyek" => $order->nama_proyek,
                "alamatKirim" => $order->alamat_kirim
            ]);
        } catch (ModelNotFoundException $e) {
            // Return a 404 response if customer is not found
            return response()->json(["success" => false, 'message' => 'Order tidak ditemukan']);
        } catch (\Exception $e) {
            // Handle any other exceptions
            return response()->json(["success" => false, 'message' => 'Gagam mengambil data order']);
        }
    }

    public function getOrderItems($orderId)
    {
        $orderItems = OrderItem::with('order')->where('order_id', $orderId)->get();

        return response()->json($orderItems);
    }

    public function getCustomerOrders($customerId)
    {
        try {
            // Load customer with orders that have status_order_id = 1 and their order items
            $customer = Customer::with(['orders' => function ($query) {
                $query->where('status_order_id', 1);
            }, 'orders.orderItems'])
                ->where('customer_id', $customerId)
                ->firstOrFail();

            // Return the customer data as JSON
            return response()->json([
                "success" => true,
                "customerOrders" => $customer->orders
            ]);
        } catch (ModelNotFoundException $e) {
            // Return a 404 response if customer is not found
            return response()->json(["success" => false, 'message' => 'Customer tidak ditemukan']);
        } catch (\Exception $e) {
            // Handle any other exceptions
            return response()->json(["success" => false, 'message' => 'Gagam mengambil data status order']);
        }
    }

    public function getPengiriman($orderId)
    {
        // Ambil semua item dari tabel order_items berdasarkan order_id
        $orderItems = OrderItem::where('order_id', $orderId)->get();

        // Buat array untuk menyimpan hasil perhitungan sisa pengiriman per item
        $sisaPengiriman = [];

        // Loop melalui semua item yang dipesan
        foreach ($orderItems as $item) {
            // Jika tidak ada pengiriman sebelumnya, maka jumlah item yang dikirim sesuai dengan pengiriman terbaru
            $totalDikirim = LogistikHarian::where('order_id', $orderId)
                ->where('status_logistik_id', 1)
                ->whereHas('logistik', function ($query) use ($item) {
                    $query->where('item_id', $item->item_id);
                })
                ->sum('jumlah_item');

            // Periksa apakah jumlah item yang sudah dikirim lebih dari jumlah yang dipesan
            $sisa = max(0, $item->jumlah_item - $totalDikirim);

            // Tambahkan hasil perhitungan ke array
            $sisaPengiriman[] = [
                'item_id' => $item->item_id,
                'nama_item' => $item->nama_item,
                'jumlah_dipesan' => $item->jumlah_item,
                'total_dikirim' => $totalDikirim,
                'sisa_pengiriman' => $sisa,
            ];
        }

        return response()->json($sisaPengiriman);
    }
}

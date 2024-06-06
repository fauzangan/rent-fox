<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderFilterRequest;
use DateTime;
use App\Models\Item;
use App\Models\Order;
use App\Models\Customer;
use App\Models\StatusOrder;
use App\Models\StatusTransport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index(OrderFilterRequest $request){
        $orders = Order::query()
            ->with(['customer.perusahaan','statusOrder', 'statusTransport'])
            ->filterByOrderId($request->input('order_id'))
            ->filterByCustomerId($request->input('customer_id'))
            ->filterByCustomerName($request->input('nama'))
            ->filterByPerusahaanName($request->input('perusahaan'))
            ->filterByStatusTransportId($request->input('status_transport_id'))
            ->filterByStatusOrderId($request->input('status_order_id'))
            ->filterByTanggalOrder($request->input('tanggal_order'))
            ->filterByTanggalKirim($request->input('tanggal_kirim'))
            ->orderBy('order_id', 'desc')
            ->paginate(5)
            ->appends($request->except('page'));

        $statusOrders = StatusOrder::all();
        $statusTransports = StatusTransport::all();
        return view('dashboard.orders.index', [
            'orders' => $orders,
            'status_orders' => $statusOrders,
            'status_transports' => $statusTransports,
        ]);
    }

    public function detail(Order $order){
        return view('dashboard.orders.detail', [
            'order' => $order
        ]);
    }

    public function postDiscount(Request $request, Order $order)
    {
        $request->validate([
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        $order->discount = $request->discount;
        $order->biaya_sewa = $order->subtotal - ($order->subtotal * $request->discount / 100);
        $order->biaya_transport_sewa = $order->biaya_transport + $order->biaya_sewa;
        $order->sisa_rental = $order->biaya_transport_sewa - $order->down_payment;
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Discount Sukses di update menjadi '. $order->discount.'% !',
            'discount' => $order->discount
        ]);
    }

    public function postBiayaTransport(Request $request, Order $order)
    {
        $request->validate([
            'biaya_transport' => 'required|numeric|min:0',
        ]);

        $order->biaya_transport = $request->biaya_transport;
        $order->biaya_transport_sewa = $request->biaya_transport + $order->biaya_sewa;
        $order->sisa_rental = $order->biaya_transport_sewa - $order->down_payment;
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Biaya transport sukses di update menjadi '. $order->biaya_transport .'!',
            'biaya_transport' => $order->biaya_transport
        ]);
    }

    public function postDownPayment(Request $request, Order $order)
    {
        $request->validate([
            'down_payment' => ['required', 'numeric', 'min:0', function ($attribute, $value, $fail) use ($order) {
                if ($value > $order->biaya_transport_sewa) {
                    $fail('Down Payment tidak boleh lebih dari biaya sewa + transport.');
                }
            },],
        ]);

        $order->down_payment = $request->down_payment;
        $order->sisa_rental = $order->biaya_transport_sewa - $order->down_payment;
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Down Payment sukses di update menjadi '. $order->biaya_transport .'!',
            'down_payment' => $order->down_payment
        ]);
    }

    public function getOrder(Order $order){
        return response()->json($order);
    }

    public function create(){
        $customers = Customer::with('perusahaan')->get();
        $statusOrders = StatusOrder::all();
        $statusTransports = StatusTransport::all();
        $items = Item::all();
        return view('dashboard.orders.create', [
            'customers' => $customers,
            'items' => $items,
            'status_orders' => $statusOrders,
            'status_transports' => $statusTransports
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'tanggal_order' => ['required', 'string'],
            'tanggal_kirim' => ['required', 'string'],
            'customer_id' => ['required', 'integer'],
            'kirim_kepada' => ['required', 'string', 'max:255'],
            'alamat_kirim' => ['required', 'string'],
            'nama_proyek' => ['required', 'string', 'max:255'],
            'status_transport_id' => ['required', 'integer'],
            'status_order_id' => ['required', 'integer'],
            'keterangan' => ['sometimes', 'nullable', 'string'],
            'memo' => ['sometimes', 'nullable', 'string'],
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
            return redirect()->route('dashboard.orders.detail', ['order' => $order->order_id]);
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
        $statusOrders = StatusOrder::all();
        $statusTransports = StatusTransport::all();
        $items = Item::all();
        $order->load('orderItems');
        return view('dashboard.orders.edit', [
            'order' => $order,
            'items' => $items,
            'customers' => $customers,
            'status_orders' => $statusOrders,
            'status_transports' => $statusTransports
        ]);
    }

    public function update(Request $request, Order $order){
        $validatedData = $request->validate([
            'tanggal_order' => ['required', 'string'],
            'tanggal_kirim' => ['required', 'string'],
            'customer_id' => ['required'],
            'kirim_kepada' => ['required', 'string', 'max:255'],
            'alamat_kirim' => ['required', 'string'],
            'nama_proyek' => ['required', 'string', 'max:255'],
            'status_transport_id' => ['required'],
            'status_order_id' => ['required'],
            'keterangan' => ['sometimes', 'nullable'],
            'memo' => ['sometimes', 'nullable', 'string'],
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
            return redirect()->route('dashboard.orders.detail', ['order' => $order->order_id]);
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

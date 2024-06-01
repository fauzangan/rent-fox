<?php

namespace App\Http\Controllers;

use App\Models\BukuHarian;
use App\Models\Customer;
use App\Models\DataBukuHarian;
use App\Models\GroupBiaya;
use App\Models\Order;
use App\Models\PostingBiaya;
use Illuminate\Http\Request;

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

    public function getCustomerData($customerId){
        $customer = Customer::where('customer_id', $customerId)->with(['perusahaan', 'orders'])->first();

        return response()->json($customer);
    }

    public function store(Request $request){
        dd($request);
    }
}

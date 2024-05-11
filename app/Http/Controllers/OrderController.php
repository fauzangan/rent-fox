<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;

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
}

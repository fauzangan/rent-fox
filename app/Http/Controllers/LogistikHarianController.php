<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class LogistikHarianController extends Controller
{
    public function create(){
        $orders = Order::all();
        return view('dashboard.logistik-harians.create',[
            'orders' => $orders
        ]);
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

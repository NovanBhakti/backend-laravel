<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //save order
    public function saveOrder(Request $request)
    {
        $request->validate([
            'payment_amount' => 'required',
            'sub_total' => 'required',
            'tax' => 'required',
            'discount' => 'required',
            'service_charge' => 'required',
            'total' => 'required',
            'payment_method' => 'required',
            'total_item' => 'required',
            'id_kasir' => 'required',
            'nama_kasir' => 'required',
            'transaction_time' => 'required',
        ]);


        $order = Order::create([
            'payment_amount' => $request->payment_amount,
            'sub_total' => $request->sub_total,
            'tax' => $request->tax,
            'discount' => $request->discount,
            'service_charge' => $request->service_charge,
            'total' => $request->total,
            'payment_method' => $request->payment_method,
            'total_item' => $request->total_item,
            'id_kasir' => $request->id_kasir,
            'nama_kasir' => $request->nama_kasir,
            'transaction_time' => $request->transaction_time,
        ]);

        foreach ($request->order_items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id_product'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => $order,
        ],200);
    }

    //get all orders
    public function index()
    {
        $orders = Order::all();
        return response()->json([
            'status' => 'success',
            'data' => $orders,
        ],200);
    }

    public function getOrderItems($orderId) {
        $orderItems = OrderItem::where('order_id', $orderId)->get(); // Ganti dengan query yang sesuai dengan database Anda
        return response()->json(['status' => 'success',
            'data' => $orderItems], 200);
    }

    public function getOrdersWithItems() {
        $orders = Order::with('items')->get(); // Pastikan Anda telah mengatur relasi di model Order
        return response()->json(['status' => 'success',
        'data' => $orders], 200);
    }
}
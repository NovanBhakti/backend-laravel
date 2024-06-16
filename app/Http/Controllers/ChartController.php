<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function getData(Request $request)
{
    $period = $request->query('period', 'week');
    $timezone = 'Asia/Jakarta'; // Indonesia timezone
    $data = [];

    if ($period === 'week') {
        $startOfWeek = Carbon::now($timezone)->startOfWeek();
        $endOfWeek = Carbon::now($timezone)->endOfWeek();

        $orders = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();

        $data = [
            'Sunday' => 0,
            'Monday' => 0,
            'Tuesday' => 0,
            'Wednesday' => 0,
            'Thursday' => 0,
            'Friday' => 0,
            'Saturday' => 0,
        ];

        foreach ($orders as $order) {
            $day = Carbon::parse($order->created_at)->setTimezone($timezone)->format('l');
            $data[$day]++;
        }
    } elseif ($period === 'month') {
        $startOfMonth = Carbon::now($timezone)->startOfMonth();
        $endOfMonth = Carbon::now($timezone)->endOfMonth();

        for ($i = 1; $i <= $endOfMonth->day; $i++) {
            $data[$i] = 0;
        }

        $orders = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();

        foreach ($orders as $order) {
            $day = Carbon::parse($order->created_at)->setTimezone($timezone)->day;
            $data[$day]++;
        }
    }

    return response()->json($data);
}

     public function getSoldItemsData(Request $request)
    {
        $data = [];

    // Fetch all order items with their associated products
    $orderItems = OrderItem::with('product')
        ->get()
        ->groupBy('product_id');

    // Sum the quantities for each product
    foreach ($orderItems as $itemId => $items) {
        $productName = $items->first()->product->name;
        $data[$productName] = $items->sum('quantity');
    }

    return response()->json($data);
    }

    public function getCategoryData()
    {
        $data = [];

        // Fetch all order items with their associated products and categories
        $orderItems = OrderItem::with('product.category')->get();

        // Group order items by category
        $groupedByCategory = $orderItems->groupBy(function($item) {
            return $item->product->category->name;
        });

        // Sum the quantities for each category
        foreach ($groupedByCategory as $categoryName => $items) {
            $data[$categoryName] = $items->sum('quantity');
        }

        return response()->json($data);
    }

}
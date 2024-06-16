<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    //index
    public function index()
    {
        $discounts = Discount::where('status', 'active')->get();
        return response()->json([
            'status' => 'success',
            'data' => $discounts,
        ],200);
    }
}
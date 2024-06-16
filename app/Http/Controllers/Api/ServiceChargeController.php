<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceCharge;
use Illuminate\Http\Request;

class ServiceChargeController extends Controller
{
    //index
    public function index()
    {
        $tax = ServiceCharge::where('status', 'active')->get();
        return response()->json([
            'status' => 'success',
            'data' => $tax,
        ],200);
    }
}
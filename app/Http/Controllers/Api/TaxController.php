<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
        $tax = tax::where('status', 'active')->get();
        return response()->json([
            'status' => 'success',
            'data' => $tax,
        ],200);
    }
}
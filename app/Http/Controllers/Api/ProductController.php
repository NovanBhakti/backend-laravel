<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //index product
    public function index()
    {
        $product = Product::paginate(10);
        return response()->json([
            'status' => 'success',
            'message' => 'List Data Product',
            'data' => [
                $product
            ]
        ], 200);
    }
}

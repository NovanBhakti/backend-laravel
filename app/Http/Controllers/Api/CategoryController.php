<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //index api
    public function index()
    {
        $category = Category::paginate(10);
        return response()->json([
            'status' => 'success',
            'message' => 'List Data Category',
            'data' =>
                $category

        ], 200);
    }
}

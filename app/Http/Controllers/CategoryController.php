<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //index
    public function index(Request $request)
    {
        $categories = DB::table('categories')->where('name', 'like', '%' . $request->search . '%')->paginate(10);

        return view('pages.category.index', compact('categories'));
    }


    public function store(Request $request)
    {
        $data = $request->all();
        Category::create($data);
        return redirect()->route('category.index');
        // return $request->all();
    }

    public function create()
    {
        return view('pages.category.create');
    }

    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        return view('pages.category.edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $categories = Category::findOrFail($id);

        $categories->update($data);
        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        $user = Category::findOrFail($id);
        $user->delete();
        return redirect()->route('category.index');
    }
}
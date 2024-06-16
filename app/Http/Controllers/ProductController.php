<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //index
    public function index(Request $request)
    {
        $products = Product::paginate(5);
        //search
        if ($request->search) {
            $products = Product::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('price', 'like', '%' . $request->search . '%')
                ->orWhere('stock', 'like', '%' . $request->search . '%')
                ->orWhere('category_id', 'like', '%' . $request->search . '%')
                ->paginate(5);
        }
        return view('pages.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.product.create', compact('categories'));
    }
    //store
    public function store(Request $request)
    {
        // $filename = time() . '.' . $request->image->extension();
        // $request->image->storeAs('public/products', $filename);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required',
            'is_available' => 'required|boolean',
            'is_favorite' => 'required|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price =  $request->price;
        $product->category_id = $request->category_id;
        $product->stock =  $request->stock;
        $product->is_available =  $request->is_available;
        $product->is_favorite =  $request->is_favorite;
        $product->save();

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image->storeAs('public/products', $product->id .  '.' . $image->getClientOriginalExtension());
            $product->image = 'storage/products/' . $product->id . '.' . $image->getClientOriginalExtension();
            $product->save();
        }
        return redirect()->route('product.index');
    }

    //edit
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('pages.product.edit', compact('product', 'categories'));
    }

    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required',
            'is_available' => 'required|boolean',
            'is_favorite' => 'required|boolean',
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price =  $request->price;
        $product->category_id = $request->category_id;
        $product->stock =  $request->stock;
        $product->is_available =  $request->is_available;
        $product->is_favorite =  $request->is_favorite;
        $product->save();

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image->storeAs('public/products', $product->id . '.' . $image->getClientOriginalExtension());
            $product->image = 'storage/products/' . $product->id . '.' . $image->getClientOriginalExtension();
            $product->save();
        }
        return redirect()->route('product.index');
    }

    //destroy
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index');
    }
}
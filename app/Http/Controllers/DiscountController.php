<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DiscountController extends Controller
{
    //index
    public function index(Request $request)
    {
        $discounts = Discount::paginate(5);
        //search
        if ($request->search) {
            $discounts = Discount::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->orWhere('value', 'like', '%' . $request->search . '%')
                ->orWhere('status', 'like', '%' . $request->search . '%')
                ->paginate(5);
        }
        return view('pages.discount.index', compact('discounts'));
    }
    //store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'type' => 'required',
            'value' => 'required',
            'status' => 'required',
        ]);
        $discount = new Discount();
        $discount->name = $request->name;
        $discount->description = $request->description;
        $discount->type =  $request->type;
        $discount->value =  $request->value;
        $discount->status =  $request->status;
        $discount->save();
        return redirect()->route('discount.index');
        Log::info($discount);
    }
    //create
    public function create()
    {
        return view('pages.discount.create');
    }

    public function edit($id)
    {
        $discounts = Discount::findOrFail($id);
        return view('pages.discount.edit', compact('discounts'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $discounts = Discount::findOrFail($id);

        $discounts->update($data);
        return redirect()->route('discount.index');
    }

    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();
        return redirect()->route('discount.index');
    }

}
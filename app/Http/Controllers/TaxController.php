<?php

namespace App\Http\Controllers;

use App\Models\tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    //index
    public function index()
    {
        $taxes = Tax::paginate(5);
        if (request()->search) {
            $taxes = Tax::where('name', 'like', '%' . request()->search . '%')
                ->orWhere('value', 'like', '%' . request()->search . '%')
                ->orWhere('status', 'like', '%' . request()->search . '%')
                ->paginate(5);
        }
        return view('pages.tax.index', compact('taxes'));
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'value' => 'required',
            'status' => 'required',
        ]);
        $tax = new Tax();
        $tax->name = $request->name;
        $tax->value = $request->value;
        $tax->status = $request->status;
        $tax->save();
        return redirect()->route('tax.index');
    }
    //create
    public function create()
    {
        return view('pages.tax.create');
    }

    public function edit($id)
    {
        $taxes = Tax::findOrFail($id);
        return view('pages.tax.edit', compact('taxes'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $taxes = Tax::findOrFail($id);
        $taxes->update($data);
        return redirect()->route('tax.index');
    }

    public function destroy($id)
    {
        $taxes = Tax::findOrFail($id);
        $taxes->delete();
        return redirect()->route('tax.index');
    }
}
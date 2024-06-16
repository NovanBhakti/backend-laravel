<?php

namespace App\Http\Controllers;

use App\Models\ServiceCharge;
use Illuminate\Http\Request;

class ServiceChargeController extends Controller
{
    //index
    public function index(){
        $serviceCharges = ServiceCharge::paginate(5);
        if(request()->search){
            $serviceCharges = ServiceCharge::where('name', 'like', '%' . request()->search . '%')
                ->orWhere('value', 'like', '%' . request()->search . '%')
                ->orWhere('status', 'like', '%' . request()->search . '%')
                ->paginate(5);
        }
        return view('pages.service.index', compact('serviceCharges'));
    }

    //store
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'value' => 'required',
            'status' => 'required',
        ]);
        $serviceCharge = new ServiceCharge();
        $serviceCharge->name = $request->name;
        $serviceCharge->value = $request->value;
        $serviceCharge->status = $request->status;
        $serviceCharge->save();
        return redirect()->route('service.index');
    }
    //create
    public function create(){
        return view('pages.service.create');
    }
    //edit
    public function edit($id){
        $serviceCharges = ServiceCharge::findOrFail($id);
        return view('pages.service.edit', compact('serviceCharges'));
    }
    //update
    public function update(Request $request, $id){
        $data = $request->all();
        $serviceCharges = ServiceCharge::findOrFail($id);
        $serviceCharges->update($data);
        return redirect()->route('service.index');
    }
    //destroy
    public function destroy($id){
        $serviceCharges = ServiceCharge::findOrFail($id);
        $serviceCharges->delete();
        return redirect()->route('service.index');
    }
}
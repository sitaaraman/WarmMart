<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Admin\Product;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customers.index');
    }
    public function create()
    {
        return view('customers.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        $filename = null;

        if($request->hasFile('profile')){
            $file = $request->file('profile');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('profiles'), $filename);
            // $request['profile'] = $filename;
        } 
        // else {
        //     $request['profile'] = null;
        // }
        
        // dd ($request->all());

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'profile' => $filename,
            'password' => $request->password,
        ]);

        // dd ($customer);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        // dd ($customer);
        return view('customers.show', compact('customer'));
    }
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $customer = Customer::findOrFail($id);
        // $customer['profile'] = $request['old_profile'];
        $filename = $customer->old_profile;

        if($request->hasFile('profile')){
            $file = $request->file('profile');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('profiles'), $filename);
            // $request['profile'] = $filename;
        } 
        // else {<input type="hidden" name="old_profile" value="{{ $customer->profile }}">
        //     $request['profile'] = $request['old_profile'];
        // }

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'profile' => $filename,
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}

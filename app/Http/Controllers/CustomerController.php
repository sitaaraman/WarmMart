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
            'profile' => 'nullable|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($request->hasFile('profile')){
            $file = $request->file('profile');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('profiles'), $filename);
            $request['profile'] = $filename;
        } else {
            $request['profile'] = null;
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'profile' => $request->profile,
            'password' => $request->password,
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
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
            'profile' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $customer = Customer::findOrFail($id);
        // $customer['profile'] = $request['old_profile'];

        if($request->hasFile('profile')){
            $file = $request->file('profile');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('profiles'), $filename);
            $customer['profile'] = $filename;
        } else {
            $customer['profile'] = $request['old_profile'];
        }

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'profile' => $request->profile,
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

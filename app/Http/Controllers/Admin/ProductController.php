<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index');
    }

    public function create()
    {
        return view('admin.products.create');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'price' => 'required|numeric',
    //         'stock' => 'required|integer',
    //         'image' => 'nullable|array',
    //     ]);

    //     $product = Product::create([
    //         'name' => $request->name,
    //         'description' => $request->description,
    //         'price' => $request->price,
    //         'stock' => $request->stock,
    //         'image' => $request->image,
    //     ]);

    //     return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        // dd($request->all());
        $imageNames = [];

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('products'), $filename);
                $imageNames[] = $filename;
            }
        }

        $product = Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'image'       => json_encode($imageNames),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        $images = json_decode($product->image, true) ?? [];

        return view('admin.products.show', compact('product', 'images'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $images = json_decode($product->image, true) ?? [];

        return view('admin.products.edit', compact('product', 'images'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'remove_images' => 'nullable|array',
        ]);

        $product = Product::findOrFail($id);

        $existingImages = json_decode($product->image, true) ?? [];

        if($request->has('remove_images')) {
            foreach ($request->remove_images as $image) {
                if (($key = array_search($image, $existingImages)) !== false) {
                    unset($existingImages[$key]);
                    // Optionally delete the image file from storage
                    $imagePath = public_path('products/' . $image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }
            $existingImages = array_values($existingImages);
        }

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('products'), $filename);
                $existingImages[] = $filename;
            }
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => json_encode($existingImages),
        ]);

        return redirect()->route('admin.products.show', $product->id)
                         ->with('success', 'Product updated successfully.');

    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}

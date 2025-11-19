@extends('layouts.app')

@section('title', 'Product Details')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Product Details</h4>
        </div>

        <div class="card-body">

            <h4>{{ $product->name }}</h4>
            <p class="text-muted">{{ $product->description }}</p>

            <div class="mb-3">
                <strong>Price:</strong>
                <span class="badge bg-success">${{ number_format($product->price, 2) }}</span>
            </div>

            <div class="mb-3">
                <strong>Stock:</strong>
                <span class="badge bg-info">{{ $product->stock }}</span>
            </div>

            <hr>

            <h5>Product Images</h5>

            @if ($images && count($images) > 0)
                <div class="row">
                    @foreach ($images as $img)
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm">
                                <img 
                                    src="{{ asset('products/' . $img) }}" 
                                    class="card-img-top" 
                                    style="height: 180px; object-fit: cover;"
                                >
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">No images available.</p>
            @endif
            
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary mt-3">Edit Product</a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mt-3">Back to Products</a>

        </div>
    </div>

</div>

@endsection

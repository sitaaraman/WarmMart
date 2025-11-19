@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Edit Product</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3">{{ $product->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" name="price" value="{{ $product->price }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" class="form-control" name="stock" value="{{ $product->stock }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload New Images</label>
                    <input type="file" class="form-control" name="image[]" accept="image/*" multiple>
                    <small class="text-muted">You can select multiple images.</small>
                </div>

                <hr>

                <h5>Existing Images</h5>
                @if($images && count($images) > 0)
                    <div class="row">
                        @foreach($images as $img)
                            <div class="col-md-3 mb-3 text-center">
                                <div class="card shadow-sm">
                                    <img src="{{ asset('products/' . $img) }}" class="card-img-top" style="height:150px; object-fit:cover;">
                                    <div class="card-body p-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remove_images[]" value="{{ $img }}" id="remove_{{ $loop->index }}">
                                            <label class="form-check-label small" for="remove_{{ $loop->index }}">Remove</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No images available.</p>
                @endif

                <button type="submit" class="btn btn-primary mt-3">Update Product</button>
                <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-secondary mt-3">Cancel</a>

            </form>

        </div>
    </div>

</div>

@endsection

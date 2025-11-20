@extends('layouts.app')

@section('title', 'Index')

@section('content')

    <h3>Product List Index</h3>

    <div class="container">
        @foreach ($products as $p)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $p->name }}</h5>
                    <p class="card-text">{{ $p->description }}</p> 
                    <p class="card-text"><strong>Price:</strong> ${{ $p->price }}</p>
                </div>
            </div>

            <h5>Product Images</h5>

            @php
                $images = $p->image;
                if (is_string($images)) {
                    $images = json_decode($images, true) ?? [];
                }
            @endphp

            @if (!empty($images) && count($images) > 0)
                <div class="row">
                    @foreach ($images as $img)
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm">
                                <img 
                                    src="{{ asset('products/' . $img)  }}" 
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
        @endforeach
    </div>

@endsection
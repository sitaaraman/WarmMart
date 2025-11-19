@extends('layouts.app')

@section('title', 'Show')

@section('content')

    <h3 class="text-center py-0 m-0">Customer Detail</h3>
    <div class="container mt-4">
        <div class="card" style="width: 18rem;">
            <img src="{{ asset('profiles/' . $customer->profile) }}" class="card-img-top" alt="Profile Image">
            <div class="card-body">
                <h5 class="card-title">{{ $customer->name }}</h5>
                <p class="card-text"><strong>Email:</strong> {{ $customer->email }}</p>
                <p class="card-text"><strong>Phone:</strong> {{ $customer->phone }}</p>
                <p class="card-text"><strong>Address:</strong> {{ $customer->address }}</p>
                <a href="{{ route('customers.index') }}" class="btn btn-primary">Back to List</a>
            </div>  
        </div>
    </div>

@endsection
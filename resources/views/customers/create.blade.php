@extends('layouts.app')

@section('title', 'Create')

@section('content')

    <h3>Customer Create Page</h3>

    <div class="container">
        <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            @error('name')
                <span class="errorSpan">
                        {{ $message }}
                </span>
            @enderror
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            @error('email')
                <span class="errorSpan">
                        {{ $message }}
                </span>
            @enderror
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            @error('phone')
                <span class="errorSpan">
                        {{ $message }}
                </span>
            @enderror
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            @error('address')
                <span class="errorSpan">
                        {{ $message }}
                </span>
            @enderror
            <div class="mb-3">
                <label for="profile" class="form-label">Profile</label>
                <input type="file" class="form-control" id="profile" name="profile" accept="img/*" required>
            </div>
            @error('profile')
                <span class="errorSpan">
                        {{ $message }}
                </span>
            @enderror
            <div class="mb-3">
                <label for="country" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            @error('password')
                <span class="errorSpan">
                        {{ $message }}
                </span>
            @enderror
            <div class="mb-3">
                <label for="country" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            @error('password_confirmation')
                <span class="errorSpan">
                        {{ $message }}
                </span>
            @enderror
            <button type="submit" class="btn btn-primary">Create Account</button>
        </form>
    </div>

    <div class="mt-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif 
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

@endsection
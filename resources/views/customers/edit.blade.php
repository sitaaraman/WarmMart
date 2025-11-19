@extends('layouts.app')

@section('title', 'Edit')

@section('content')

    <h3>Customer Edit Page</h3>

    <div class="container">
        <form action="{{ route('customers.update', [$customer->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf 
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $customer->address }}">
            </div>
            <div class="mb-3">
                <label for="profile" class="form-label">Current Profile</label>
                <img src="{{ asset('profiles/' . $customer->profile) }}" alt="Current Profile" width="100" class="d-block mb-2">
            </div>
            <div class="mb-3">
                <label for="profile" class="form-label">Upload New Profile</label>
                <input type="file" class="form-control" id="profile" name="profile" accept="img/*" value="{{ $customer->profile }}">
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ $customer->password }}">
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{ $customer->password }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Info</button>
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
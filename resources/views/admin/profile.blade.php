@extends('admin.layout.app')
@section('main-content')

<div class="container mt-4">
    <h4 class="mb-4">User Profile</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="row g-3 mb-4">
        @csrf
        <div class="col-md-6">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" value="{{ $user->first_name }}" class="form-control" required>
            {{-- <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required> --}}
        </div>
        <div class="col-md-6">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" value="{{ $user->last_name }}" class="form-control" required>
            {{-- <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required> --}}
        </div>
        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
            {{-- <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required> --}}
        </div>
        <div class="col-md-6">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" required>
            {{-- <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required> --}}
        </div>
        <div class="col-md-6">
            <label class="form-label">Profile Picture</label>
            <input type="file" name="profile_image" class="form-control">
            @if (!empty($user->profile_image))
                <img src="{{ asset($user->profile_image) }}" width="60" class="mt-2 rounded-circle">
            @endif
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </div>
    </form>

    <h5 class="mt-5">Change Password</h5>
    <form action="{{ route('profile.changePassword') }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-6">
            <label class="form-label">Current Password</label>
            <input type="password" name="current_password" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">New Password</label>
            <input type="password" name="new_password" class="form-control" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-warning">Change Password</button>
        </div>
    </form>
</div>
@endsection

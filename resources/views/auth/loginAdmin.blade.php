@extends('auth.index')
@section('content')
    <h3 class="text-center">Đăng nhập Admin</h3>
    <form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="hidden" name="loginAdmin" value="1">
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
        <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
    </div>
    </form>
@endsection

@extends('auth.index')
@section('content')
    <h3 class="text-center">Đăng ký</h3>
    <form method="POST" action="{{ route('register') }}">
    @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên người dùng</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" >
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" >
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
            <a href="">Đăng nhập</a>
        </div>
    </form>
@endsection

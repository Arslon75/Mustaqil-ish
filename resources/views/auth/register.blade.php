@extends('layouts.main')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card auth-card">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4">Hisob Yaratish</h3>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Ism</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Elektron pochta manzili</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Parol</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                       required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Parolni tasdiqlang</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-custom w-100 mb-3">Ro'yxatdan o'tish</button>
                            <div class="text-center">
                                <a href="{{ route('login') }}" class="text-decoration-none">Allaqachon hisobingiz bormi? Kirish</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

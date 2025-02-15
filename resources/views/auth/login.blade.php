@extends('layouts.main')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card auth-card">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4">Xush kelibsiz!</h3>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
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
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                <label class="form-check-label" for="remember">Meni eslab qolish</label>
                            </div>
                            <button type="submit" class="btn btn-custom w-100 mb-3">Kirish</button>
                            <div class="text-center">
                                <a href="{{ route('register') }}" class="text-decoration-none">Hisobingiz yo'qmi? Ro'yxatdan o'ting</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('auth.layout')
@section('title', 'Login')
@section('content')

    <section class="auth">
        <div class="row">
            <div class="col-md-4 head text-center">
                <h2>Laravel 10</h2>
                <h3>Create Your Account</h3>
                <h5>Signup to create, discover and connect with the global community</h5>
            </div>
            <div class="col-md-8 form">
                <h3>Sign in to Your Account</h3>
                <h5>Sign in to create, discover and connect with the global community</h5>
                @include('shared.messages')
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="credential" class="form-label">Phone/Email</label>
                        <input type="text" id="credential" name="credential"
                               class="form-control @error('credential') is-invalid @endError" value="{{ old('credential') }}"
                               placeholder="Enter your phone/Email">
                        @error('credential')
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password"
                               class="form-control @error('password') is-invalid @endError"
                               placeholder="Enter your password">
                        @error('password')
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="remember" name="remember" value="1">
                        <label for="remember" class="form-check-label">Remember me</label>
                        @error('remember')
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button>Sign in</button>
                </form>
            </div>
        </div>
    </section>

@endsection

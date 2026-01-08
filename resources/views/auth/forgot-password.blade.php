<x-shop-layout>
    <div class="container d-flex align-items-center justify-content-center flex-grow-1 py-5">
        <div class="card border-0 shadow-sm bg-white rounded-4" style="max-width: 420px; width: 100%;">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <!-- Key Icon -->
                    <div class="mb-3 d-inline-flex align-items-center justify-content-center bg-black text-white rounded-circle" style="width: 56px; height: 56px;">
                        <i class="bi bi-key-fill fs-4"></i>
                    </div>
                    <h4 class="fw-bold mb-1 ls-1" style="font-family: 'Instrument Sans', sans-serif;">Forgot Password?</h4>
                    <p class="text-muted small ls-1 mb-0 px-2">Enter your email for reset instructions</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success border-0 bg-success-subtle text-success small mb-3 rounded-3 py-2 text-center">
                        <i class="bi bi-check-circle me-2"></i> {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-floating mb-4">
                        <input type="email" class="form-control border-0 border-bottom rounded-0 px-0 shadow-none bg-transparent" 
                               id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@example.com"
                               style="border-bottom: 1.5px solid #eee !important; height: 50px;">
                        <label for="email" class="text-muted px-0">Email Address</label>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-black bg-black text-white rounded-pill py-2.5 fw-bold text-uppercase ls-1 hover-scale transition text-sm">
                            Send Reset Link
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-black fw-bold text-decoration-none small d-inline-flex align-items-center hover-text-black transition">
                            <i class="bi bi-arrow-left me-2"></i> Back to Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: #000;
            transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
        }
        .form-control:focus {
            border-bottom-color: #000 !important;
        }
        .hover-scale:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .hover-text-black:hover { color: #555 !important; }
        .ls-1 { letter-spacing: 1px; }
        .btn-black:hover { background-color: #222 !important; }
    </style>
</x-shop-layout>

<x-shop-layout>
    <div class="container d-flex align-items-center justify-content-center flex-grow-1 py-3">
        <div class="card border-0 shadow-sm bg-white rounded-4" style="max-width: 420px; width: 100%;">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <!-- Shopping Bag Icon -->
                    <div class="mb-3 d-inline-flex align-items-center justify-content-center bg-black text-white rounded-circle" style="width: 56px; height: 56px;">
                        <i class="bi bi-bag-fill fs-4"></i>
                    </div>
                    <h4 class="fw-bold mb-1 ls-1" style="font-family: 'Instrument Sans', sans-serif;">Welcome Back</h4>
                    <p class="text-muted small text-uppercase ls-1 mb-0">Please sign in to continue</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success border-0 bg-success-subtle text-success small mb-3 rounded-3 py-2 text-center">
                        <i class="bi bi-check-circle me-2"></i> {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control border-0 border-bottom rounded-0 px-0 shadow-none bg-transparent" 
                               id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@example.com"
                               style="border-bottom: 1.5px solid #eee !important; height: 50px;">
                        <label for="email" class="text-muted px-0">Email Address</label>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control border-0 border-bottom rounded-0 px-0 shadow-none bg-transparent" 
                               id="password" name="password" required autocomplete="current-password" placeholder="Password"
                               style="border-bottom: 1.5px solid #eee !important; height: 50px;">
                        <label for="password" class="text-muted px-0">Password</label>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input rounded-0 bg-transparent border-secondary" type="checkbox" name="remember" id="remember_me">
                            <label class="form-check-label text-secondary small" for="remember_me">Remember me</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-decoration-none small text-black fw-medium ls-1" style="font-size: 0.75rem;">
                                FORGOT PASSWORD?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-black bg-black text-white rounded-pill py-2.5 fw-bold text-uppercase ls-1 hover-scale transition text-sm">
                            Sign In
                        </button>
                    </div>

                    <!-- Divider -->
                    <div class="position-relative text-center mb-4">
                        <hr class="border-secondary opacity-10 my-0">
                        <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small" style="font-size: 0.7rem;">OR</span>
                    </div>

                    <!-- Google Login -->
                    <div class="d-grid text-center">
                        <a href="{{ route('auth.google') }}" class="text-decoration-none text-secondary small hover-text-black transition">
                            <i class="bi bi-google me-2"></i> Continue with Google
                        </a>
                    </div>

                    <div class="text-center mt-4">
                        <p class="text-muted small mb-0">
                            Not a member? 
                            <a href="{{ route('register') }}" class="text-black fw-bold text-decoration-none ms-1 border-bottom border-black pb-0_5">Register Now</a>
                        </p>
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
        .pb-0_5 { padding-bottom: 2px; }
        .hover-scale:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .hover-text-black:hover { color: #000 !important; }
        .ls-1 { letter-spacing: 1px; }
        .btn-black:hover { background-color: #222 !important; }
    </style>
</x-shop-layout>

<x-shop-layout>
    <div class="container d-flex align-items-center justify-content-center flex-grow-1 py-5">
        <div class="card border-0 shadow-sm bg-white rounded-4" style="max-width: 420px; width: 100%;">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <!-- Person Icon -->
                    <div class="mb-3 d-inline-flex align-items-center justify-content-center bg-black text-white rounded-circle" style="width: 56px; height: 56px;">
                        <i class="bi bi-person-plus-fill fs-4"></i>
                    </div>
                    <h4 class="fw-bold mb-1 ls-1" style="font-family: 'Instrument Sans', sans-serif;">Create Account</h4>
                    <p class="text-muted small text-uppercase ls-1 mb-0">Join for exclusive offers</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control border-0 border-bottom rounded-0 px-0 shadow-none bg-transparent" 
                               id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Name"
                               style="border-bottom: 1.5px solid #eee !important; height: 50px;">
                        <label for="name" class="text-muted px-0">Full Name</label>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control border-0 border-bottom rounded-0 px-0 shadow-none bg-transparent" 
                               id="email" name="email" value="{{ old('email') }}" required placeholder="name@example.com"
                               style="border-bottom: 1.5px solid #eee !important; height: 50px;">
                        <label for="email" class="text-muted px-0">Email Address</label>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control border-0 border-bottom rounded-0 px-0 shadow-none bg-transparent" 
                               id="password" name="password" required autocomplete="new-password" placeholder="Password"
                               style="border-bottom: 1.5px solid #eee !important; height: 50px;">
                        <label for="password" class="text-muted px-0">Password</label>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control border-0 border-bottom rounded-0 px-0 shadow-none bg-transparent" 
                               id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password"
                               style="border-bottom: 1.5px solid #eee !important; height: 50px;">
                        <label for="password_confirmation" class="text-muted px-0">Confirm Password</label>
                        @error('password_confirmation')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-black bg-black text-white rounded-pill py-2.5 fw-bold text-uppercase ls-1 hover-scale transition text-sm">
                            Create Account
                        </button>
                    </div>

                    <!-- Divider -->
                    <div class="position-relative text-center mb-4">
                        <hr class="border-secondary opacity-10 my-0">
                        <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small" style="font-size: 0.7rem;">OR</span>
                    </div>

                    <!-- Google Login -->
                    <div class="d-grid text-center mb-4">
                        <a href="{{ route('auth.google') }}" class="text-decoration-none text-secondary small hover-text-black transition">
                            <i class="bi bi-google me-2"></i> Register with Google
                        </a>
                    </div>

                    <div class="text-center mt-3">
                        <p class="text-muted small mb-0">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="text-black fw-bold text-decoration-none ms-1 border-bottom border-black pb-0_5">Sign In</a>
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

<header class="sticky-top border-bottom" style="background-color: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
    <nav class="navbar navbar-expand-lg py-3">
        <div class="container-xl px-4">
            <div class="d-flex align-items-center justify-content-between w-100">
                
                <!-- Logo -->
                <a href="{{ route('shop.index') }}" class="d-flex align-items-center gap-2 text-decoration-none text-dark">
                    <i class="bi bi-bag-fill fs-4"></i>
                    <span class="fw-bold fs-5 tracking-tight ls-1">JUALIN AJA</span>
                </a>

                <!-- Actions -->
                <div class="d-flex align-items-center gap-3">
                    <!-- Search (Desktop) -->
                    <div class="d-none d-lg-block position-relative" style="width: 280px;">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <input type="text" class="form-control bg-light border-0 ps-5 rounded-0 py-2" placeholder="Search products..." style="font-size: 0.9rem;">
                    </div>

                    <!-- Mobile Search Toggle -->
                    <button class="btn btn-link text-dark d-lg-none p-2">
                        <i class="bi bi-search fs-5"></i>
                    </button>

                    @auth
                        <!-- Cart -->
                        <a href="{{ route('cart.index') }}" class="btn btn-link text-dark p-2">
                            <div class="position-relative d-inline-block">
                                <i class="bi bi-bag fs-5"></i>
                                @if(Auth::user()->cart && Auth::user()->cart->items->count() > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-black border border-light rounded-circle" style="width: 10px; height: 10px; margin-top: 2px; margin-left: -2px;"></span>
                                @endif
                            </div>
                        </a>

                        <!-- User Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-link text-dark text-decoration-none fw-medium dropdown-toggle p-0 ps-2 text-uppercase small ls-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Str::limit(Auth::user()->name, 10) }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border border-light shadow-sm mt-3 rounded-0 p-0 overflow-hidden">
                                @if(Auth::user()->isAdmin())
                                    <li><a class="dropdown-item py-2 small" href="/admin">Dashboard</a></li>
                                @endif
                                <li><a class="dropdown-item py-2 small" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li><a class="dropdown-item py-2 small" href="{{ route('transaction.history') }}">Order History</a></li>
                                <li><hr class="dropdown-divider my-0"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 small text-danger">Log Out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="vr mx-2 d-none d-sm-block"></div>
                        <a href="{{ route('login') }}" class="btn btn-link text-dark text-decoration-none fw-bold text-uppercase small ls-1">Log In</a>
                        <a href="{{ route('register') }}" class="btn btn-black rounded-0 px-4 fw-bold text-uppercase small ls-1">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>

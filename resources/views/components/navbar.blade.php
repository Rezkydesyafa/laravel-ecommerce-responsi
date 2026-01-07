<header class="sticky-top border-bottom" style="background-color: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
    <nav class="navbar navbar-expand-lg py-3">
        <div class="container-xl px-4">
            <div class="d-flex align-items-center justify-content-between w-100">
                
                <!-- Logo -->
                <a href="{{ route('shop.index') }}" class="d-flex align-items-center gap-2 text-decoration-none text-dark">
                    <i class="bi bi-bag fs-4"></i>
                    <span class="fw-semibold fs-5 tracking-tight" style="letter-spacing: -0.5px;">Jualin Aja</span>
                </a>

                <!-- Actions -->
                <div class="d-flex align-items-center gap-3">
                    <!-- Search (Desktop) -->
                    <div class="d-none d-lg-block position-relative" style="width: 280px;">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <input type="text" class="form-control bg-light border-0 ps-5 rounded-3 py-2" placeholder="Search products...">
                    </div>

                    <!-- Mobile Search Toggle -->
                    <button class="btn btn-link text-dark d-lg-none p-2">
                        <i class="bi bi-search fs-5"></i>
                    </button>

                    @auth
                        <!-- Cart -->
                        <!-- Cart -->
                        <a href="{{ route('cart.index') }}" class="btn btn-link text-dark p-2">
                            <div class="position-relative d-inline-block">
                                <i class="bi bi-cart fs-5"></i>
                                @if(Auth::user()->cart && Auth::user()->cart->items->count() > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-black border border-light rounded-circle" style="width: 10px; height: 10px; margin-top: 2px; margin-left: -2px;"></span>
                                @endif
                            </div>
                        </a>

                        <!-- User Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-link text-dark text-decoration-none fw-medium dropdown-toggle p-0 ps-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Str::limit(Auth::user()->name, 10) }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-3 rounded-3 p-2">
                                @if(Auth::user()->isAdmin())
                                    <li><a class="dropdown-item rounded-2" href="/admin">Dashboard</a></li>
                                @endif
                                <li><a class="dropdown-item rounded-2" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item rounded-2 text-danger">Log Out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="vr mx-2 d-none d-sm-block"></div>
                        <a href="{{ route('login') }}" class="btn btn-link text-dark text-decoration-none fw-medium text-sm">Log In</a>
                        <a href="{{ route('register') }}" class="btn btn-dark rounded-pill px-4 fw-medium text-sm" style="font-size: 0.9rem;">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>

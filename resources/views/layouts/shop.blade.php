<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LuxeStore') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&display=swap" rel="stylesheet">
    
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1" rel="stylesheet" />

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Manrope', sans-serif;
            background-color: #f6f7f8;
            color: #101922;
        }
        
        .header-sticky {
            position: sticky;
            top: 0;
            z-index: 1020;
            background-color: white;
            border-bottom: 1px solid #e2e8f0;
        }

        .text-primary-custom {
            color: #3994ef;
        }
        
        .bg-primary-custom {
            background-color: #3994ef;
        }

        .btn-primary-custom {
            background-color: #3994ef;
            color: white;
            border: none;
        }
        
        .btn-primary-custom:hover {
            background-color: #2b7ac9;
            color: white;
        }

        /* Navbar Search */
        .search-container {
            position: relative;
        }
        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }
        .search-input {
            padding-left: 45px;
            padding-right: 15px;
            padding-top: 10px;
            padding-bottom: 10px;
            border-radius: 50px;
            background-color: #f1f5f9;
            border: none;
            width: 100%;
        }
        .search-input:focus {
            background-color: white;
            box-shadow: 0 0 0 2px #3994ef;
            outline: none;
        }

        .nav-link-custom {
            color: #334155;
            font-weight: 600;
            text-decoration: none;
        }
        .nav-link-custom:hover {
            color: #3994ef;
        }

        /* Footer */
        footer {
            background-color: white;
            border-top: 1px solid #e2e8f0;
            margin-top: auto;
        }
        
        /* Dropdown custom */
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-radius: 0.75rem;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <header class="header-sticky">
        <div class="container-xl px-4 px-lg-5">
            <div class="d-flex align-items-center justify-content-between py-3 gap-4">
                <!-- Logo -->
                <a href="{{ route('shop.index') }}" class="d-flex align-items-center gap-2 text-decoration-none text-dark">
                    <div class="d-flex align-items-center justify-content-center text-primary-custom" style="width: 32px; height: 32px;">
                        <svg class="w-100 h-100" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M42.1739 20.1739L27.8261 5.82609C29.1366 7.13663 28.3989 10.1876 26.2002 13.7654C24.8538 15.9564 22.9595 18.3449 20.6522 20.6522C18.3449 22.9595 15.9564 24.8538 13.7654 26.2002C10.1876 28.3989 7.13663 29.1366 5.82609 27.8261L20.1739 42.1739C21.4845 43.4845 24.5355 42.7467 28.1133 40.548C30.3042 39.2016 32.6927 37.3073 35 35C37.3073 32.6927 39.2016 30.3042 40.548 28.1133C42.7467 24.5355 43.4845 21.4845 42.1739 20.1739Z" fill="currentColor"></path>
                            <path clip-rule="evenodd" d="M7.24189 26.4066C7.31369 26.4411 7.64204 26.5637 8.52504 26.3738C9.59462 26.1438 11.0343 25.5311 12.7183 24.4963C14.7583 23.2426 17.0256 21.4503 19.238 19.238C21.4503 17.0256 23.2426 14.7583 24.4963 12.7183C25.5311 11.0343 26.1438 9.59463 26.3738 8.52504C26.5637 7.64204 26.4411 7.31369 26.4066 7.24189C26.345 7.21246 26.143 7.14535 25.6664 7.1918C24.9745 7.25925 23.9954 7.5498 22.7699 8.14278C20.3369 9.32007 17.3369 11.4915 14.4142 14.4142C11.4915 17.3369 9.32007 20.3369 8.14278 22.7699C7.5498 23.9954 7.25925 24.9745 7.1918 25.6664C7.14534 26.143 7.21246 26.345 7.24189 26.4066ZM29.9001 10.7285C29.4519 12.0322 28.7617 13.4172 27.9042 14.8126C26.465 17.1544 24.4686 19.6641 22.0664 22.0664C19.6641 24.4686 17.1544 26.465 14.8126 27.9042C13.4172 28.7617 12.0322 29.4519 10.7285 29.9001L21.5754 40.747C21.6001 40.7606 21.8995 40.931 22.8729 40.7217C23.9424 40.4916 25.3821 39.879 27.0661 38.8441C29.1062 37.5904 31.3734 35.7982 33.5858 33.5858C35.7982 31.3734 37.5904 29.1062 38.8441 27.0661C39.879 25.3821 40.4916 23.9425 40.7216 22.8729C40.931 21.8995 40.7606 21.6001 40.747 21.5754L29.9001 10.7285ZM29.2403 4.41187L43.5881 18.7597C44.9757 20.1473 44.9743 22.1235 44.6322 23.7139C44.2714 25.3919 43.4158 27.2666 42.252 29.1604C40.8128 31.5022 38.8165 34.012 36.4142 36.4142C34.012 38.8165 31.5022 40.8128 29.1604 42.252C27.2666 43.4158 25.3919 44.2714 23.7139 44.6322C22.1235 44.9743 20.1473 44.9757 18.7597 43.5881L4.41187 29.2403C3.29027 28.1187 3.08209 26.5973 3.21067 25.2783C3.34099 23.9415 3.8369 22.4852 4.54214 21.0277C5.96129 18.0948 8.43335 14.7382 11.5858 11.5858C14.7382 8.43335 18.0948 5.9613 21.0277 4.54214C22.4852 3.8369 23.9415 3.34099 25.2783 3.21067C26.5973 3.08209 28.1187 3.29028 29.2403 4.41187Z" fill="currentColor" fill-rule="evenodd"></path>
                        </svg>
                    </div>
                    <span class="fs-4 fw-bold">LuxeStore</span>
                </a>

                <!-- Actions -->
                <div class="d-flex align-items-center gap-4">
                    <!-- Search Bar (Desktop) -->
                    <div class="d-none d-lg-block position-relative" style="width: 300px;">
                        <span class="material-symbols-outlined position-absolute text-muted" style="left: 12px; top: 50%; transform: translateY(-50%); font-size: 20px;">search</span>
                        <input type="text" class="form-control bg-light border-0 rounded-pill py-2 ps-5" placeholder="Search..." style="font-size: 0.9rem;">
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        @auth
                            <button class="btn btn-link text-dark p-0 position-relative text-decoration-none">
                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0, 'wght' 300;">shopping_bag</span>
                                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle" style="width: 8px; height: 8px;"></span>
                            </button>

                            <div class="dropdown">
                                <a href="#" class="d-flex align-items-center gap-2 text-decoration-none dropdown-toggle text-dark fw-medium" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 0.9rem;">
                                    {{ Str::limit(Auth::user()->name, 10) }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2 rounded-3 overflow-hidden">
                                    @if(Auth::user()->isAdmin())
                                        <li><a class="dropdown-item py-2 px-3 small" href="/admin">Admin Dashboard</a></li>
                                    @endif
                                    <li><a class="dropdown-item py-2 px-3 small" href="{{ route('profile.edit') }}">Profile</a></li>
                                    <li><hr class="dropdown-divider my-1"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item py-2 px-3 small text-danger">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <div class="d-none d-sm-flex align-items-center gap-3">
                                <a href="{{ route('login') }}" class="text-decoration-none text-dark fw-medium" style="font-size: 0.9rem;">Login</a>
                                <a href="{{ route('register') }}" class="btn btn-dark rounded-pill px-4 py-1 fw-medium" style="font-size: 0.9rem;">Register</a>
                            </div>
                        @endauth
                        
                        <!-- Mobile Menu Button -->
                        <button class="btn btn-link d-lg-none text-dark p-0 text-decoration-none">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow-1">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="py-5">
        <div class="container-xl px-4 px-lg-5">
            <div class="row g-4">
                <!-- Brand -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="d-flex align-items-center gap-2 text-primary-custom mb-3">
                        <div style="width: 24px; height: 24px;">
                            <svg class="w-100 h-100" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <path d="M42.1739 20.1739L27.8261 5.82609C29.1366 7.13663 28.3989 10.1876 26.2002 13.7654C24.8538 15.9564 22.9595 18.3449 20.6522 20.6522C18.3449 22.9595 15.9564 24.8538 13.7654 26.2002C10.1876 28.3989 7.13663 29.1366 5.82609 27.8261L20.1739 42.1739C21.4845 43.4845 24.5355 42.7467 28.1133 40.548C30.3042 39.2016 32.6927 37.3073 35 35C37.3073 32.6927 39.2016 30.3042 40.548 28.1133C42.7467 24.5355 43.4845 21.4845 42.1739 20.1739Z" fill="currentColor"></path>
                            </svg>
                        </div>
                        <span class="fs-5 fw-bold text-dark">LuxeStore</span>
                    </div>
                    <p class="text-secondary small">Curating the finest products for a modern lifestyle. Quality, aesthetics, and sustainability in every item.</p>
                </div>

                <!-- Links -->
                <div class="col-6 col-md-3 col-lg-2 offset-lg-2">
                    <h6 class="fw-bold mb-3">Shop</h6>
                    <ul class="list-unstyled text-secondary small">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">New Arrivals</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Best Sellers</a></li>
                    </ul>
                </div>
                
                <div class="col-6 col-md-3 col-lg-2">
                    <h6 class="fw-bold mb-3">Support</h6>
                    <ul class="list-unstyled text-secondary small">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Help Center</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Contact Us</a></li>
                    </ul>
                </div>
                
                 <div class="col-12 col-lg-2">
                    <h6 class="fw-bold mb-3">Company</h6>
                    <ul class="list-unstyled text-secondary small">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">About Us</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            
             <div class="border-top mt-5 pt-4 text-center">
                <p class="small text-muted mb-0">© 2024 LuxeStore Inc. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

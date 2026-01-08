<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Jualin Aja') }}</title>

        <!-- Google Fonts: Instrument Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
        
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>
            body {
                font-family: 'Instrument Sans', sans-serif;
                background-color: #ffffff;
                color: #1b1b18;
                overflow-x: hidden;
            }
            .ls-1 { letter-spacing: 0.05em; }
            .ls-2 { letter-spacing: 0.1em; }
            
            .btn-black {
                background-color: #000;
                color: white;
                border-radius: 0;
                padding: 12px 28px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                transition: all 0.3s;
                border: 1px solid #000;
            }
            .btn-black:hover {
                background-color: transparent;
                color: #000;
            }
            
            .btn-outline-black {
                background-color: transparent;
                color: #000;
                border-radius: 0;
                padding: 12px 28px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                transition: all 0.3s;
                border: 1px solid #000;
            }
            .btn-outline-black:hover {
                background-color: #000;
                color: white;
            }

            .nav-link {
                color: #1b1b18;
                font-weight: 500;
                font-size: 0.9rem;
                letter-spacing: 0.02em;
                transition: color 0.2s;
            }
            .nav-link:hover {
                color: #555;
            }

            .hero-section {
                min-height: 80vh;
                display: flex;
                align-items: center;
                background-color: #f9f9f9;
                position: relative;
            }

            .product-card {
                border: 1px solid #eee;
                transition: all 0.3s ease;
            }
            .product-card:hover {
                border-color: #000;
                transform: translateY(-5px);
            }
            
            .hover-underline {
                position: relative;
                text-decoration: none;
                color: inherit;
            }
            .hover-underline::after {
                content: '';
                position: absolute;
                width: 100%;
                transform: scaleX(0);
                height: 1px;
                bottom: -2px;
                left: 0;
                background-color: currentColor;
                transform-origin: bottom right;
                transition: transform 0.25s ease-out;
            }
            .hover-underline:hover::after {
                transform: scaleX(1);
                transform-origin: bottom left;
            }
        </style>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg bg-white border-bottom border-light fixed-top py-3">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                    <div class="bg-black text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="bi bi-bag-fill" style="font-size: 0.9rem;"></i>
                    </div>
                    <span class="fw-bold fs-5 ls-1">JUALIN AJA</span>
                </a>
                
                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto gap-lg-4 my-3 my-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#">New Arrivals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Collections</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Accessories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                    </ul>
                    
                    <div class="d-flex align-items-center gap-3">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-black px-4 rounded-0">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="nav-link hover-underline">Sign In</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-sm btn-black px-4 rounded-0">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section mt-5 pt-5">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6 order-2 order-lg-1">
                        <span class="text-uppercase ls-2 text-secondary small fw-bold mb-3 d-block">Simplicity & Style</span>
                        <h1 class="display-3 fw-bold mb-4 ls-1" style="line-height: 1.1;">
                            Redefine Your <br> Everyday Look.
                        </h1>
                        <p class="lead text-muted mb-5" style="max-width: 480px;">
                            Discover a curated collection of minimalist fashion essentials designed for the modern individual.
                        </p>
                        <div class="d-flex gap-3">
                            <a href="{{ route('shop.index') }}" class="btn btn-black btn-lg fs-6 ">Shop Now</a>
                            <a href="#" class="btn btn-outline-black btn-lg fs-6">View Lookbook</a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2">
                        <div class="position-relative">
                             <!-- Abstract minimal SVG Shape behind image could go here -->
                            <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=2940&auto=format&fit=crop" 
                                 alt="Fashion Model" 
                                 class="img-fluid w-100 object-fit-cover shadow-none" 
                                 style="height: 600px; object-position: top center;">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Collections (Simulating shop categories) -->
        <section class="py-5 my-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold ls-1 mb-3">CURATED COLLECTIONS</h2>
                    <p class="text-muted">Essentials for every occasion</p>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="position-relative overflow-hidden group">
                           <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=2000&auto=format&fit=crop" class="w-100" style="height: 450px; object-fit: cover;" alt="Women">
                           <div class="position-absolute bottom-0 start-0 w-100 p-4 bg-gradient-to-t from-black/50 to-transparent">
                               <h3 class="text-white fw-bold ls-1 mb-0">WOMEN</h3>
                               <a href="{{ route('shop.index') }}" class="text-white text-decoration-none small ls-1 hover-underline">SHOP NOW</a>
                           </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative overflow-hidden group">
                           <img src="https://images.unsplash.com/photo-1488161628813-99425205adad?q=80&w=2000&auto=format&fit=crop" class="w-100" style="height: 450px; object-fit: cover;" alt="Men">
                           <div class="position-absolute bottom-0 start-0 w-100 p-4">
                               <h3 class="text-white fw-bold ls-1 mb-0 shadow-sm">MEN</h3>
                               <a href="{{ route('shop.index') }}" class="text-white text-decoration-none small ls-1 hover-underline shadow-sm">SHOP NOW</a>
                           </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="position-relative overflow-hidden group">
                           <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1999&auto=format&fit=crop" class="w-100" style="height: 450px; object-fit: cover;" alt="Accessories">
                           <div class="position-absolute bottom-0 start-0 w-100 p-4">
                               <h3 class="text-white fw-bold ls-1 mb-0">ACCESSORIES</h3>
                               <a href="{{ route('shop.index') }}" class="text-white text-decoration-none small ls-1 hover-underline">SHOP NOW</a>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Newsletter -->
        <section class="py-5 bg-black text-white">
            <div class="container py-5 text-center">
                <h2 class="fw-bold ls-1 mb-3">JOIN THE CLUB</h2>
                <p class="text-white-50 mb-5" style="max-width: 500px; margin: 0 auto;">Sign up for our newsletter to receive exclusive offers, news on latest drops, and style inspiration.</p>
                
                <form class="d-flex justify-content-center mx-auto" style="max-width: 400px;">
                    <input type="email" class="form-control rounded-0 border-0 px-4 py-3" placeholder="Enter your email address">
                    <button type="submit" class="btn btn-white bg-white text-black rounded-0 px-4 fw-bold ls-1">SUBSCRIBE</button>
                </form>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-white py-5 border-top">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-4">
                        <a class="navbar-brand d-flex align-items-center gap-2 mb-4" href="#">
                            <div class="bg-black text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;">
                                <i class="bi bi-bag-fill" style="font-size: 0.7rem;"></i>
                            </div>
                            <span class="fw-bold fs-6 ls-1">JUALIN AJA</span>
                        </a>
                        <p class="text-muted small">Designed for the modern minimalist. Quality essentials for everyday life.</p>
                    </div>
                    <div class="col-6 col-lg-2">
                        <h6 class="fw-bold ls-1 mb-3 small">SHOP</h6>
                        <ul class="list-unstyled d-flex flex-column gap-2 small">
                            <li><a href="#" class="text-muted text-decoration-none hover-underline">New Arrivals</a></li>
                            <li><a href="#" class="text-muted text-decoration-none hover-underline">Men</a></li>
                            <li><a href="#" class="text-muted text-decoration-none hover-underline">Women</a></li>
                            <li><a href="#" class="text-muted text-decoration-none hover-underline">Accessories</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-lg-2">
                        <h6 class="fw-bold ls-1 mb-3 small">HELP</h6>
                        <ul class="list-unstyled d-flex flex-column gap-2 small">
                            <li><a href="#" class="text-muted text-decoration-none hover-underline">Shipping & Returns</a></li>
                            <li><a href="#" class="text-muted text-decoration-none hover-underline">FAQ</a></li>
                            <li><a href="#" class="text-muted text-decoration-none hover-underline">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h6 class="fw-bold ls-1 mb-3 small">SOCIAL</h6>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-black fs-5"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="text-black fs-5"><i class="bi bi-twitter-x"></i></a>
                            <a href="#" class="text-black fs-5"><i class="bi bi-facebook"></i></a>
                        </div>
                    </div>
                </div>
                <div class="border-top mt-5 pt-4 d-flex flex-column flex-md-row justify-content-between align-items-center small text-muted">
                    <p class="mb-0">&copy; {{ date('Y') }} Jualin Aja. All rights reserved.</p>
                    <div class="d-flex gap-3 mt-3 mt-md-0">
                        <a href="#" class="text-muted text-decoration-none">Privacy Policy</a>
                        <a href="#" class="text-muted text-decoration-none">Terms of Service</a>
                    </div>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

<x-shop-layout>
    <style>
        .hero-section {
            height: 550px;
            background-size: cover;
            background-position: center;
            border-radius: 1rem;
            position: relative;
            overflow: hidden;
        }
        .hero-overlay {
            background: linear-gradient(to right, rgba(0,0,0,0.6), transparent);
            position: absolute;
            inset: 0;
        }
        .clean-card {
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
            border-radius: 12px;
            overflow: hidden;
        }
        .clean-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .category-height {
            height: 280px;
            background-size: cover;
            background-position: center;
            position: relative;
            border-radius: 12px;
            overflow: hidden;
        }
        .category-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
            position: absolute;
            inset: 0;
            display: flex;
            align-items: flex-end;
            padding: 20px;
            transition: background 0.3s;
        }
        .category-height:hover .category-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.1));
        }
        
        .product-img-container {
            position: relative;
            padding-top: 133%; /* 4:3 Aspect Ratio */
            background-color: #f8f9fa;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 12px;
        }
        .product-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .clean-card:hover .product-img {
            transform: scale(1.05);
        }
        .action-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.2s;
            color: #333;
            border: none;
        }
        .action-btn:hover {
            background: #101922;
            color: white;
        }
        .product-overlay {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            opacity: 0;
            transform: translateX(10px);
            transition: all 0.3s ease;
        }
        .clean-card:hover .product-overlay {
            opacity: 1;
            transform: translateX(0);
        }
        /* Buttons */
        .btn-dark-custom {
            background-color: #101922;
            border-color: #101922;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-dark-custom:hover {
            background-color: #2c3e50;
            border-color: #2c3e50;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>

    <div class="container-xl px-4 px-lg-5 py-4">
        
        <!-- Hero Section -->
        <section class="mb-5">
            <div class="hero-section shadow-sm" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAZrFtRpXHV87_QKA2V_Vcc8DAOh6WTLZer4WxQCHSX9Ir-lPbgQSYntEC6Zgmd78ga5IRne5uKesayySr_Pq48WML6ak9TudgJAqUz81VBj3XNAjzVJRfxXvSI4YDvOE1rYH0NSa_I2RHa_CoAYPtK-TJjbULI1TiBVeO7KRsThzATMGHc2arJrRQWbiub_C1YS56Mv8Mf0FJ5i9SmmWIp9Gt-xVjXgpj7Xss2MU6bf2JnB5GrBgnrOpgR6021OUWjwA3PYDXtwh5Y');">
                <div class="hero-overlay"></div>
                <div class="position-relative h-100 d-flex align-items-center px-4 md:px-5" style="z-index: 10; padding-left: 3rem;">
                    <div class="text-white" style="max-width: 550px;">
                        <span class="text-uppercase fw-bold letter-spacing-2 small mb-2 d-block opacity-75">New Collection 2024</span>
                        <h1 class="display-4 fw-bold mb-3">Elevate Your Style</h1>
                        <p class="lead mb-4 opacity-90 fw-light">Discover curated pieces that blend modern aesthetics with timeless comfort.</p>
                        <a href="#products" class="btn btn-light rounded-pill px-5 py-2 fw-bold text-dark border-0 shadow-sm">Shop Now</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories -->
        <section class="mb-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <a href="#" class="d-block category-height shadow-sm group text-decoration-none">
                        <div class="h-100 w-100" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAOLuc6IqTTMFvFknTlRxfuaafl-L5CnUaixsktPGUEEq8Gy9VJo4rXMFMundBKxgg76lvXjB8YUBR8CtjF5SsHVJtK-mCMDqskaxIc3ilAKQetSdy4jxtJkZRg_Gz1c8lNhYXmQdSk_N_WYh-wk-qSMD4dpVVdcNwWtBI1mI9FCRhi_3pFd7Ow6QU3CGtnDAq0g9b7fGpc4chJFBBP6DXWGvmURhoMP-wvaQqtAgpDfBkvVuq2EGdT7pqSTHwHRdWHjarF42vKn8aN'); background-size: cover; background-position: center; transition: transform 0.5s;"></div>
                        <div class="category-overlay">
                            <div class="w-100">
                                <h4 class="text-white fw-bold mb-0">Electronics</h4>
                                <span class="text-white-50 small text-uppercase fw-bold">Explore</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="d-block category-height shadow-sm group text-decoration-none">
                        <div class="h-100 w-100" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAGnmXSpj8oMImy1UXh84Snv2Q1_kloB1X4qJP6dPuCejcM7mbByF3D1fv6xDxMsttGgG6NbESfPF2AWPX5k13W8LbuMbDSHmNgl8gBssrJXlSabPHbwauF45thQmn7-7SCSlHYEergwz_TzAVjrhjgP_-uWH7-G1JZLZ9I9ricjJRwQiQHMXQSmWrIQLV1yLseIiWbHcw79ge1TDLDBzJuWyaj1C2VAiTqnca56if-stb7jIBd-55KKsC8g1NiedkQ_KOR32KDznuD'); background-size: cover; background-position: center;"></div>
                        <div class="category-overlay">
                            <div class="w-100">
                                <h4 class="text-white fw-bold mb-0">Fashion</h4>
                                <span class="text-white-50 small text-uppercase fw-bold">Explore</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="d-block category-height shadow-sm group text-decoration-none">
                        <div class="h-100 w-100" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDFbloSt1OFSnblWHAOZIQdvQSF9gwpk3LSu722Pd-VSza4TBiVNL78g7uA6YOs7qC6m6nNqaaCquSgniQcXctJ3CEklQV6am9gjovM1-0PldqVo1VdocB5kbrULbrjV857MOhw7sjbEigoXm66D2T-v3lwUnxJHyJ29PuRGznZd8N1CAx9b-ujxjiWLJNGYsJYbUVcOf_Gs4CxMqRwtFHVUxo3f9IMrUKye7yywlCxjdX2LvAMkE_XW-Xg2WR6m8C9qCVhZcSkcJrC'); background-size: cover; background-position: center;"></div>
                        <div class="category-overlay">
                            <div class="w-100">
                                <h4 class="text-white fw-bold mb-0">Living</h4>
                                <span class="text-white-50 small text-uppercase fw-bold">Explore</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!-- Product Grid -->
        <section id="products" class="mb-5">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h2 class="fw-bold mb-0">Trending Now</h2>
                    <p class="text-muted small mb-0">Handpicked items just for you.</p>
                </div>
                <a href="#" class="text-dark fw-bold small text-decoration-none border-bottom border-dark pb-1">View All</a>
            </div>

            <div class="row g-4">
                @if($products->count() > 0)
                    @foreach($products as $product)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="clean-card h-100">
                                <div class="product-img-container">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" class="product-img" alt="{{ $product->nama }}">
                                    @else
                                        <img src="https://placehold.co/400x500/f8f9fa/a0aec0?text=No+Image" class="product-img" alt="No Image">
                                    @endif
                                    
                                    <div class="product-overlay">
                                        <button class="action-btn" title="Add to Wishlist">
                                            <span class="material-symbols-outlined fs-6">favorite</span>
                                        </button>
                                        <a href="{{ route('shop.show', $product) }}" class="action-btn text-decoration-none" title="View Details">
                                            <span class="material-symbols-outlined fs-6">visibility</span>
                                        </a>
                                    </div>
                                    
                                    @if($product->stok <= 0)
                                        <div class="position-absolute bottom-0 start-0 w-100 bg-white bg-opacity-75 text-center text-danger fw-bold small py-1">
                                            SOLD OUT
                                        </div>
                                    @endif
                                </div>
                                <div class="p-3 pt-1">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <h3 class="h6 fw-bold mb-0 text-truncate pe-2">
                                            <a href="{{ route('shop.show', $product) }}" class="text-dark text-decoration-none">{{ $product->nama }}</a>
                                        </h3>
                                        <span class="badge bg-light text-dark border fw-normal small">New</span>
                                    </div>
                                    <p class="text-muted small mb-2 text-truncate">{{ $product->category ? $product->category->name : 'General' }}</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="fw-bold text-dark">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 py-5 text-center">
                        <div class="text-muted mb-3">
                            <span class="material-symbols-outlined fs-1 opacity-25">inventory_2</span>
                        </div>
                        <h5 class="fw-normal text-muted">No products found yet.</h5>
                    </div>
                @endif
            </div>
            
            <div class="text-center mt-5">
                <button class="btn btn-outline-dark rounded-pill px-5 py-2 fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Load More</button>
            </div>
        </section>

        <!-- Newsletter -->
        <section class="py-5">
            <div class="bg-dark text-white rounded-4 p-5 text-center position-relative overflow-hidden">
                <div class="position-relative z-1">
                    <h2 class="fw-bold mb-2">Join the Club</h2>
                    <p class="text-white-50 mb-4 fw-light">Get exclusive access to sales and new arrivals.</p>
                    <form class="mx-auto" style="max-width: 400px;">
                        <div class="input-group bg-white rounded-pill overflow-hidden p-1">
                            <input type="email" class="form-control border-0 px-3 shadow-none" placeholder="Your email address">
                            <button class="btn btn-dark rounded-pill px-4" type="button">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>
</x-shop-layout>

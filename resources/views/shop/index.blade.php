<x-shop-layout>
    @php
        function getCategoryIcon($name) {
            $name = strtolower($name ?? '');
            if (str_contains($name, 'elec') || str_contains($name, 'gadget') || str_contains($name, 'hp') || str_contains($name, 'laptop')) return 'bi-laptop';
            if (str_contains($name, 'fash') || str_contains($name, 'cloth') || str_contains($name, 'baju') || str_contains($name, 'pakaian')) return 'bi-bag';
            if (str_contains($name, 'shoe') || str_contains($name, 'foot') || str_contains($name, 'sepatu')) return 'bi-box-seam';
            if (str_contains($name, 'watch') || str_contains($name, 'clock') || str_contains($name, 'jam')) return 'bi-watch';
            if (str_contains($name, 'home') || str_contains($name, 'furn') || str_contains($name, 'rumah')) return 'bi-house';
            if (str_contains($name, 'sport') || str_contains($name, 'gym') || str_contains($name, 'olahraga')) return 'bi-activity';
            if (str_contains($name, 'beauty') || str_contains($name, 'care') || str_contains($name, 'kosmetik')) return 'bi-heart';
            return 'bi-tag';
        }
    @endphp

    <style>
        /* Hero Refinement */
        .hero-section {
            height: 50vh;
            min-height: 400px;
            background-size: cover;
            background-position: center;
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            margin-bottom: 3rem;
        }
        .hero-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 3rem;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            color: white;
        }

        /* Category Card */
        .cat-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem 1rem;
            background: white;
            border: 1px solid #f0f0f0;
            border-radius: 16px;
            text-decoration: none;
            color: #1a1a1a;
            transition: all 0.2s ease;
            height: 100%;
        }
        .cat-card:hover {
            transform: translateY(-5px);
            border-color: #1a1a1a;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            background: #fff;
        }
        .cat-icon {
            width: 55px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border-radius: 50%;
            font-size: 1.5rem;
            color: #1a1a1a;
            transition: all 0.2s;
            overflow: hidden; /* For image */
            margin-bottom: 0.75rem;
        }
        .cat-card:hover .cat-icon {
            background: #1a1a1a;
            color: white;
        }
        /* Keep image separate so it doesn't change color */
        .cat-card:hover .cat-icon img {
             /* No filter needed, just nice image */
        }

        /* Product Card Simple */
        .product-card {
            text-decoration: none;
            color: inherit;
            display: block;
            height: 100%;
        }
        .product-img-wrapper {
            border-radius: 12px;
            overflow: hidden;
            background: #f4f4f4;
            aspect-ratio: 1/1;
            position: relative;
            margin-bottom: 1rem;
        }
        .product-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .product-card:hover .product-img {
            transform: scale(1.05);
        }
        .card-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: white;
            color: black;
            font-weight: 700;
            font-size: 0.7rem;
            padding: 4px 10px;
            border-radius: 20px;
            z-index: 2;
        }
    </style>

    <div class="container py-4">
        <!-- Hero -->
        <div class="hero-section mb-5" style="background-image: url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=2070&auto=format&fit=crop');">
            <div class="hero-content">
                <span class="badge bg-white text-dark mb-2 px-3 py-1 rounded-pill fw-bold small">New Arrival</span>
                <h1 class="display-4 fw-bold mb-2">Minimalist Collection</h1>
                <p class="mb-0 opacity-75">Discover styles that blend luxury and comfort perfectly.</p>
            </div>
        </div>

        <!-- Categories Section -->
        @if(isset($categories) && $categories->count() > 0)
        <div class="mb-5">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="fw-bold mb-0">Browse Categories</h4>
                <a href="#" class="text-decoration-none text-muted small fw-bold">View All <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
            
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3">
                @foreach($categories as $category)
                    <div class="col">
                        <a href="#" class="cat-card h-100">
                            <div class="cat-icon">
                                @if($category->image && Storage::exists('public/'.$category->image))
                                     <img src="{{ Storage::url($category->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $category->name }}">
                                @elseif($category->image)
                                     {{-- Try without checking storage existence if path is full url --}}
                                     <img src="{{ Storage::url($category->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $category->name }}">
                                @else
                                     <i class="{{ getCategoryIcon($category->name) }}"></i>
                                @endif
                            </div>
                            <span class="fw-bold small text-center text-truncate w-100 px-1">{{ $category->name }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Products Section -->
        <div id="products">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="fw-bold mb-0">Latest Arrivals</h4>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                @if($products->count() > 0)
                    @foreach($products as $product)
                        <div class="col">
                            <a href="{{ route('shop.show', $product) }}" class="product-card">
                                <div class="product-img-wrapper">
                                    <div class="card-badge">NEW</div>
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" class="product-img" alt="{{ $product->nama }}">
                                    @else
                                        <div class="d-flex w-100 h-100 align-items-center justify-content-center bg-light text-muted">
                                            <i class="bi bi-image fs-1 opacity-25"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="pb-2">
                                    <div class="text-muted small fw-bold mb-1 text-uppercase">{{ $product->category->name ?? 'Collection' }}</div>
                                    <h6 class="fw-bold text-dark mb-1 text-truncate">{{ $product->nama }}</h6>
                                    <div class="fw-bold text-dark">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center py-5">
                        <div class="p-5 bg-light rounded-4">
                            <i class="bi bi-box-seam fs-1 text-muted mb-3 d-block"></i>
                            <h5 class="fw-bold">No products found</h5>
                            <p class="text-muted">Stay tuned for our upcoming collections.</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-shop-layout>

<x-shop-layout>
    <!-- Bootstrap 5 CSS & Icons (Jika belum ada di layout global) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #fdfdfd; /* Off-white yang sangat bersih */
            color: #333;
        }
        
        /* Elegan & Modern Typography */
        .product-title {
            font-family: system-ui, -apple-system, sans-serif;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: #000;
        }

        .product-price {
            font-size: 1.75rem;
            font-weight: 500;
            color: #000;
        }

        .category-label {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #888;
        }

        /* Image Styling */
        .img-container {
            background-color: #f4f4f4;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            aspect-ratio: 1/1; /* Square for modern look */
        }

        .product-img {
            max-width: 100%;
            height: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
        }
        
        .img-container:hover .product-img {
            transform: scale(1.03);
        }

        /* Form Elements */
        .btn-qty {
            border: 1px solid #ddd;
            background: #fff;
            width: 40px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .btn-qty:hover {
            background: #f8f8f8;
        }

        .input-qty {
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            border-left: none;
            border-right: none;
            text-align: center;
            width: 50px;
            height: 50px;
            background: #fff;
            font-weight: 600;
        }
        
        .input-qty:focus {
            outline: none;
        }

        .btn-black {
            background-color: #000;
            color: white;
            border: none;
            height: 50px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }

        .btn-black:hover {
            background-color: #333;
            transform: translateY(-2px);
            color: white;
        }

        /* Accordion Customization */
        .accordion-button {
            background-color: transparent;
            box-shadow: none !important;
            color: #1a1a1a;
            font-weight: 500;
            padding-left: 0;
            padding-right: 0;
            border-bottom: 1px solid #eee !important;
        }
        
        .accordion-button::after {
            filter: grayscale(100%);
        }
        
        .accordion-button:not(.collapsed) {
            background-color: transparent;
            color: #1a1a1a;
        }
        
        .accordion-item {
            border: none;
            background: transparent;
        }
        
        .accordion-body {
            padding-left: 0;
            padding-right: 0;
            color: #666;
            line-height: 1.7;
            font-size: 0.95rem;
        }
    </style>

    <div class="py-5">
        <div class="container" style="max-width: 1100px;">
            <!-- Breadcrumb Simple -->
            <nav aria-label="breadcrumb" class="mb-5">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('shop.index') }}" class="text-decoration-none text-secondary">Home</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">{{ $product->nama }}</li>
                </ol>
            </nav>

            <div class="row align-items-start gx-5">
                <!-- Left: Product Image -->
                <div class="col-lg-6 mb-4 mb-lg-0 sticky-lg-top" style="top: 2rem; z-index: 1;">
                    <div class="img-container shadow-sm">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" class="product-img" alt="{{ $product->nama }}">
                        @else
                            <div class="text-muted d-flex flex-column align-items-center">
                                <i class="bi bi-image fs-1 mb-2"></i>
                                <span>No Image</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right: Information -->
                <div class="col-lg-6 ps-lg-5">
                    <div class="mb-4">
                        <span class="category-label d-block mb-2">{{ $product->category->name ?? 'Collection' }}</span>
                        <h1 class="display-5 product-title mb-3">{{ $product->nama }}</h1>
                        <p class="product-price mb-0">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-muted" style="line-height: 1.8;">
                            {{ $product->deskripsi }}
                        </p>
                    </div>

                    <!-- Add to Cart Section -->
                    <form action="{{ route('cart.store') }}" method="POST" class="mb-5">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">QUANTITY</label>
                            <div class="d-flex">
                                <button type="button" class="btn-qty rounded-start" onclick="decrement()">-</button>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stok }}" class="input-qty">
                                <button type="button" class="btn-qty rounded-end" onclick="increment()">+</button>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            @if($product->stok > 0)
                                <button type="submit" class="btn btn-black rounded-0 w-100">
                                    ADD TO CART
                                </button>
                            @else
                                <button type="button" class="btn btn-secondary rounded-0 w-100" disabled>
                                    OUT OF STOCK
                                </button>
                            @endif
                        </div>
                        
                        @if($product->stok > 0 && $product->stok < 10)
                            <div class="mt-2 text-danger small">
                                <i class="bi bi-exclamation-circle me-1"></i> Only {{ $product->stok }} left in stock
                            </div>
                        @endif
                    </form>

                    <!-- Minimalist Accordion for Details -->
                    <div class="accordion" id="productAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#details">
                                    DETAILS
                                </button>
                            </h2>
                            <div id="details" class="accordion-collapse collapse show" data-bs-parent="#productAccordion">
                                <div class="accordion-body">
                                    <ul class="list-unstyled mb-0">
                                        <li><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</li>
                                        <li><strong>Stock Code:</strong> PRD-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</li>
                                        <li><strong>Availability:</strong> {{ $product->stok > 0 ? 'In Stock' : 'Out of Stock' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#shipping">
                                    SHIPPING & RETURNS
                                </button>
                            </h2>
                            <div id="shipping" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                                <div class="accordion-body">
                                    Enjoy free shipping on all orders. Returns are accepted within 30 days of purchase.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const quantityInput = document.getElementById('quantity');
        const maxStock = {{ $product->stok }};

        function increment() {
            let val = parseInt(quantityInput.value);
            if(val < maxStock) {
                quantityInput.value = val + 1;
            }
        }

        function decrement() {
            let val = parseInt(quantityInput.value);
            if(val > 1) {
                quantityInput.value = val - 1;
            }
        }
    </script>
</x-shop-layout>

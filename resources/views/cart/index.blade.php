<x-shop-layout>
    <style>
        .cart-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        
        /* Minimalist Quantity Input */
        .qty-btn {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e5e7eb;
            border-radius: 50%;
            background: white;
            transition: all 0.2s;
            color: #333;
        }
        .qty-btn:hover {
            background: #f3f4f6;
            border-color: #d1d5db;
        }
        .qty-input {
            width: 40px;
            text-align: center;
            border: none;
            background: transparent;
            font-weight: 500;
            appearance: none;
            -moz-appearance: textfield;
        }
        .qty-input::-webkit-outer-spin-button,
        .qty-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .hover-scale-img { transition: transform 0.3s ease; }
        .hover-scale-img:hover { transform: scale(1.03); }
        
        .btn-black {
            background-color: #000;
            color: white;
            transition: all 0.3s;
        }
        .btn-black:hover {
            background-color: #333;
            color: white;
            transform: translateY(-1px);
        }
        
        .ls-1 { letter-spacing: 0.05em; }
    </style>

    <div class="py-5 bg-white min-vh-100">
        <div class="container" style="max-width: 1100px;">
            <!-- Header -->
            <div class="d-flex align-items-center justify-content-between mb-5">
                <h1 class="h3 fw-bold mb-0 text-uppercase ls-1" style="font-family: 'Instrument Sans', sans-serif;">Shopping Bag</h1>
                <span class="text-muted small">{{ $items->count() }} items</span>
            </div>

            <div class="row g-5">
                <!-- Left Column: Cart Items -->
                <div class="col-lg-8">
                    @if($items->count() > 0)
                        <div class="d-flex flex-column gap-4">
                            @php $total = 0; @endphp
                            @foreach($items as $item)
                                @php 
                                    $subtotal = $item->product->harga * $item->quantity;
                                    $total += $subtotal; 
                                @endphp
                                
                                <div class="row align-items-center cf-row py-3 border-bottom" data-item-id="{{ $item->id }}">
                                    <!-- Image -->
                                    <div class="col-3 col-md-2">
                                        <div class="bg-light rounded-0 overflow-hidden position-relative" style="aspect-ratio: 1; min-height: 80px;">
                                            @if($item->product->image)
                                                <a href="{{ route('shop.show', $item->product) }}">
                                                    <img src="{{ Storage::url($item->product->image) }}" class="w-100 h-100 object-fit-cover hover-scale-img" alt="{{ $item->product->nama }}">
                                                </a>
                                            @else
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted bg-secondary-subtle">
                                                    <i class="bi bi-image fs-5"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Details -->
                                    <div class="col-9 col-md-10">
                                        <div class="row align-items-center h-100">
                                            <div class="col-md-5 mb-2 mb-md-0">
                                                <small class="text-secondary text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 0.5px;">{{ $item->product->category->name ?? 'Product' }}</small>
                                                <a href="{{ route('shop.show', $item->product) }}" class="d-block text-black text-decoration-none h6 fw-bold mb-1 text-truncate">{{ $item->product->nama }}</a>
                                                <div class="text-muted small">Rp {{ number_format($item->product->harga, 0, ',', '.') }}</div>
                                            </div>
                                            
                                            <div class="col-6 col-md-3">
                                                <div class="d-flex align-items-center gap-2">
                                                    <button class="qty-btn" onclick="changeQty(this, -1)">
                                                        <i class="bi bi-dash"></i>
                                                    </button>
                                                    <input type="number" 
                                                           class="qty-input" 
                                                           value="{{ $item->quantity }}" 
                                                           min="1" 
                                                           data-id="{{ $item->id }}"
                                                           data-price="{{ $item->product->harga }}"
                                                           readonly>
                                                    <button class="qty-btn" onclick="changeQty(this, 1)">
                                                        <i class="bi bi-plus"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="col-5 col-md-3 text-end">
                                                <div class="fw-bold text-black subtotal-display">Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                                            </div>

                                            <div class="col-1 text-end">
                                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-muted p-0 hover-text-danger" onclick="return confirm('Remove item?')">
                                                        <i class="bi bi-x"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-5">
                            <a href="{{ route('shop.index') }}" class="text-decoration-none text-black fw-medium small d-inline-flex align-items-center hover-opacity">
                                <i class="bi bi-arrow-left me-2"></i> Continue Shopping
                            </a>
                        </div>

                    @else
                        <div class="text-center py-5">
                            <div class="mb-4 text-muted opacity-25">
                                <i class="bi bi-bag fs-1" style="font-size: 4rem !important;"></i>
                            </div>
                            <h4 class="h5 fw-bold mb-2">Your Bag is Empty</h4>
                            <p class="text-muted mb-4 small">Looks like you haven't added anything to your bag yet.</p>
                            <a href="{{ route('shop.index') }}" class="btn btn-black rounded-pill px-5 py-2 fw-medium text-uppercase ls-1" style="font-size: 0.8rem;">
                                Start Shopping
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Right Column: Summary -->
                @if($items->count() > 0)
                <div class="col-lg-4">
                    <div class="bg-light bg-opacity-50 p-4 rounded-0 position-sticky" style="top: 100px;">
                        <h5 class="fw-bold mb-4 ls-1 text-uppercase" style="font-size: 0.9rem;">Order Summary</h5>
                        
                        <div class="d-flex justify-content-between mb-3 text-secondary small">
                            <span>Subtotal</span>
                            <span id="summary-subtotal" class="text-black fw-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 text-secondary small">
                            <span>Shipping</span>
                            <span class="text-black fw-medium">Free</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4 text-secondary small">
                            <span>Tax</span>
                            <span class="text-black fw-medium">Included</span>
                        </div>
                        
                        <hr class="border-secondary opacity-25 my-4">
                        
                        <div class="d-flex justify-content-between mb-4 align-items-center">
                            <span class="fw-bold text-uppercase small ls-1">Total</span>
                            <span class="fw-bold fs-5" id="summary-total">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="btn btn-black w-100 py-3 rounded-0 fw-bold text-uppercase ls-1 shadow-none" style="font-size: 0.85rem;">
                            Proceed to Checkout
                        </a>

                        <div class="mt-4 text-center">
                            <p class="text-muted small" style="font-size: 0.7rem;">
                                <i class="bi bi-shield-lock me-1"></i> Secure Checkout
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        const formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });

        function changeQty(btn, change) {
            const input = btn.parentElement.querySelector('input');
            let newValue = parseInt(input.value) + change;
            if (newValue >= 1) {
                input.value = newValue;
                updateCart(input);
            }
        }

        function updateCart(input) {
            const itemId = input.dataset.id;
            const quantity = input.value;
            const price = parseFloat(input.dataset.price);
            
            // UI Updates
            const subtotal = price * quantity;
            input.closest('.cf-row').querySelector('.subtotal-display').textContent = formatter.format(subtotal).replace('Rp', 'Rp ');

            let total = 0;
            document.querySelectorAll('.qty-input').forEach(inp => {
               total += parseInt(inp.value) * parseFloat(inp.dataset.price);
            });
            
            const totalStr = formatter.format(total).replace('Rp', 'Rp ');
            document.getElementById('summary-subtotal').textContent = totalStr;
            document.getElementById('summary-total').textContent = totalStr;

            // Backend Update
            fetch(`/cart/${itemId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ quantity: quantity })
            })
            .then(res => res.json())
            .catch(error => console.error('Error:', error));
        }
    </script>
</x-shop-layout>

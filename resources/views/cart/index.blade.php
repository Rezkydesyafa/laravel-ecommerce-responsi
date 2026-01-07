<x-shop-layout>
    <style>
        .cart-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
        
        /* Hilangkan spinner input number */
        .no-arrow::-webkit-outer-spin-button,
        .no-arrow::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .no-arrow {
            -moz-appearance: textfield;
        }

        .hover-scale { transition: transform 0.2s; }
        .hover-scale:hover { transform: scale(1.05); }
    </style>

    <div class="py-5 bg-light min-vh-100">
        <div class="container" style="max-width: 1100px;">
            <div class="row g-5">
                <!-- Left Column: Cart Items -->
                <div class="col-lg-8">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 fw-bold mb-0">Shopping Cart</h1>
                        <span class="badge bg-dark rounded-pill fw-normal px-3 py-2">{{ $items->count() }} Items</span>
                    </div>



                    @if($items->count() > 0)
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-body p-0">
                                @php $total = 0; @endphp
                                @foreach($items as $item)
                                    @php 
                                        $subtotal = $item->product->harga * $item->quantity;
                                        $total += $subtotal; 
                                    @endphp
                                    <div class="p-4 border-bottom last:border-bottom-0 cf-row" data-item-id="{{ $item->id }}">
                                        <div class="d-flex align-items-center gap-4">
                                            <!-- Image -->
                                            <div class="flex-shrink-0 bg-light rounded-3 overflow-hidden" style="width: 100px; height: 100px;">
                                                @if($item->product->image)
                                                    <a href="{{ route('shop.show', $item->product) }}">
                                                        <img src="{{ Storage::url($item->product->image) }}" class="w-100 h-100 object-fit-cover hover-scale" alt="{{ $item->product->nama }}">
                                                    </a>
                                                @else
                                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                                        <i class="bi bi-image fs-4"></i>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Details -->
                                            <div class="flex-grow-1">
                                                <div class="row align-items-center">
                                                    <div class="col-md-5 mb-2 mb-md-0">
                                                        <small class="text-uppercase text-muted fw-bold" style="font-size: 0.7rem;">{{ $item->product->category->name ?? 'Product' }}</small>
                                                        <a href="{{ route('shop.show', $item->product) }}" class="d-block text-dark text-decoration-none h6 fw-bold mb-0 text-truncate">{{ $item->product->nama }}</a>
                                                        <div class="text-muted small mt-1">Rp {{ number_format($item->product->harga, 0, ',', '.') }}</div>
                                                    </div>
                                                    
                                                    <div class="col-md-3 mb-3 mb-md-0">
                                                        <div class="d-flex align-items-center border rounded-pill px-2" style="width: fit-content;">
                                                            <button class="btn btn-link text-dark p-0 text-decoration-none" onclick="changeQty(this, -1)">
                                                                <i class="bi bi-dash"></i>
                                                            </button>
                                                            <input type="number" 
                                                                   class="form-control border-0 bg-transparent text-center fw-bold p-1 no-arrow quantity-input" 
                                                                   style="width: 40px;"
                                                                   value="{{ $item->quantity }}" 
                                                                   min="1" 
                                                                   data-id="{{ $item->id }}"
                                                                   data-price="{{ $item->product->harga }}"
                                                                   readonly>
                                                            <button class="btn btn-link text-dark p-0 text-decoration-none" onclick="changeQty(this, 1)">
                                                                <i class="bi bi-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 mb-2 mb-md-0 text-md-end">
                                                        <div class="fw-bold fs-6 subtotal-display">Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                                                    </div>

                                                    <div class="col-md-1 text-end">
                                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link text-muted p-0" title="Remove" onclick="return confirm('Remove item?')">
                                                                <i class="bi bi-x-lg"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <a href="{{ route('shop.index') }}" class="text-decoration-none text-muted fw-medium small">
                                <i class="bi bi-arrow-left me-1"></i> Continue Shopping
                            </a>
                        </div>

                    @else
                        <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                            <i class="bi bi-cart3 fs-1 text-muted opacity-50 mb-3 d-block"></i>
                            <h4 class="h5 fw-bold">Your cart is empty</h4>
                            <p class="text-muted mb-4 small">Discover our collections and find something you love.</p>
                            <a href="{{ route('shop.index') }}" class="btn btn-dark rounded-pill px-4">Start Shopping</a>
                        </div>
                    @endif
                </div>

                <!-- Right Column: Summary -->
                @if($items->count() > 0)
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 position-sticky" style="top: 100px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Order Summary</h5>
                            
                            <div class="d-flex justify-content-between mb-3 text-muted">
                                <span>Subtotal</span>
                                <span id="summary-subtotal">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3 text-muted">
                                <span>Shipping</span>
                                <span class="text-success fw-medium">Free</span>
                            </div>
                            <div class="d-flex justify-content-between mb-4 text-muted">
                                <span>Tax</span>
                                <span>Included</span>
                            </div>
                            
                            <hr class="border-secondary opacity-10 my-4">
                            
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold fs-5">Total</span>
                                <span class="fw-bold fs-5" id="summary-total">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>

                            <a href="{{ route('checkout.index') }}" class="btn btn-dark w-100 py-3 rounded-3 fw-bold shadow-sm">
                                Checkout Now
                            </a>

                            <p class="text-center text-muted small mt-3 mb-0">
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
            document.querySelectorAll('.quantity-input').forEach(inp => {
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
            .then(data => {
                // Silent update success
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</x-shop-layout>

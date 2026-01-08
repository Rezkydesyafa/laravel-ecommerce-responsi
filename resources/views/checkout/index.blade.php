<x-shop-layout>
    <style>
        .ls-1 { letter-spacing: 0.05em; }
        
        /* Floating Labels Minimalist */
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: #000;
            transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
        }
        .form-control:focus {
            border-bottom-color: #000 !important;
            box-shadow: none;
        }
        
        /* Button Styles */
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

        .hover-scale-img { transition: transform 0.3s ease; }
        .hover-scale-img:hover { transform: scale(1.03); }
    </style>

    <div class="py-5 bg-white min-vh-100">
        <div class="container" style="max-width: 1100px;">
            <!-- Header -->
            <div class="d-flex align-items-center justify-content-between mb-5">
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('cart.index') }}" class="text-black text-decoration-none d-flex align-items-center justify-content-center border rounded-circle" style="width: 32px; height: 32px; border-color: #e5e7eb;">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <h1 class="h3 fw-bold mb-0 text-uppercase ls-1" style="font-family: 'Instrument Sans', sans-serif;">Checkout</h1>
                </div>
            </div>

            <div class="row g-5">
                <!-- Left Column: Checkout Form -->
                <div class="col-lg-7">
                    <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                        @csrf
                        
                        <!-- Contact Information -->
                        <div class="mb-5">
                            <h6 class="fw-bold mb-4 ls-1 text-uppercase " style="font-size: 0.8rem;">Contact Information</h6>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control border-0 border-bottom rounded-0 px-0 shadow-none bg-transparent" 
                                       id="email" value="{{ $user->email }}" disabled
                                       style="border-bottom: 1.5px solid #eee !important; height: 50px;">
                                <label for="email" class="text-muted px-0">Email Address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border-0 border-bottom rounded-0 px-0 shadow-none bg-transparent" 
                                       id="phone" name="phone" placeholder="Phone" required
                                       style="border-bottom: 1.5px solid #eee !important; height: 50px;">
                                <label for="phone" class="text-muted px-0">Phone Number</label>
                            </div>
                        </div>

                        <!-- Shipping Address -->
                        <div class="mb-5">
                            <h6 class="fw-bold mb-4 ls-1 text-uppercase" style="font-size: 0.8rem;">Shipping Address</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control border-0 border-bottom rounded-0 px-0 shadow-none bg-transparent" 
                                               id="address" name="address" placeholder="Address" required
                                               style="border-bottom: 1.5px solid #eee !important; height: 50px;">
                                        <label for="address" class="text-muted px-0">Full Address</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control border-0 border-bottom rounded-0 px-0 shadow-none bg-transparent" 
                                               id="city" name="city" placeholder="City" required
                                               style="border-bottom: 1.5px solid #eee !important; height: 50px;">
                                        <label for="city" class="text-muted px-0">City</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control border-0 border-bottom rounded-0 px-0 shadow-none bg-transparent" 
                                               id="postal_code" name="postal_code" placeholder="Postal Code" required
                                               style="border-bottom: 1.5px solid #eee !important; height: 50px;">
                                        <label for="postal_code" class="text-muted px-0">Postal Code</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-5">
                            <button type="submit" class="btn btn-black w-100 py-3 rounded-0 fw-bold text-uppercase ls-1 shadow-none transition-transform hover-scale" style="font-size: 0.85rem;">
                                Continue to Payment <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Column: Order Summary (Sticky) -->
                <div class="col-lg-5">
                    <div class="bg-light bg-opacity-50 p-4 rounded-0 position-sticky" style="top: 100px;">
                        <h5 class="fw-bold mb-4 ls-1 text-uppercase" style="font-size: 0.9rem;">Order Summary</h5>

                        <div class="d-flex flex-column gap-3 mb-4">
                            @foreach($items as $item)
                                <div class="d-flex align-items-center gap-3">
                                    <div class="position-relative" style="width: 60px; height: 60px;">
                                        <div class="w-100 h-100 bg-white rounded-0 overflow-hidden border border-light">
                                            @if($item->product->image)
                                                <img src="{{ Storage::url($item->product->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $item->product->nama }}">
                                            @else
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                                    <i class="bi bi-image"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-black text-white border border-white d-flex align-items-center justify-content-center p-0" style="width: 20px; height: 20px; font-size: 0.65rem;">
                                            {{ $item->quantity }}
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 fw-bold small text-black">{{ $item->product->nama }}</h6>
                                        <div class="text-secondary small" style="font-size: 0.75rem;">{{ $item->product->category->name ?? 'Product' }}</div>
                                    </div>
                                    <div class="fw-medium small text-black">
                                        Rp {{ number_format($item->product->harga * $item->quantity, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <hr class="border-secondary opacity-25 my-4">

                        <div class="d-flex justify-content-between mb-2 small text-secondary">
                            <span>Subtotal</span>
                            <span class="text-black fw-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4 small text-secondary">
                            <span>Shipping</span>
                            <span class="text-black fw-medium">Free</span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-4 pt-2 border-top border-secondary border-opacity-10">
                            <span class="fw-bold text-uppercase small ls-1">Total</span>
                            <span class="fw-bold fs-5">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-shop-layout>

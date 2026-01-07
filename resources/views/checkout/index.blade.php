<x-shop-layout>
    <div class="py-5 bg-white min-vh-100">
        <div class="container" style="max-width: 1000px;">
            <div class="row g-5">
                <!-- Left Column: Checkout Form -->
                <div class="col-lg-7">
                    <div class="d-flex align-items-center mb-4">
                        <a href="{{ route('cart.index') }}" class="text-dark me-3"><i class="bi bi-arrow-left"></i></a>
                        <h2 class="fw-bold m-0 tracking-tight">Checkout</h2>
                    </div>

                    <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                        @csrf
                        <h6 class="fw-bold mb-3 ls-1 text-uppercase small">Contact Information</h6>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control bg-light border-0 rounded-3" id="email" value="{{ $user->email }}" disabled>
                            <label for="email" class="text-muted">Email Address</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control bg-light border-0 rounded-3" id="phone" name="phone" placeholder="Phone" required>
                            <label for="phone" class="text-muted">Phone Number</label>
                        </div>

                        <h6 class="fw-bold mb-3 ls-1 text-uppercase small mt-5">Shipping Address</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-light border-0 rounded-3" id="address" name="address" placeholder="Address" required>
                                    <label for="address" class="text-muted">Full Address</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-light border-0 rounded-3" id="city" name="city" placeholder="City" required>
                                    <label for="city" class="text-muted">City</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-light border-0 rounded-3" id="postal_code" name="postal_code" placeholder="Postal Code" required>
                                    <label for="postal_code" class="text-muted">Postal Code</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-dark w-100 py-3 rounded-pill fw-bold d-flex align-items-center justify-content-center gap-2 transition-transform hover-scale">
                                Pay Order <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Column: Order Summary (Sticky) -->
                <div class="col-lg-5">
                    <div class="p-4 bg-light rounded-4 h-100">
                        <h5 class="fw-bold mb-4">Order Summary</h5>

                        <div class="d-flex flex-column gap-3 mb-4">
                            @foreach($items as $item)
                                <div class="d-flex align-items-center gap-3">
                                    <div class="position-relative">
                                        <div class="bg-white rounded-3 shadow-sm d-flex align-items-center justify-content-center overflow-hidden" style="width: 64px; height: 64px;">
                                            @if($item->product->image)
                                                <img src="{{ Storage::url($item->product->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $item->product->nama }}">
                                            @else
                                                <i class="bi bi-image text-muted"></i>
                                            @endif
                                        </div>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark text-white border border-white" style="font-size: 0.7rem;">
                                            {{ $item->quantity }}
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 fw-semibold small">{{ $item->product->nama }}</h6>
                                        <div class="text-muted small">{{ $item->product->category->name ?? 'Product' }}</div>
                                    </div>
                                    <div class="fw-semibold small">
                                        Rp {{ number_format($item->product->harga * $item->quantity, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <hr class="my-4 text-muted opacity-25">

                        <div class="d-flex justify-content-between mb-2 small text-muted">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4 small text-muted">
                            <span>Shipping</span>
                            <span class="text-dark fw-bold">Free</span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-4 pt-2 border-top border-secondary border-opacity-10">
                            <span class="fw-bold fs-5">Total</span>
                            <span class="fw-bold fs-4">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Style for Floating Labels & Interactions -->
    <style>
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: #111;
            font-weight: 600;
        }
        .form-control:focus {
            box-shadow: 0 0 0 2px rgba(0,0,0,0.1);
            background-color: #fff !important;
        }
        .hover-scale:hover {
            transform: scale(1.02);
            transition: transform 0.2s ease;
        }
    </style>
</x-shop-layout>

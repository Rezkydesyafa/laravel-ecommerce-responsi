<x-shop-layout>
    <div class="py-5 bg-gray-50 min-vh-100 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="card-header bg-dark text-white p-4 text-center">
                            <h4 class="mb-0 fw-bold">Complete Payment</h4>
                            <p class="mb-0 small opacity-75">Order #{{ $transaction->id }}</p>
                        </div>
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <div class="mb-3">
                                    <i class="bi bi-wallet2 fs-1 text-primary"></i>
                                </div>
                                <h5 class="fw-bold mb-1">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</h5>
                                <p class="text-muted small">Total Amount</p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded-3">
                                <span class="text-muted small">Customer</span>
                                <span class="fw-semibold">{{ $transaction->user->name }}</span>
                            </div>

                            <button id="pay-button" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm hover-scale transition-transform">
                                <i class="bi bi-credit-card me-2"></i> Pay Now
                            </button>
                        </div>
                        <div class="card-footer bg-light p-3 text-center small text-muted">
                            Secure payment via Midtrans
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $snapUrl = config('midtrans.is_production') 
            ? 'https://app.midtrans.com/snap/snap.js' 
            : 'https://app.sandbox.midtrans.com/snap/snap.js';
    @endphp

    <script src="{{ $snapUrl }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        const payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function(e) {
            e.preventDefault();
            snap.pay('{{ $transaction->snap_token }}', {
                onSuccess: function(result) {
                    // Send result to server
                    fetch('{{ route('checkout.success') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(result)
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        alert("Payment Success!");
                        window.location.href = "{{ route('shop.index') }}"; 
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert("Payment verified locally but failed to save on server.");
                        window.location.href = "{{ route('shop.index') }}"; 
                    });
                },
                onPending: function(result) {
                    alert("Waiting for payment!");
                    window.location.href = "{{ route('shop.index') }}";
                },
                onError: function(result) {
                    alert("Payment failed!");
                    location.reload();
                },
                onClose: function() {
                    alert('You closed the popup without finishing the payment');
                }
            });
        });
        
        // Auto trigger payment popup
        // snap.pay('{{ $transaction->snap_token }}');
    </script>
    
    <style>
        .hover-scale:hover {
            transform: scale(1.02);
            transition: transform 0.2s ease;
        }
    </style>
</x-shop-layout>

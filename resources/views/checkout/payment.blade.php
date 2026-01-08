<x-shop-layout>
    <style>
        .ls-1 { letter-spacing: 0.05em; }
        
        .btn-black {
            background-color: #000;
            color: white;
            transition: all 0.3s;
            border: 1px solid #000;
        }
        .btn-black:hover {
            background-color: white;
            color: #000;
        }
        
        /* Payment Card Styles */
        .payment-summary-card {
            border: 1px solid #eee;
            background: white;
            transition: all 0.3s;
        }
        .payment-summary-card:hover {
            border-color: #000;
        }

        /* Success Modal Animation */
        .success-checkmark {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e6fcf5;
            color: #0ca678;
            margin-bottom: 1.5rem;
        }
    </style>

    <div class="py-5 bg-white min-vh-100 d-flex align-items-center">
        <div class="container" style="max-width: 500px;">
            <div class="text-center mb-5">
                <div class="mb-3 d-inline-flex align-items-center justify-content-center bg-black text-white rounded-circle" style="width: 50px; height: 50px;">
                    <i class="bi bi-credit-card-2-front fs-5"></i>
                </div>
                <h1 class="h3 fw-bold mb-2 ls-1" style="font-family: 'Instrument Sans', sans-serif;">PAYMENT</h1>
                <p class="text-muted small">Please complete your payment securely.</p>
            </div>

            <div class="payment-summary-card p-4 p-md-5 rounded-0">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-4 border-bottom">
                    <span class="text-muted small text-uppercase ls-1 fw-bold">Order ID</span>
                    <span class="fw-bold fs-5">#{{ $transaction->id }}</span>
                </div>

                <div class="mb-5">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Customer</span>
                        <span class="fw-medium text-end">{{ $transaction->user->name }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                         <span class="text-muted">Total Amount</span>
                         <span class="fw-bold fs-4">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="d-grid gap-3">
                    <button id="pay-button" class="btn btn-black w-100 py-3 rounded-0 fw-bold text-uppercase ls-1">
                        Pay Now <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                    
                    <a href="{{ route('shop.index') }}" class="btn btn-link text-muted text-decoration-none small text-uppercase ls-1">
                        Cancel Payment
                    </a>
                </div>

                <div class="mt-4 pt-4 border-top text-center">
                    <div class="d-flex justify-content-center gap-3 opacity-50 grayscale">
                       <i class="bi bi-shield-check fs-5"></i>
                       <span class="small align-self-center">Secured by Midtrans</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-0 p-4 text-center">
                <div class="modal-body">
                    <div class="success-checkmark">
                        <i class="bi bi-check-lg fs-1"></i>
                    </div>
                    <h3 class="fw-bold ls-1 mb-2" style="font-family: 'Instrument Sans', sans-serif;">PAYMENT SUCCESSFUL</h3>
                    <p class="text-muted mb-4 small">Thank you! Your payment has been processed successfully.</p>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('transaction.history') }}" class="btn btn-black rounded-0 text-uppercase fw-bold ls-1 py-2">View Order History</a>
                        <a href="{{ route('shop.index') }}" class="btn btn-outline-dark rounded-0 text-uppercase fw-bold ls-1 py-2">Continue Shopping</a>
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
        // Initialize Bootstrap Modal
        // Note: Bootstrap 5 is already loaded in layout
        
        payButton.addEventListener('click', function(e) {
            e.preventDefault();
            snap.pay('{{ $transaction->snap_token }}', {
                onSuccess: function(result) {
                    // Send to backend
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
                        // Show Success Modal
                        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                        successModal.show();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Even if backend fails visually, midtrans success is real. Redirect to history.
                        window.location.href = "{{ route('transaction.history') }}";
                    });
                },
                onPending: function(result) {
                    window.location.href = "{{ route('transaction.history') }}";
                },
                onError: function(result) {
                    location.reload();
                },
                onClose: function() {
                    // Do nothing or alert user
                }
            });
        });
    </script>
</x-shop-layout>

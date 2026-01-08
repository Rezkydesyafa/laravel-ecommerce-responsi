<x-shop-layout>
    <style>
        .ls-1 { letter-spacing: 0.05em; }
        .font-heading { font-family: 'Instrument Sans', sans-serif; }
        .table-custom th {
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }
        .table-custom td {
            vertical-align: middle;
            padding-top: 1.25rem;
            padding-bottom: 1.25rem;
        }
    </style>

    <div class="py-5 bg-white min-vh-100">
        <div class="container" style="max-width: 900px;">
            <div class="mb-5 d-flex justify-content-between align-items-end border-bottom pb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1 ls-1 font-heading text-uppercase">Order History</h1>
                    <p class="text-muted small mb-0">Track your past purchases</p>
                </div>
                <a href="{{ route('shop.index') }}" class="text-decoration-none text-muted small fw-medium">
                    <i class="bi bi-arrow-left me-1"></i> Back to Shop
                </a>
            </div>

            @if($transactions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-borderless table-custom w-100">
                        <thead class="border-bottom border-black">
                            <tr>
                                <th class="text-uppercase text-secondary fw-bold pb-3">Order ID</th>
                                <th class="text-uppercase text-secondary fw-bold pb-3">Date</th>
                                <th class="text-uppercase text-secondary fw-bold pb-3">Total</th>
                                <th class="text-uppercase text-secondary fw-bold pb-3">Payment</th>
                                <th class="text-uppercase text-secondary fw-bold pb-3">Status</th>
                                <th class="text-uppercase text-secondary fw-bold pb-3 text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @foreach($transactions as $transaction)
                                <tr class="border-bottom">
                                    <td class="fw-bold">#{{ $transaction->id }}</td>
                                    <td class="text-muted small">{{ $transaction->created_at->format('d M Y') }}</td>
                                    <td class="fw-bold">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                                    <td class="text-capitalize small text-muted">{{ str_replace('_', ' ', $transaction->payment_method ?? '-') }}</td>
                                    <td>
                                        @if($transaction->status == 'paid')
                                            <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-2 text-uppercase ls-1" style="font-size: 0.65rem;">Paid</span>
                                        @elseif($transaction->status == 'pending')
                                            <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-2 text-uppercase ls-1" style="font-size: 0.65rem;">Pending</span>
                                        @else
                                            <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-2 text-uppercase ls-1" style="font-size: 0.65rem;">{{ $transaction->status }}</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if($transaction->status == 'pending')
                                            <a href="{{ route('checkout.payment', $transaction) }}" class="btn btn-sm btn-dark rounded-0 px-3 fw-bold text-uppercase ls-1" style="font-size: 0.7rem;">Pay Now</a>
                                        @else
                                            <button class="btn btn-sm text-muted" disabled style="font-size: 0.8rem;">View Details</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5 my-5 bg-light bg-opacity-50">
                    <div class="mb-3">
                        <i class="bi bi-bag-x fs-1 text-muted opacity-25"></i>
                    </div>
                    <h5 class="fw-bold text-uppercase ls-1 mb-2">No Orders Yet</h5>
                    <p class="text-muted small mb-4">You haven't placed any orders yet.</p>
                    <a href="{{ route('shop.index') }}" class="btn btn-dark rounded-0 px-4 py-2 text-uppercase fw-bold small ls-1">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-shop-layout>

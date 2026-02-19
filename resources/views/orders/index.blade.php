@extends('layouts.frontend')

@section('content')
<div class="container py-5 mt-5">
    <div class="glass-card p-4" style="background: rgba(0,0,0,0.8); border: 2px solid crimson;">
        <h2 class="section-header text-start mb-5" style="font-size: 3rem;">Order History <span>注文履歴</span></h2>

        @if($orders->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-journal-x fs-1 text-white-50 mb-3 d-block"></i>
                <h4 class="text-white-50">You haven't placed any orders yet.</h4>
                <a href="{{ route('products.index') }}" class="btn btn-outline-danger mt-3 px-4 fw-bold">START SHOPPING</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle border-danger">
                    <thead class="text-crimson">
                        <tr>
                            <th class="border-danger">ORDER ID</th>
                            <th class="border-danger">DATE</th>
                            <th class="border-danger">TOTAL</th>
                            <th class="border-danger">STATUS</th>
                            <th class="border-danger">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="fw-bold border-secondary">#HKR-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="border-secondary text-white-50 small">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="border-secondary fw-bold text-crimson">${{ number_format($order->total_price, 2) }}</td>
                            <td class="border-secondary">
                                <span class="badge border border-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'danger') }} bg-dark text-uppercase small px-3">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="border-secondary">
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-danger px-3 fw-bold">VIEW DETAILS</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<style>
    .text-crimson { color: crimson; }
    .table-hover tbody tr:hover {
        background: rgba(220, 20, 60, 0.05) !important;
    }
</style>
@endsection

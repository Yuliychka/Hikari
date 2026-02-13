@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Order #{{ $order->id }}</h2>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">Back to Orders</a>
    </div>

    <div class="row">
        <!-- Order Items -->
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Items</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center py-2">
                                            <img src="{{ $item->product->image }}" alt="" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                            <div>
                                                <h6 class="mb-0">{{ $item->product->name }}</h6>
                                                <small class="text-muted">SKU: {{ $item->product->sku }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>${{ $item->price }}</td>
                                    <td>x{{ $item->quantity }}</td>
                                    <td class="text-end pe-4 fw-bold">${{ $item->price * $item->quantity }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Summary & Info -->
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Status</span>
                        <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Payment Method</span>
                        <span>{{ ucfirst($order->payment_method) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Date</span>
                        <span>{{ $order->created_at->format('M d, Y') }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total</span>
                        <span>${{ $order->total_price }}</span>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Shipping Address</h5>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $order->shipping_address }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

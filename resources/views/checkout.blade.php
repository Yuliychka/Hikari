@extends('layouts.frontend')

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="glass-card p-4 mb-4" style="background: rgba(0,0,0,0.8); border: 2px solid crimson;">
                <h2 class="section-header text-start mb-4" style="font-size: 2.5rem;">Shipping Information</h2>
                
                <form action="{{ route('orders.store') }}" method="POST" id="checkout-form">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label text-white-50 small text-uppercase fw-bold">Full Name</label>
                        <input type="text" class="form-control bg-dark text-white border-crimson" value="{{ auth()->user()->name }}" readonly>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="form-label text-white-50 small text-uppercase fw-bold">Delivery Fortress (Address)</label>
                        <textarea class="form-control bg-dark text-white border-crimson @error('address') is-invalid @enderror" id="address" name="address" rows="3" required>{{ old('address', auth()->user()->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <h2 class="section-header text-start mb-4 mt-5" style="font-size: 2rem;">Payment Method</h2>
                    <div class="payment-selection">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="payment-option w-100 h-100" for="cod">
                                    <input type="radio" name="payment_method" id="cod" value="cod" checked>
                                    <div class="payment-card p-3 text-center h-100">
                                        <i class="bi bi-truck fs-1 mb-2 d-block"></i>
                                        <span class="fw-bold">CASH ON DELIVERY</span>
                                        <small class="d-block text-white-50 mt-1">Pay when your order arrives</small>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="payment-option w-100 h-100" for="card">
                                    <input type="radio" name="payment_method" id="card" value="card">
                                    <div class="payment-card p-3 text-center h-100">
                                        <i class="bi bi-credit-card fs-1 mb-2 d-block"></i>
                                        <span class="fw-bold">CREDIT / DEBIT CARD</span>
                                        <small class="d-block text-white-50 mt-1">Secure payment via vault</small>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-end">
                        <a href="{{ route('cart.index') }}" class="btn btn-link text-secondary text-decoration-none me-3">Back to Vault</a>
                        <button type="submit" class="btn btn-danger btn-lg rounded-0 px-5 fw-bold border-2 border-white shadow-lg">FINALIZE ORDER</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="glass-card p-4" style="background: rgba(220, 20, 60, 0.05); border: 2px solid crimson;">
                <h3 class="fw-bold mb-4" style="font-family: 'Kaushan Script', cursive; color: crimson;">Order Summary</h3>
                <div class="order-items-list mb-4">
                    @php $subtotal = 0; @endphp
                    @foreach($cartItems as $item)
                    @php $subtotal += $item->product->price * $item->quantity; @endphp
                    <div class="d-flex justify-content-between mb-3 border-bottom border-dark pb-2">
                        <div>
                            <div class="fw-bold small text-uppercase">{{ $item->product->name }}</div>
                            <div class="text-white-50 x-small">Quantity: {{ $item->quantity }}</div>
                        </div>
                        <div class="fw-bold">${{ number_format($item->product->price * $item->quantity, 2) }}</div>
                    </div>
                    @endforeach
                </div>

                <div class="summary-details">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-white-50">Subtotal</span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>
                    @php 
                        $discount = 0;
                        if (session()->has('coupon')) {
                            $coupon = session('coupon');
                            $discount = ($coupon['type'] == 'fixed') ? $coupon['value'] : ($subtotal * $coupon['value'] / 100);
                        }
                        $shipping = ($subtotal > 100 || $subtotal == 0) ? 0 : 15;
                        $total = max(0, ($subtotal + $shipping) - $discount);
                    @endphp
                    @if($discount > 0)
                    <div class="d-flex justify-content-between mb-2 text-success fw-bold">
                        <span>Discount ({{ session('coupon.code') }})</span>
                        <span>-${{ number_format($discount, 2) }}</span>
                    </div>
                    @endif
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-white-50">Shipping</span>
                        <span>{{ $shipping == 0 ? 'FREE' : '$' . number_format($shipping, 2) }}</span>
                    </div>
                    <hr class="border-secondary opacity-25">
                    <div class="d-flex justify-content-between">
                        <h4 class="fw-bold">TOTAL</h4>
                        <h4 class="fw-bold text-crimson">${{ number_format($total, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .payment-option input {
        display: none;
    }
    .payment-card {
        border: 2px solid rgba(220, 20, 60, 0.3);
        background: rgba(255, 255, 255, 0.05);
        cursor: pointer;
        transition: all 0.3s;
    }
    .payment-option input:checked + .payment-card {
        border-color: crimson;
        background: rgba(220, 20, 60, 0.2);
        box-shadow: 0 0 20px rgba(220, 20, 60, 0.3);
    }
    .payment-card i { color: crimson; }
    .text-crimson { color: crimson; }
    .border-crimson { border-color: rgba(220, 20, 60, 0.5) !important; }
    .x-small { font-size: 0.7rem; }
</style>
@endsection

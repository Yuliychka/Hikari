@extends('layouts.frontend')

@php
    $title = 'Shopping Vault - Hikari Anime Store';
@endphp

@push('styles')
    <style>
        .glitch {
            position: relative;
            color: crimson;
            font-family: 'Kaushan Script', cursive;
            font-size: 3rem;
            text-align: center;
        }
        .glitch::before, .glitch::after {
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #0b0b0b;
        }
        .glitch::before {
            left: 2px;
            text-shadow: -1px 0 red;
            background: transparent;
            animation: glitch-anim-1 2s infinite linear alternate-reverse;
        }
        .glitch::after {
            left: -2px;
            text-shadow: -1px 0 blue;
            background: transparent;
            animation: glitch-anim-2 3s infinite linear alternate-reverse;
        }
        @keyframes glitch-anim-1 {
            0% { clip-path: inset(20% 0 80% 0); }
            100% { clip-path: inset(30% 0 20% 0); }
        }
        @keyframes glitch-anim-2 {
            0% { clip-path: inset(10% 0 60% 0); }
            100% { clip-path: inset(0% 0 80% 0); }
        }

        .cart-item-panel {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(220, 20, 60, 0.1);
            border-left: 4px solid crimson;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .cart-item-panel:hover {
            background: rgba(220, 20, 60, 0.05);
            border-color: rgba(220, 20, 60, 0.4);
            transform: translateX(10px);
        }

        .cart-image-wrapper {
            width: 100px;
            height: 100px;
            border: 2px solid crimson;
            padding: 3px;
            background: #000;
            overflow: hidden;
        }
        .cart-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .cart-item-panel:hover .cart-image-wrapper img {
            transform: scale(1.1);
        }

        .item-price-glow {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            color: #fff;
            text-shadow: 0 0 10px rgba(220, 20, 60, 0.5);
            font-size: 1.25rem;
        }

        .summary-panel {
            background: rgba(0, 0, 0, 0.9);
            border: 2px solid crimson;
            padding: 2rem;
            position: sticky;
            top: 120px;
            box-shadow: 0 0 30px rgba(220, 20, 60, 0.2);
        }

        .kanji-bg {
            position: absolute;
            font-size: 12rem;
            color: rgba(220, 20, 60, 0.03);
            font-weight: 900;
            z-index: -1;
            pointer-events: none;
        }

        .btn-hikari {
            background: crimson;
            color: white;
            border: none;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 1rem;
            transition: all 0.3s ease;
            border-radius: 0;
            position: relative;
            overflow: hidden;
        }
        .btn-hikari:hover {
            background: #fff;
            color: crimson;
            box-shadow: 0 0 20px rgba(220, 20, 60, 0.5);
        }

        .quantity-input {
            background: #000;
            color: #fff;
            border: 1px solid crimson;
            text-align: center;
            width: 80px;
            border-radius: 0;
        }

        .empty-cart-state {
            padding: 5rem 0;
            text-align: center;
            border: 2px dashed rgba(220, 20, 60, 0.3);
            background: rgba(220, 20, 60, 0.02);
        }

        .btn-outline-crimson {
            border: 1px solid crimson;
            color: crimson;
            background: transparent;
            transition: all 0.3s;
        }
        .btn-outline-crimson:hover {
            background: crimson;
            color: #fff;
            box-shadow: 0 0 15px rgba(220, 20, 60, 0.5);
        }
        .hover-white:hover {
            color: #fff !important;
        }
    </style>
@endpush

@section('content')
<div class="container py-5 position-relative">
    <div class="kanji-bg" style="top: -50px; right: -50px;">蔵</div>
    
    <header class="text-center mb-5" data-aos="fade-down">
        <h1 class="glitch" data-text="SHOPPING VAULT">SHOPPING VAULT</h1>
        <div class="mx-auto mt-2" style="width: 100px; height: 3px; background: crimson;"></div>
    </header>

    @if($cartItems->count() > 0)
        <div class="row g-5">
            <!-- Items List -->
            <div class="col-lg-8" data-aos="fade-right">
                @foreach($cartItems as $item)
                    <div class="cart-item-panel" id="cart-item-{{ $item->id }}">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="cart-image-wrapper">
                                    <img src="{{ Str::startsWith($item->product->image, 'http') ? $item->product->image : asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                                </div>
                            </div>
                            <div class="col">
                                <h5 class="fw-bold mb-1 text-uppercase" style="letter-spacing: 1px;">{{ $item->product->name }}</h5>
                                <div class="text-secondary small mb-3">Unit Price: ${{ number_format($item->product->price, 2) }}</div>
                                
                                <div class="d-flex align-items-center gap-3">
                                    <div class="input-group input-group-sm" style="width: 130px; border: 1px solid crimson;">
                                        <button class="btn btn-outline-crimson bg-black text-white border-0 qty-btn" data-action="decrease" data-id="{{ $item->id }}">-</button>
                                        <input type="number" id="qty-{{ $item->id }}" value="{{ $item->quantity }}" min="1" class="form-control bg-black text-white border-0 text-center qty-input" readonly>
                                        <button class="btn btn-outline-crimson bg-black text-white border-0 qty-btn" data-action="increase" data-id="{{ $item->id }}">+</button>
                                    </div>
                                    
                                    <button type="button" class="btn btn-link text-danger text-decoration-none small p-0 fw-bold hover-white ajax-cart-remove" data-id="{{ $item->id }}">
                                        <i class="bi bi-trash me-1"></i> REMOVE
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-auto text-end mt-3 mt-md-0">
                                <div class="item-price-glow" id="subtotal-{{ $item->id }}">${{ number_format($item->product->price * $item->quantity, 2) }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Coupon Section -->
                <div class="cart-item-panel mt-4" style="border-left: 4px solid #fff;">
                    <form id="coupon-form" action="{{ route('cart.coupon') }}" method="POST" class="row g-3 align-items-center">
                        @csrf
                        <div class="col-md-6">
                            <h6 class="text-uppercase fw-bold mb-0"><i class="bi bi-tag-fill text-crimson me-2"></i> Have a coupon?</h6>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="code" class="form-control bg-black text-white border-crimson rounded-0" placeholder="ENTER CODE">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-outline-crimson w-100 rounded-0 fw-bold">APPLY</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Summary Sidebar -->
            <div class="col-lg-4" data-aos="fade-left">
                <div class="summary-panel text-white">
                    <h4 class="fw-bold mb-4 text-uppercase border-bottom border-crimson pb-2" style="font-family: 'Kaushan Script', cursive;">Vault Summary</h4>
                    
                    <div class="d-flex justify-content-between mb-3 text-secondary">
                        <span>Cart Subtotal</span>
                        <span id="cart-subtotal">${{ number_format($subtotal, 2) }}</span>
                    </div>

                    <div id="discount-row" class="d-flex justify-content-between mb-3 text-success fw-bold {{ $discount > 0 ? '' : 'd-none' }}">
                        <span>Coupon Discount</span>
                        <span id="cart-discount">-&dollar;{{ number_format($discount, 2) }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3 text-secondary">
                        <span>Shipping Est.</span>
                        <span id="cart-shipping" class="{{ $shipping == 0 ? 'text-success fw-bold' : '' }}">
                            {{ $shipping == 0 ? 'FREE' : '$' . number_format($shipping, 2) }}
                        </span>
                    </div>
                    
                    <hr class="border-secondary my-4">
                    
                    <div class="d-flex justify-content-between mb-5">
                        <h4 class="fw-bold">TOTAL</h4>
                        <h4 class="fw-bold text-crimson item-price-glow" id="cart-total">${{ number_format($total, 2) }}</h4>
                    </div>

                    <a href="{{ route('orders.checkout') }}" class="btn btn-hikari w-100">
                        PROCEED TO CHECKOUT <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                    
                    <div class="mt-4 text-center">
                        <a href="{{ route('products.index') }}" class="text-secondary small text-decoration-none hover-crimson">
                            <i class="bi bi-arrow-left me-1"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="empty-cart-state" data-aos="zoom-in">
            <h2 class="display-6 fw-bold mb-3" style="font-family: 'Kaushan Script', cursive;">The Vault is Empty</h2>
            <p class="text-secondary mb-5">Your legendary collection hasn't started yet.</p>
            <a href="{{ route('products.index') }}" class="btn btn-hikari px-5">
                DISCOVER PRODUCTS
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const couponForm = document.getElementById('coupon-form');
        if (couponForm) {
            couponForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const code = formData.get('code');
                
                try {
                    const response = await fetch("{{ route('cart.coupon') }}", {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ code: code })
                    });
                    
                    const data = await response.json();
                    
                    if (data.status === 'success') {
                        // Update UI
                        document.getElementById('cart-subtotal').textContent = '$' + data.cart_subtotal;
                        document.getElementById('cart-discount').textContent = '-$' + data.discount;
                        document.getElementById('discount-row').classList.remove('d-none');
                        document.getElementById('cart-shipping').textContent = data.shipping;
                        if (data.shipping === 'FREE') document.getElementById('cart-shipping').classList.add('text-success', 'fw-bold');
                        document.getElementById('cart-total').textContent = '$' + data.total;
                        
                        showHikariToast(data.message);
                    } else {
                        showHikariToast(data.message, 'error');
                    }
                } catch (error) {
                    console.error('Error applying coupon:', error);
                    showHikariToast('Failed to connect to the vault.', 'error');
                }
            });
        }
    });
</script>
@endpush

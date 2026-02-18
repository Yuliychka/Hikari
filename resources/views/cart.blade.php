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
                @php $total = 0; @endphp
                @foreach($cartItems as $item)
                    @php $subtotal = $item->product->price * $item->quantity; $total += $subtotal; @endphp
                    <div class="cart-item-panel">
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
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group input-group-sm" style="width: 130px;">
                                            <span class="input-group-text bg-black text-crimson border-crimson rounded-0">QTY</span>
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control quantity-input" onchange="this.form.submit()">
                                        </div>
                                    </form>
                                    
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger text-decoration-none small p-0 fw-bold">
                                            <i class="bi bi-x-circle me-1"></i> REMOVE
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-auto text-end mt-3 mt-md-0">
                                <div class="item-price-glow">${{ number_format($subtotal, 2) }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Summary Sidebar -->
            <div class="col-lg-4" data-aos="fade-left">
                <div class="summary-panel text-white">
                    <h4 class="fw-bold mb-4 text-uppercase border-bottom border-crimson pb-2" style="font-family: 'Kaushan Script', cursive;">Vault Summary</h4>
                    
                    <div class="d-flex justify-content-between mb-3 text-secondary">
                        <span>Subtotal</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 text-secondary">
                        <span>Shipping</span>
                        <span class="text-success fw-bold">FREE</span>
                    </div>
                    
                    <hr class="border-secondary my-4">
                    
                    <div class="d-flex justify-content-between mb-5">
                        <h4 class="fw-bold">TOTAL</h4>
                        <h4 class="fw-bold text-crimson item-price-glow">${{ number_format($total, 2) }}</h4>
                    </div>

                    <a href="#" class="btn btn-hikari w-100">
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

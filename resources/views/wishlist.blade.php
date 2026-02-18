@extends('layouts.frontend')

@php
    $title = "Heart's Desire - Hikari Anime Store";
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


        .kanji-bg {
            position: absolute;
            font-size: 15rem;
            color: rgba(220, 20, 60, 0.03);
            font-weight: 900;
            z-index: -1;
            pointer-events: none;
        }

        .wishlist-empty {
            padding: 5rem 0;
            text-align: center;
            background: rgba(220, 20, 60, 0.02);
            border: 2px dashed crimson;
        }

        .btn-hikari {
            background: crimson;
            color: white;
            border: none;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 0.6rem 1.2rem;
            transition: all 0.3s ease;
            border-radius: 0;
        }
        .btn-hikari:hover {
            background: #fff;
            color: crimson;
        }

        .btn-outline-hikari {
            background: transparent;
            color: #000;
            border: 2px solid #000;
            font-weight: 800;
            text-transform: uppercase;
            padding: 0.6rem 1.2rem;
            transition: all 0.3s ease;
            border-radius: 0;
        }
        .btn-outline-hikari:hover {
            background: #000;
            color: #fff;
        }
    </style>
@endpush

@section('content')
<div class="container py-5 position-relative">
    <div class="kanji-bg" style="top: 0; left: -100px;">愛</div>

    <header class="text-center mb-5" data-aos="fade-down">
        <h1 class="glitch" data-text="HEART'S DESIRE">HEART'S DESIRE</h1>
        <p class="text-secondary small mt-2">Personal Collection & Curated Masterpieces</p>
    </header>

    @if($wishlistItems->count() > 0)
        <div class="row g-4">
            @foreach($wishlistItems as $item)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    @include('partials.product-card', [
                        'product' => $item->product,
                        'delay' => $loop->iteration * 50,
                        'badge' => 'DESIRED',
                        'badgeClass' => 'bg-danger text-white'
                    ])
                </div>
            @endforeach
        </div>
    @else
        <div class="wishlist-empty" data-aos="zoom-in">
            <h2 class="display-6 fw-bold mb-3" style="font-family: 'Kaushan Script', cursive; color: #fff;">DESIRE IS SILENT</h2>
            <p class="text-secondary mb-5">Your heart's list is currently empty. Explore the vault for inspiration.</p>
            <a href="{{ route('products.index') }}" class="btn btn-hikari px-5">
                START EXPLORING
            </a>
        </div>
    @endif
</div>
@endsection

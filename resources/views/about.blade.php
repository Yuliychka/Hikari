@extends('layouts.frontend')

@php
    $title = 'About Us - Hikari Anime Store';
@endphp

@push('styles')
    <style>
        /* Glitch Effect */
        .glitch {
            position: relative;
            color: crimson;
            font-family: 'Kaushan Script', cursive;
            font-size: 3.5rem;
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
            20% { clip-path: inset(60% 0 10% 0); }
            40% { clip-path: inset(40% 0 50% 0); }
            60% { clip-path: inset(80% 0 5% 0); }
            80% { clip-path: inset(10% 0 70% 0); }
            100% { clip-path: inset(30% 0 20% 0); }
        }
        @keyframes glitch-anim-2 {
            0% { clip-path: inset(10% 0 60% 0); }
            20% { clip-path: inset(30% 0 20% 0); }
            40% { clip-path: inset(70% 0 40% 0); }
            60% { clip-path: inset(20% 0 50% 0); }
            80% { clip-path: inset(50% 0 10% 0); }
            100% { clip-path: inset(0% 0 80% 0); }
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(220, 20, 60, 0.2);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            transition: all 0.4s ease;
            position: relative;
            z-index: 2;
        }
        .glass-panel:hover {
            border-color: rgba(220, 20, 60, 0.5);
            box-shadow: 0 0 20px rgba(220, 20, 60, 0.2);
        }

        .kanji-bg {
            position: absolute;
            font-size: 15rem;
            color: rgba(220, 20, 60, 0.05);
            font-weight: 900;
            z-index: 1;
            pointer-events: none;
            user-select: none;
        }

        .crimson-line {
            height: 3px;
            width: 80px;
            background: crimson;
            margin: 1.2rem 0;
        }

        .accent-text {
            color: crimson;
            font-family: 'Kaushan Script', cursive;
            font-size: 1.3rem;
        }

        /* Brand Image Grid */
        .brand-card {
            border: 2px solid crimson;
            padding: 8px;
            background: #000;
            box-shadow: 0 0 20px rgba(220, 20, 60, 0.2);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            max-width: 250px;
            margin: auto;
            position: relative;
            overflow: hidden;
        }
        .brand-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            filter: grayscale(30%);
            transition: all 0.5s ease;
        }
        .brand-card:hover {
            transform: translateY(-10px) rotate(2deg);
            box-shadow: 0 0 40px rgba(220, 20, 60, 0.4);
            z-index: 10;
        }
        .brand-card:hover img {
            filter: grayscale(0%);
            transform: scale(1.1);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
            100% { transform: translateY(0px); }
        }
    </style>
@endpush

@section('content')
<div class="container py-5 position-relative">
    <div class="kanji-bg floating" style="top: -50px; right: -50px;">光</div>
    <div class="kanji-bg floating" style="bottom: 0; left: -100px; opacity: 0.03;">魂</div>

    <div class="row align-items-center mb-5 g-5">
        <div class="col-lg-7" data-aos="fade-right">
            <h1 class="glitch mb-4 mt-5" data-text="ABOUT HIKARI" style="text-align: left;">ABOUT HIKARI</h1>
            <div class="glass-panel">
                <p class="accent-text mb-2">Passion Meets Precision</p>
                <div class="crimson-line"></div>
                <p class="lead mb-4">Born from a deep love for Japanese animation and culture, Hikari is more than just a store—it's a sanctuary for collectors.</p>
                <p class="text-secondary small">We strive to bring you the finest collection of anime merchandise. From masterfully forged katanas to rare limited-edition figures and stylish apparel, every item in our vault is curated for the true otaku who demands visual excellence.</p>
                <p class="text-secondary small">Our mission is simple: to help you express your fandom with the pride, style, and quality it deserves. Arigato for being part of our legacy.</p>
            </div>
        </div>
        
        <div class="col-lg-5" data-aos="fade-left">
            <div class="row g-3 mt-5">
                <div class="col-6">
                    <div class="brand-card floating" style="animation-delay: 0s;">
                        <img src="{{ asset('storage/site-assets/about/brand_wave.png') }}" alt="Theme Asset" class="img-fluid rounded">
                    </div>
                </div>
                <div class="col-6 mt-4">
                    <div class="brand-card floating" style="animation-delay: 1.5s;">
                        <img src="{{ asset('storage/site-assets/about/brand_torii.png') }}" alt="Theme Asset" class="img-fluid rounded">
                    </div>
                </div>
                <div class="col-12 text-center mt-3">
                     <div class="px-4 py-2 border border-danger d-inline-block bg-black text-white fw-bold small">
                        EST. 2025
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-center mt-5 mb-5" data-aos="zoom-in">
        <div class="col-12">
            <p class="accent-text">Join the Brotherhood</p>
            <h2 class="display-5 fw-bold mb-4" style="font-family: 'Kaushan Script', cursive; color: #fff;">Arigato Gozaimasu</h2>
            <div class="section-divider mx-auto" style="width: 150px; height: 3px; background: linear-gradient(90deg, transparent, crimson, transparent);"></div>
        </div>
    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hikari Anime Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- CSS for theme -->
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <!-- Expanding Cards -->
    <link rel="stylesheet" href="{{ asset('css/Expanding Cards.css') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #111; /* Match theme black */
            color: #fff;
            overflow-x: hidden;
            position: relative;
            cursor: crosshair; /* Fallback */
        }
        
        /* Custom Cursor - Using a simple crosshair or custom image if available */
        /* For a real katana cursor, we'd need a valid URL. Using a stylish crosshair for now */
        body, a, button {
            cursor: url('https://cdn.custom-cursor.com/db/cursor/32/katana_cursor.png'), auto !important;
        }

        /* Marvel-Style Manga Intro */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000;
            z-index: 99999;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            transition: opacity 0.5s ease-out;
            /* Fail-safe: Auto-hide after 5s even if JS crashes */
            animation: preloaderFailsafe 0.5s ease-out 5s forwards;
            pointer-events: all;
        }
        @keyframes preloaderFailsafe {
            99% { opacity: 1; visibility: visible; }
            100% { opacity: 0; visibility: hidden; pointer-events: none; }
        }

        .manga-panel {
            position: absolute;
            background-size: cover;
            background-position: center;
            opacity: 0;
            filter: grayscale(100%) contrast(1.2);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
            border: 2px solid #fff;
            animation: flashPanel 0.15s linear;
        }

        /* Random Positions for Panels (Simulated via js or predetermined classes) */
        /* We will use JS to generate these for randomness */

        .loading-text-marvel {
            position: absolute;
            bottom: 20%;
            font-family: 'Kaushan Script', cursive;
            font-size: 4rem;
            color: crimson;
            text-transform: uppercase;
            letter-spacing: 10px;
            font-weight: 900;
            z-index: 100;
            text-shadow: 2px 2px 0 #fff;
            opacity: 0;
            animation: fadeInText 0.5s ease-out forwards 1.5s;
        }

        @keyframes flashPanel {
            0% { opacity: 0; transform: scale(1.1); }
            50% { opacity: 1; transform: scale(1); }
            100% { opacity: 0; transform: scale(1); }
        }

        @keyframes fadeInText {
            to { opacity: 1; transform: scale(1.1); }
        }

        /* CustomScrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #1a1a1a;
        }
        ::-webkit-scrollbar-thumb {
            background: crimson;
            border-radius: 5px;
        }

        /* Sakura Animation */
        .sakura-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 9999;
            overflow: hidden;
        }
        .sakura {
            position: absolute;
            background: rgba(255, 183, 197, 0.6);
            border-radius: 100% 0 100% 0;
            animation: fall linear infinite;
        }
        @keyframes fall {
            0% { opacity: 0; top: -10%; transform: translateX(0) rotate(0deg); }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; top: 110%; transform: translateX(20px) rotate(360deg); }
        }

        /* Glitch Effect */
        .glitch {
            position: relative;
            color: crimson;
        }
        .glitch::before, .glitch::after {
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #111; /* Match background to hide original */
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

        /* Floating Animation */
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        /* Product Card Styles */
        .anime-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(220, 20, 60, 0.3);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            transition: all 0.4s ease;
            overflow: hidden;
            position: relative;
        }
        .anime-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(220, 20, 60, 0.2), transparent);
            transition: 0.5s;
        }
        .anime-card:hover::before {
            left: 100%;
        }
        .anime-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 0 20px rgba(220, 20, 60, 0.6);
            border-color: crimson;
        }
        .anime-card .card-img-top {
            height: 250px;
            object-fit: cover;
            transition: transform 0.6s;
        }
        .anime-card:hover .card-img-top {
            transform: scale(1.1);
        }
        .anime-card .card-body {
            padding: 1.5rem;
            position: relative;
            z-index: 2;
            background: linear-gradient(to top, #000 0%, transparent 100%);
        }
        .anime-card .card-title {
            font-family: 'Kaushan Script', cursive;
            color: #fff;
            font-size: 1.5rem;
        }
        .anime-card .price {
            color: crimson;
            font-weight: bold;
            font-size: 1.3rem;
            text-shadow: 0 0 10px rgba(220, 20, 60, 0.5);
        }
        
        /* Section Dividers */
        .section-divider {
            height: 5px;
            background: linear-gradient(90deg, transparent, crimson, transparent);
            margin: 4rem 0;
            opacity: 0.7;
        }
        
        .section-header {
            font-family: 'Kaushan Script', cursive;
            text-align: center;
            font-size: 3.5rem;
            color: crimson;
            margin-bottom: 3rem;
            text-shadow: 2px 2px 4px #000;
        }

        /* MANGA STYLE CARD */
        .manga-card {
            background: #fff;
            color: #000;
            border: 4px solid #000;
            box-shadow: 10px 10px 0 #000;
            transition: transform 0.3s;
            position: relative;
            overflow: hidden;
        }
        .manga-card:hover {
            transform: translate(-5px, -5px);
            box-shadow: 15px 15px 0 #000;
        }
        .manga-card .card-img-top {
            filter: grayscale(100%) contrast(1.2);
            transition: filter 0.4s;
            border-bottom: 4px solid #000;
        }
        .manga-card:hover .card-img-top {
            filter: grayscale(0%) contrast(1);
        }
        .manga-card .card-body {
            background: repeating-linear-gradient(
                45deg,
                #fff,
                #fff 10px,
                #eee 10px,
                #eee 20px
            );
        }
        .manga-card .card-title {
            font-family: 'Kaushan Script', cursive; /* Keeping the script font or maybe a bolder comic font if available */
            font-weight: bold;
            text-transform: uppercase;
            color: #000;
            text-shadow: 2px 2px 0 #ccc;
        }
        .manga-card .price {
            color: #000; /* Distinct from the crypto/red theme */
            background: #ffcc00; /* Comic book yellow */
            padding: 2px 8px;
            border: 2px solid #000;
            font-weight: 900;
            box-shadow: 3px 3px 0 #000;
            text-shadow: none;
        }
        
        /* BEST SELLER STYLE CARD (Fire/Premium) */
        .bestseller-card {
            background: linear-gradient(135deg, #2a0000 0%, #000 100%);
            border: 2px solid #ff4500;
            box-shadow: 0 0 15px rgba(255, 69, 0, 0.5);
            transition: all 0.4s ease;
        }
        .bestseller-card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(255, 69, 0, 0.8), 0 0 10px #ffcc00;
            border-color: #ffcc00;
        }
        .bestseller-card .card-body {
            background: rgba(0,0,0,0.8);
        }
        .bestseller-card .card-title {
            background: -webkit-linear-gradient(#ffcc00, #ff4500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }
        .fire-badge {
            background: linear-gradient(to bottom, #ffcc00, #ff4500);
            color: #000;
            font-weight: bold;
            border: 2px solid #fff;
            animation: burn 1s infinite alternate;
        }
        @keyframes burn {
            from { box-shadow: 0 0 5px #ff4500; }
            to { box-shadow: 0 0 15px #ffcc00, 0 0 5px #fff; }
        }
    </style>
</head>

    <!-- Marvel-Style Manga Intro -->
    <div id="preloader">
        <div id="manga-container"></div>
        <div class="loading-text-marvel">HIKARI</div>
    </div>

    <div class="sakura-container"></div>

@include("additions.navbar")

    <!-- Samurai Hero Section (Restored) -->
    <section class="hero">
        <div class="hero-bg-container">
            @if(isset($heroBanner) && $heroBanner)
                <img src="{{ Str::startsWith($heroBanner->image_path, 'http') ? $heroBanner->image_path : asset($heroBanner->image_path) }}" class="hero-bg m-img" alt="{{ $heroBanner->title }}">
            @else
                <img src="{{ asset('images/Q.gif') }}" class="hero-bg m-img" alt="Anime Background">
            @endif
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);"></div>
        </div>

        <div class="hero-content" data-aos="fade-up" data-aos-duration="1500">
            <h1 class="japanese-c hero-title glitch" data-text="{{ isset($heroBanner) ? $heroBanner->title : 'Konnichiwa!' }}">{{ isset($heroBanner) ? $heroBanner->title : 'Konnichiwa!' }}</h1>
            <h2 class="japanese-p hero-subtitle">Explore the spirit of Japan through anime</h2>
            <p class="japanese-w hero-description">Mangas, Katanas, Hoodies, Mugs and more <br> bring the anime spirit home</p>
            <a href="{{ route('products.index') }}" class="hero-btn-link">
                <button type="button" class="btn btn-outline-danger hero-btn">
                    <b>参 しませ (Shop Now)</b>
                </button>
            </a>
        </div>
    </section>

    <!-- Expanding Cards Section -->
    
    <div class="section-divider"></div>

    <!-- Featured Products -->
    <!-- Featured Products (Renamed to New Arrivals for logic, or keep as Featured) -->
    <!-- Let's use the fetched $newArrivals for a "New Arrivals" section and $featured for the main grid -->

    <section class="container py-5">
        <h2 class="section-header" data-aos="zoom-in">New Arrivals</h2>
        <div class="row g-4">
            @if(isset($newArrivals) && count($newArrivals) > 0)
            @foreach($newArrivals as $index => $product)
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="card manga-card h-100">
                    <span class="position-absolute top-0 start-0 m-2 badge bg-dark text-white border border-dark rounded-0" style="z-index:10; font-family:'Courier New', monospace; font-weight:bold;">NEW CHAPTER</span>
                    <div class="overflow-hidden">
                        <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title text-truncate">{{ $product->name }}</h5>
                            <p class="card-text small text-truncate" style="color: #333; font-weight: 600;">{{ $product->description }}</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="price">${{ $product->price }}</span>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-dark rounded-0 fw-bold border-2 border-dark" style="box-shadow: 3px 3px 0 #000;">READ MORE</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-12 text-center text-white-50">
                <p>No new arrivals at the moment.</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Promotion Banner -->
    @php
        $promoBg = isset($promoBanner) && $promoBanner ? 
            (Str::startsWith($promoBanner->image_path, 'http') ? $promoBanner->image_path : asset($promoBanner->image_path)) : 
            'https://images.unsplash.com/photo-1541562232579-512a21360020?q=80&w=1920&auto=format&fit=crop';
        $promoTitle = isset($promoBanner) && $promoBanner->title ? $promoBanner->title : 'Limited Time Flash Sale!';
    @endphp
    <div class="container-fluid py-5 my-5" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ $promoBg }}'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="container text-center text-white" data-aos="zoom-in">
            <h2 class="display-4 font-weight-bold" style="font-family: 'Kaushan Script', cursive; text-shadow: 0 0 10px crimson;">{{ $promoTitle }}</h2>
            <p class="lead mb-4">Get 50% off on selected items. Don't miss out!</p>
            <div class="d-flex justify-content-center mb-4">
                <div class="px-4 py-2 mx-2 bg-dark rounded border border-danger">
                    <h3 id="hours" class="m-0 text-danger">05</h3>
                    <small>Hours</small>
                </div>
                <div class="px-4 py-2 mx-2 bg-dark rounded border border-danger">
                    <h3 id="minutes" class="m-0 text-danger">00</h3>
                    <small>Mins</small>
                </div>
                <div class="px-4 py-2 mx-2 bg-dark rounded border border-danger">
                    <h3 id="seconds" class="m-0 text-danger">00</h3>
                    <small>Secs</small>
                </div>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-danger btn-lg rounded-pill px-5 pulse-btn">Shop Sale Now</a>
        </div>
    </div>

    <!-- Best Sellers -->
    <section class="container py-5">
        <h2 class="section-header" data-aos="zoom-in">Best Sellers</h2>
        <div class="row g-4">
            @if(isset($bestSellers) && count($bestSellers) > 0)
            @foreach($bestSellers as $index => $product)
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="card bestseller-card h-100">
                    <span class="badge position-absolute top-0 start-0 m-2 fire-badge rounded-circle p-2">HOT</span>
                    <div class="overflow-hidden rounded-top">
                        <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title text-truncate">{{ $product->name }}</h5>
                            <p class="card-text text-white-50 small text-truncate">{{ $product->description }}</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="text-warning fw-bold fs-5">${{ $product->price }}</span>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3">View</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
             <div class="col-12 text-center text-white-50">
                <p>Best sellers coming soon.</p>
            </div>
            @endif
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- Otaku's Choice Spotlight -->
    @if(isset($otakuChoice) && $otakuChoice)
    <section class="container py-5 mb-5">
        <div class="row align-items-center">
            <div class="col-md-6" data-aos="fade-right">
                <img src="{{ Str::startsWith($otakuChoice->image, 'http') ? $otakuChoice->image : asset('storage/' . $otakuChoice->image) }}" class="img-fluid rounded shadow-lg border border-danger" alt="Otaku Choice" style="max-height: 500px; width: 100%; object-fit: cover;">
            </div>
            <div class="col-md-6 text-center text-md-start ps-md-5" data-aos="fade-left">
                <h4 class="text-danger text-uppercase letter-spacing-2">Otaku's Choice</h4>
                <h2 class="display-4 fw-bold mb-3" style="font-family: 'Kaushan Script', cursive;">{{ $otakuChoice->name }}</h2>
                <p class="lead text-white-50 mb-4">{{ $otakuChoice->description }}</p>
                <p class="h3 text-danger mb-4">${{ $otakuChoice->price }}</p>
                <a href="{{ route('products.show', $otakuChoice->id) }}" class="btn btn-outline-light btn-lg rounded-pill px-5">Check it Out</a>
            </div>
        </div>
    </section>
    @endif

    <!-- All Products Link -->
    <div class="text-center mt-5 mb-5" data-aos="fade-up">
        <a href="{{ route('products.index') }}" class="btn btn-outline-danger btn-lg px-5 rounded-pill" style="border-width: 2px;">
            View Full Collection
        </a>
    </div>

    <div class="section-divider"></div>

    <!-- Categories Section -->
    <section class="container py-5 mb-5">
        <h2 class="section-header" data-aos="zoom-in">Categories</h2>
        <div class="row g-4">
            @if(isset($categoryBanners) && $categoryBanners->count() > 0)
                @foreach($categoryBanners as $index => $banner)
                <div class="col-md-4" data-aos="flip-left" data-aos-delay="{{ $index * 200 }}">
                    <div class="anime-card p-0 floating" style="height: 200px; animation-delay: {{ $index }}s;">
                        <img src="{{ Str::startsWith($banner->image_path, 'http') ? $banner->image_path : asset($banner->image_path) }}" class="w-100 h-100 object-fit-cover" style="opacity: 0.6;">
                        <div class="position-absolute top-50 start-50 translate-middle text-center">
                            <h3 class="japanese-p display-4">{{ $banner->title }}</h3>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <!-- Fallback Static Categories if no DB data -->
                <div class="col-md-4" data-aos="flip-left">
                    <div class="anime-card p-0 floating" style="height: 200px;">
                        <img src="https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?q=80&w=1000&auto=format&fit=crop" class="w-100 h-100 object-fit-cover" style="opacity: 0.6;">
                        <div class="position-absolute top-50 start-50 translate-middle text-center">
                            <h3 class="japanese-p display-4">Figures</h3>
                        </div>
                    </div>
                </div>
                 <div class="col-md-4" data-aos="flip-up">
                    <div class="anime-card p-0 floating" style="height: 200px; animation-delay: 1s;">
                        <img src="https://images.unsplash.com/photo-1556905055-8f358a7a47b2?q=80&w=1000&auto=format&fit=crop" class="w-100 h-100 object-fit-cover" style="opacity: 0.6;">
                        <div class="position-absolute top-50 start-50 translate-middle text-center">
                            <h3 class="japanese-p display-4">Apparel</h3>
                        </div>
                    </div>
                </div>
                 <div class="col-md-4" data-aos="flip-right">
                    <div class="anime-card p-0 floating" style="height: 200px; animation-delay: 2s;">
                        <img src="https://images.unsplash.com/photo-1613376023733-0a73315d9b06?q=80&w=1000&auto=format&fit=crop" class="w-100 h-100 object-fit-cover" style="opacity: 0.6;">
                        <div class="position-absolute top-50 start-50 translate-middle text-center">
                            <h3 class="japanese-p display-4">Accessories</h3>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black py-4 mt-auto text-center border-top border-theme-red">
        <p class="mb-0 text-secondary">&copy; {{ date('Y') }} Hikari Anime Store. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Snappy Manga Intro Logic
        document.addEventListener("DOMContentLoaded", function() {
            const container = document.getElementById('manga-container');
            const preloader = document.getElementById('preloader');
            
            const patterns = [
                'radial-gradient(circle, #000 30%, transparent 30%)', 
                'linear-gradient(45deg, #000 25%, transparent 25%, transparent 75%, #000 75%)',
                'repeating-linear-gradient(0deg, transparent, transparent 15px, #000 15px, #000 18px)',
                'conic-gradient(from 0deg, #000 0deg 90deg, transparent 90deg)',
                'url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHdpZHRoPScxMCcgaGVpZ2h0PScxMCc+CiAgPHBhdGggZD0nTSAwIDEwIEwgMTAgMCcgc3Ryb2tlPSdibGFjaycgc3Ryb2tlLXdpZHRoPSIzJy8+Cjwvc3ZnPg==")'
            ];
            
            let count = 0;
            const maxFlashes = 6; // Very few flashes for "instant" feel
            const speed = 60; // Very fast speed

            function createPanel() {
                if (count >= maxFlashes) {
                    finishPreloader();
                    return;
                }

                const panel = document.createElement('div');
                panel.classList.add('manga-panel');
                
                const width = Math.random() * 60 + 40; 
                const height = Math.random() * 60 + 40; 
                const top = Math.random() * 40;
                const left = Math.random() * 40;
                
                panel.style.width = width + '%';
                panel.style.height = height + '%';
                panel.style.top = top + '%';
                panel.style.left = left + '%';
                panel.style.background = patterns[Math.floor(Math.random() * patterns.length)];
                panel.style.backgroundSize = '40px 40px';
                panel.style.backgroundColor = '#fff';
                
                container.appendChild(panel);
                
                setTimeout(() => { panel.remove(); }, 80);

                count++;
                setTimeout(createPanel, speed);
            }

            function finishPreloader() {
                if (preloader.classList.contains('done')) return;
                preloader.classList.add('done');

                setTimeout(() => {
                    preloader.style.opacity = '0';
                    setTimeout(() => {
                        preloader.style.display = 'none';
                        AOS.init({ once: true, mirror: false });
                    }, 300);
                }, 300); 
            }

            setTimeout(createPanel, 50);
            setTimeout(finishPreloader, 2000); // Fail-safe 2s now
        });

        // Sakura Falling Effect

        // Sakura Falling Effect
        const sakuraContainer = document.querySelector('.sakura-container');
        let sakuraInterval;

        const createSakura = () => {
            const sakura = document.createElement('div');
            sakura.classList.add('sakura');
            sakura.style.left = Math.random() * 100 + 'vw';
            sakura.style.animationDuration = Math.random() * 3 + 4 + 's';
            sakura.style.width = Math.random() * 15 + 10 + 'px';
            sakura.style.height = sakura.style.width;
            
            sakuraContainer.appendChild(sakura);
            
            setTimeout(() => {
                sakura.remove();
            }, 8000);
        };
        
        // Start animation
        sakuraInterval = setInterval(createSakura, 300);

        // Stop animation after 10 seconds IF user scrolls
        let canStopSakura = false;
        
        setTimeout(() => {
            canStopSakura = true;
            checkSakuraStop();
        }, 10000);

        function checkSakuraStop() {
            if (canStopSakura && window.scrollY > 50) {
                clearInterval(sakuraInterval);
                // Optional: remove existing sakura for cleanliness
                // document.querySelectorAll('.sakura').forEach(el => el.remove());
                console.log("Sakura animation stopped.");
            }
        }

        window.addEventListener('scroll', checkSakuraStop);

        // Countdown Timer
        function updateTimer() {
            const now = new Date();
            const target = new Date();
            target.setHours(24, 0, 0, 0); // Midnight tonight
            
            let diff = target - now;
            if (diff < 0) {
                target.setDate(target.getDate() + 1);
                diff = target - now;
            }
            
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
            
            document.getElementById('hours').innerText = hours.toString().padStart(2, '0');
            document.getElementById('minutes').innerText = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').innerText = seconds.toString().padStart(2, '0');
        }
        setInterval(updateTimer, 1000);
        updateTimer();
    </script>
</body>
</html>
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
        html {
            overflow-x: hidden;
            width: 100%;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #111; /* Match theme black */
            color: #fff;
            overflow-x: hidden;
            width: 100%;
            margin: 0;
            padding: 0;
            cursor: crosshair; /* Fallback */
        }
        
        /* Custom Cursor - Using a simple crosshair or custom image if available */
        /* For a real katana cursor, we'd need a valid URL. Using a stylish crosshair for now */
        body, a, button {
            cursor: url('https://cdn.custom-cursor.com/db/cursor/32/katana_cursor.png'), auto !important;
        }

        /* Marvel-Style Manga Intro - Redesigned */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000;
            z-index: 99999999;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .manga-panel {
            position: absolute;
            background-size: cover;
            background-position: center;
            opacity: 0;
            filter: grayscale(100%) contrast(1.5) brightness(0.8);
            border: 2px solid #000;
            box-shadow: 0 0 20px rgba(0,0,0,0.8);
            z-index: 10;
        }

        .manga-panel.flash {
            animation: flashPanel 0.08s steps(1) forwards;
        }

        @keyframes flashPanel {
            0% { opacity: 0; transform: scale(1.05); }
            50% { opacity: 1; transform: scale(1); }
            100% { opacity: 0; transform: scale(1); }
        }

        #manga-flash-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            opacity: 0;
            z-index: 99998;
            pointer-events: none;
        }

        #manga-flash-overlay.active {
            animation: bigFlash 0.3s ease-out;
        }

        @keyframes bigFlash {
            0% { opacity: 0; }
            50% { opacity: 1; }
            100% { opacity: 0; }
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
            transition: opacity 2s ease-out; /* Smooth Fade Support */
        }
        .sakura {
            position: absolute;
            background: rgba(255, 183, 197, 0.6);
            border-radius: 100% 0 100% 0;
            animation: fall linear infinite;
        }

       /* ... existing styles ... */

        /* Lightning Effect Container */
        #lightning-container {
             transition: opacity 2s ease-out; /* Smooth Fade Support */
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

    </style>
    <style>
        /* New Robust Fade Classes */
        .effect-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 50; /* Below Navbar */
            opacity: 1;
            transition: opacity 2.5s ease-out; /* Smooth 2.5s fade */
        }
        .effect-container.fade-out {
            opacity: 0 !important;
        }
        
        /* Ensure Preloader beats everything */
        #preloader {
            z-index: 99999;
            transition: opacity 0.5s ease;
        }

        /* Restore simple absolute positioning */
        .hero-content {
            z-index: 20 !important;
            position: absolute;
        }

        /* Custom Anime-themed Carousel Arrows (Minimal Blade Style) */
        .carousel-control-prev, .carousel-control-next {
            width: 60px;
            opacity: 0.5;
            transition: all 0.3s ease;
            z-index: 30;
        }

        .carousel-control-prev:hover, .carousel-control-next:hover {
            opacity: 0.9;
        }

        .anime-arrow {
            filter: drop-shadow(0 0 3px rgba(220, 20, 60, 0.4));
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .carousel-control-prev:hover .anime-arrow {
            transform: scale(1.1) translateX(-3px);
        }

        .carousel-control-next:hover .anime-arrow {
            transform: scale(1.1) translateX(3px);
        }
    </style>
    <noscript>
        <style>
            [data-aos] { opacity: 1 !important; transform: none !important; }
            #preloader { display: none !important; }
        </style>
    </noscript>
</head>
<body>
    @include('additions.navbar')
    <!-- Removed Debug Bar -->

    <!-- Marvel-Style Manga Intro (Refined) -->
    <div id="preloader" style="{{ $introActive == '0' ? 'display:none !important;' : '' }}">
        <div id="manga-container" style="position: absolute; top:0; left:0; width:100%; height:100%;"></div>
    </div>
    <div id="manga-flash-overlay"></div>

    <div class="sakura-container"></div>


    <!-- Samurai Hero Section (Restored & Enhanced) -->
    <section class="hero position-relative">
        @if($heroCarousel == '1' && $heroBanners->count() > 0)
            <!-- Carousel Mode -->
            <div id="heroCarousel" class="carousel slide carousel-fade w-100 h-100" data-bs-ride="carousel" data-bs-interval="false" data-bs-pause="false">
                <div class="carousel-inner h-100">
                    @foreach($heroBanners as $index => $banner)
                    <div class="carousel-item h-100 {{ $index == 0 ? 'active' : '' }}" @if($index == 0) data-bs-interval="20000" @else data-bs-interval="10000" @endif>
                        <div class="hero-bg-container">
                            <div class="hero-bg d-block w-100 h-100" style="background-image: url('{{ Str::startsWith($banner->image_path, 'http') ? $banner->image_path : asset('storage/' . $banner->image_path) }}');"></div>
                            <!-- Lightened overlay for better image clarity -->
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.4));"></div>
                        </div>
                        @if($index == 0)
                        <div class="hero-content position-absolute top-50 start-50 translate-middle text-center w-100" style="margin-top: 25px;" data-aos="fade-up" data-aos-duration="1500">
                            <h1 class="japanese-c hero-title glitch" data-text="{{ $heroTitle }}">{{ $heroTitle }}</h1>
                            @if($heroSubtitle)<h2 class="japanese-p hero-subtitle">{{ $heroSubtitle }}</h2>@endif
                            @if($heroDescription)<p class="japanese-w hero-description">{{ $heroDescription }}</p>@endif
                            
                            <a href="#new-arrivals" class="hero-btn-link">
                                <button type="button" class="btn btn-outline-danger hero-btn">
                                    <b>{{ $heroBtnText }}</b>
                                </button>
                            </a>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="anime-arrow" aria-hidden="true">
                        <svg width="45" height="45" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M65 25L35 50L65 75" stroke="crimson" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M60 45L40 50L60 55" fill="white"/>
                        </svg>
                    </span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="anime-arrow" aria-hidden="true">
                        <svg width="45" height="45" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M35 25L65 50L35 75" stroke="crimson" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M40 45L60 50L40 55" fill="white"/>
                        </svg>
                    </span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        @else
            <!-- Single Banner Mode -->
            @php $singleBanner = $heroBanners->first(); @endphp
            <div class="hero-bg-container" id="singleHero">
                @if($singleBanner)
                    <div class="hero-bg" style="background-image: url('{{ Str::startsWith($singleBanner->image_path, 'http') ? $singleBanner->image_path : asset('storage/' . $singleBanner->image_path) }}');"></div>
                @else
                    <div class="hero-bg" style="background-image: url('{{ asset('images/Q.gif') }}');"></div>
                @endif
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.4));"></div>
            </div>

            <div class="hero-content position-absolute top-50 start-50 translate-middle text-center w-100" style="margin-top: 25px;" data-aos="fade-up" data-aos-duration="1500">
                <h1 class="japanese-c hero-title glitch" data-text="{{ $heroTitle }}">{{ $heroTitle }}</h1>
                @if($heroSubtitle)<h2 class="japanese-p hero-subtitle">{{ $heroSubtitle }}</h2>@endif
                @if($heroDescription)<p class="japanese-w hero-description">{{ $heroDescription }}</p>@endif
                
                <a href="#new-arrivals" class="hero-btn-link">
                    <button type="button" class="btn btn-outline-danger hero-btn">
                         <b>{{ $heroBtnText }}</b>
                    </button>
                </a>
            </div>
        @endif
        
        <!-- Lightning Effect Container -->
        <div id="lightning-container" style="position: absolute; top:0; left:0; width:100%; height:100%; pointer-events:none; z-index:50; display:none; overflow: hidden;">
            <div class="flash-overlay" style="background:#fff; opacity:0; width:100%; height:100%; transition: opacity 0.1s ease-out;"></div>
        </div>
    </section>

    <!-- Expanding Cards Section -->
    
    <div class="section-divider"></div>

    <!-- Featured Products -->
    <!-- Featured Products (Renamed to New Arrivals for logic, or keep as Featured) -->
    <!-- Let's use the fetched $newArrivals for a "New Arrivals" section and $featured for the main grid -->

    <section class="container py-5" id="new-arrivals">
        <h2 class="section-header" data-aos="zoom-in">New Arrivals</h2>
        <div class="row g-4">
            @if(isset($newArrivals) && count($newArrivals) > 0)
            @foreach($newArrivals as $index => $product)
            <div class="col-md-3">
                @include('partials.product-card', [
                    'delay' => $index * 100,
                    'badge' => 'NEW CHAPTER'
                ])
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
            <div class="col-md-3">
                @include('partials.product-card', [
                    'delay' => $index * 100,
                    'cardClass' => 'bestseller-card',
                    'badge' => 'HOT',
                    'badgeClass' => 'fire-badge rounded-circle p-2'
                ])
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
                @foreach($categoryBanners as $index => $category)
                @php
                    $displayTitle = $category->name;
                    $displayLink = route('products.index', ['category' => $category->slug]);
                @endphp
                <div class="col-md-4" data-aos="flip-left" data-aos-delay="{{ $index * 200 }}">
                    <a href="{{ $displayLink }}" class="text-decoration-none">
                        <div class="anime-card p-0 floating" style="height: 200px; animation-delay: {{ $index }}s;">
                            <img src="{{ Str::startsWith($category->image_path, 'http') ? $category->image_path : asset('storage/' . $category->image_path) }}" class="w-100 h-100 object-fit-cover" style="opacity: 0.6;">
                            <div class="position-absolute top-50 start-50 translate-middle text-center w-100 px-3">
                                <h3 class="japanese-p display-4 m-0" style="text-shadow: 2px 2px 8px rgba(0,0,0,1);">{{ $displayTitle }}</h3>
                            </div>
                        </div>
                    </a>
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

    @include('additions.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        /**
         * HIKARI INTRO & EFFECTS ENGINE (REWRITE v28)
         * - State Machine Logic: Init -> Intro -> Reveal -> Effects
         * - Guarantees sequential execution and visibility.
         */
        document.addEventListener("DOMContentLoaded", () => {
            // 1. CONFIGURATION
            const config = {
                introActive: "{{ $introActive }}" === "1",
                effect: "{{ $heroEffect }}", // 'sakura', 'lightning', 'none'
                hasImages: {{ $introBanners->count() > 0 ? 'true' : 'false' }} 
            };

            const DOM = {
                preloader: document.getElementById('preloader'),
                container: document.getElementById('manga-container'),
                flashOverlay: document.getElementById('manga-flash-overlay'),
                sakura: document.querySelector('.sakura-container'),
                lightning: document.getElementById('lightning-container'),
                carousel: document.getElementById('heroCarousel')
            };

            // Global Intervals
            let sakuraInterval, lightningInterval;

            // 2. MASTER CONTROLLER
            async function init() {
                console.log("Hikari Engine Starting...", config);

                if (config.introActive && config.hasImages) {
                    await playIntro();
                } else {
                    hidePreloaderImmediate();
                }
                
                // Site logic starts strictly AFTER intro
                revealSite(); 
            }

            // 3. INTRO LOGIC
            function playIntro() {
                return new Promise(resolve => {
                    // Get intro images from PHP (Inline Safe)
                    const dbImages = @json($introBanners->pluck('image_path')->map(function($path) {
                        return Str::startsWith($path, 'http') ? $path : asset('storage/' . $path);
                    }));

                     // Fallback high-quality manga/anime images if none in DB (Just in case count > 0 but array empty?)
                    const fallbackImages = [
                        'https://images.unsplash.com/photo-1620336655055-088d06e7675a?q=80&w=800&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1618336753974-aae8e04506aa?q=80&w=800&auto=format&fit=crop'
                    ];
                    const images = dbImages.length > 0 ? dbImages : fallbackImages;

                    let flashCount = 0;
                    const totalFlashes = 35; 
                    const flashSpeed = 50;

                    function createFlash() {
                         if (flashCount >= totalFlashes) {
                             // End Sequence
                             if(DOM.flashOverlay) DOM.flashOverlay.classList.add('active');
                             setTimeout(resolve, 300); // Resolve after flash
                             return;
                         }

                         const panel = document.createElement('div');
                         panel.classList.add('manga-panel', 'flash');
                         const w = Math.random() > 0.5 ? 50 : 100;
                         const h = Math.random() > 0.5 ? 50 : 100;
                         panel.style.width = w + '%';
                         panel.style.height = h + '%';
                         panel.style.top = (Math.random() * (100-h)) + '%';
                         panel.style.left = (Math.random() * (100-w)) + '%';
                         panel.style.backgroundImage = `url('${images[Math.floor(Math.random() * images.length)]}')`;
                         
                         if(DOM.container) DOM.container.appendChild(panel);
                         setTimeout(() => { panel.remove(); }, 80);

                         flashCount++;
                         setTimeout(createFlash, flashSpeed);
                    }

                    // Start Loop
                    createFlash();
                });
            }

            function hidePreloaderImmediate() {
                if(DOM.preloader) DOM.preloader.style.display = 'none';
            }

            // 4. SITE REVEAL (The Fix for Hero)
            function revealSite() {
                console.log("Revealing Site...");
                if(DOM.preloader) {
                    DOM.preloader.style.opacity = '0';
                    setTimeout(() => {
                        DOM.preloader.style.display = 'none';
                    }, 600);
                }

                // AOS Init triggering NOW ensures content is visible
                AOS.init({ 
                    once: true, 
                    duration: 800,
                    offset: 50 // Trigger sooner
                }); 
                
                // Manual refresh for Carousel Text
                if(DOM.carousel) {
                    // Force refresh AOS on slide
                    DOM.carousel.addEventListener('slid.bs.carousel', () => {
                        AOS.refresh(); 
                    });
                }

                startEffects();
            }

            // 5. EFFECTS LOGIC (With Scroll Trigger)
            function startEffects() {
                if (config.effect === 'none') return;
                console.log("Starting Effect:", config.effect);

                if (config.effect === 'sakura') startSakura();
                if (config.effect === 'lightning') startLightning();
                
                // Disappear 7s after scroll instead of immediately
                const handleScroll = () => {
                    if (window.scrollY > 50) {
                        console.log("Scroll detected: Effects will fade out in 7 seconds...");
                        setTimeout(() => {
                            stopAllEffectsSmoothly();
                        }, 7000);
                        window.removeEventListener('scroll', handleScroll);
                    }
                };
                window.addEventListener('scroll', handleScroll);
            }

            function stopAllEffectsSmoothly() {
                console.log("Stopping Effects...");
                if (DOM.sakura) {
                    DOM.sakura.classList.add('fade-out'); // Toggle class or style
                    DOM.sakura.style.opacity = '0';
                    setTimeout(() => { 
                         if(sakuraInterval) clearInterval(sakuraInterval);
                         DOM.sakura.style.display = 'none'; 
                    }, 2500);
                }
                if (DOM.lightning) {
                    DOM.lightning.style.opacity = '0';
                    setTimeout(() => { 
                         if(lightningInterval) clearInterval(lightningInterval);
                         DOM.lightning.style.display = 'none'; 
                    }, 2500);
                }
            }

            function startSakura() {
                 if(DOM.sakura) {
                     DOM.sakura.style.display = 'block';
                     void DOM.sakura.offsetWidth; 
                     DOM.sakura.style.opacity = '1';
                     
                     if(!sakuraInterval) {
                         const createSakura = () => {
                            if (!DOM.sakura || DOM.sakura.style.opacity === '0') return;
                            const sakura = document.createElement('div');
                            sakura.classList.add('sakura');
                            sakura.style.left = Math.random() * 100 + 'vw';
                            sakura.style.animationDuration = Math.random() * 3 + 4 + 's';
                            sakura.style.width = Math.random() * 15 + 10 + 'px';
                            sakura.style.height = sakura.style.width;
                            DOM.sakura.appendChild(sakura);
                            setTimeout(() => { sakura.remove(); }, 8000);
                         };
                         sakuraInterval = setInterval(createSakura, 300);
                     }
                 }
            }

            function startLightning() {
                if(!DOM.lightning) return;
                DOM.lightning.style.display = 'block';
                void DOM.lightning.offsetWidth;
                DOM.lightning.style.opacity = '1';

                if(!lightningInterval) {
                    const triggerLightning = () => {
                        if(DOM.lightning.style.opacity === '0') return;
                        const flash = DOM.lightning.querySelector('.flash-overlay');
                        if(!flash) return;

                        let opacity = 0.5 + Math.random() * 0.4;
                        flash.style.opacity = opacity;
                        setTimeout(() => { flash.style.opacity = 0; }, 50 + Math.random() * 100);
                    };
                    lightningInterval = setInterval(triggerLightning, 3000); 
                    triggerLightning();
                }
            }

            // Failsafe: If somehow stuck for 5 seconds, force reveal
            setTimeout(() => {
                const p = document.getElementById('preloader');
                if(p && getComputedStyle(p).display !== 'none' && getComputedStyle(p).opacity !== '0') {
                    console.warn("Failsafe Triggered");
                    revealSite();
                }
            }, 5000);

            // Start Engine
            init();
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hikari Anime Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- CSS for theme -->
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <!-- Expanding Cards -->
    <link rel="stylesheet" href="{{ asset('css/Expanding Cards.css') }}">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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

        
        /* Floating Card Actions */
        .card-action-btn {
            position: absolute;
            top: 15px;
            width: 40px;
            height: 40px;
            background: rgba(0, 0, 0, 0.8);
            border: 1px solid crimson;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            cursor: pointer;
            z-index: 100;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            opacity: 0;
            visibility: hidden;
            box-shadow: 0 0 10px rgba(220, 20, 60, 0.3);
        }
        .manga-card:hover .card-action-btn,
        .bestseller-card:hover .card-action-btn,
        .new-arrival-card:hover .card-action-btn,
        .bestseller-anime-card:hover .card-action-btn {
            opacity: 1 !important;
            visibility: visible !important;
        }
        .card-action-btn:hover {
            background: crimson;
            color: #fff;
            box-shadow: 0 0 20px crimson;
            transform: scale(1.1);
        }
        .card-action-btn.active {
            background: #fff;
            color: crimson;
            border-color: #fff;
        }
        .card-action-btn.left { left: 15px; }
        .card-action-btn.right { right: 15px; }

        .card-action-btn::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: -35px;
            left: 50%;
            transform: translateX(-50%) translateY(10px);
            background: rgba(0, 0, 0, 0.9);
            color: #fff;
            padding: 4px 10px;
            border-radius: 4px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.7rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            border: 1px solid crimson;
            pointer-events: none;
        }
        .card-action-btn:hover::after {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
            visibility: visible;
            z-index: 1000;
        }

        /* Toast Styling */
        .hikari-toast {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #000;
            color: #fff;
            padding: 12px 25px;
            border: 2px solid crimson;
            box-shadow: 5px 5px 0 crimson;
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            z-index: 10000;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: toastSlideIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        @keyframes toastSlideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
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

        /* Badge suppression removed to allow partial-based badges */
        .swiper-button-prev-custom, .swiper-button-next-custom {
            width: 45px;
            height: 45px;
            background: rgba(220, 20, 60, 0.1);
            border: 2px solid crimson;
            color: crimson;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 1.2rem;
        }
        .swiper-button-prev-custom:hover, .swiper-button-next-custom:hover {
            background: crimson;
            color: white;
            box-shadow: 0 0 15px rgba(220, 20, 60, 0.5);
            transform: translateY(-3px);
        }
        .swiper-slide {
            height: auto !important;
            display: flex;
            justify-content: center;
        }
        .newArrivalsSwiper .swiper-slide {
            height: auto !important;
            display: flex !important;
            align-items: flex-start !important; /* TOP align — no stretching */
            justify-content: center !important;
        }
        
        .manga-card, .bestseller-card {
            width: 100%;
            height: 100% !important; /* Card fills the slide */
            display: flex !important;
            flex-direction: column !important;
        }
        
        /* Force body to take space and push footer down */
        .manga-card .card-body, .bestseller-card .card-body {
            flex-grow: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: space-between !important;
        }

        .manga-card .card-body > div, .bestseller-card .card-body > div {
            flex-grow: 1;
        }
        
        /* Side Arrows for New Arrivals */
        .new-arrivals-wrapper {
            position: relative;
            padding: 0 80px; /* More space for side arrows */
        }
        
        .new-arrivals-wrapper .swiper-button-prev-custom,
        .new-arrivals-wrapper .swiper-button-next-custom {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 100;
            background: transparent;
            border: none;
            width: auto;
            height: auto;
            cursor: pointer;
        }
        
        .new-arrivals-wrapper .swiper-button-prev-custom { left: 0px; }
        .new-arrivals-wrapper .swiper-button-next-custom { right: 0px; }
        
        .new-arrivals-wrapper .swiper-button-prev-custom:hover,
        .new-arrivals-wrapper .swiper-button-next-custom:hover {
            background: transparent;
            box-shadow: none;
            transform: translateY(-50%) scale(1.1);
        }

        /* Prevent shadow clipping */
        .newArrivalsSwiper {
            padding: 20px 15px 40px 15px !important;
            margin: -20px -15px -40px -15px !important;
        }

        /* ── NEW ARRIVALS CARD: Cyber Glow ─────────────────── */
        .new-arrival-card {
            background: rgba(15, 15, 15, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            position: relative;
            overflow: visible;
            transition: transform 0.4s cubic-bezier(0.175,0.885,0.32,1.275), box-shadow 0.4s ease, border-color 0.4s ease;
            width: 100%;
            display: flex !important;
            flex-direction: column !important;
        }
        /* Card view button reveal on hover */
        .new-arrival-card:hover .card-action-btn {
            opacity: 1 !important;
            visibility: visible !important;
        }
        .new-arrival-card .card-action-btn {
            z-index: 110 !important;
        }
        .new-arrival-card:hover {
            transform: translateY(-8px);
            border-color: crimson;
            box-shadow: 0 15px 35px rgba(220, 20, 60, 0.2), 0 0 15px rgba(220,20,60,0.2) !important;
        }
        .new-arrival-card .card-img-top {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: transform 0.6s ease;
            width: 100%;
            aspect-ratio: 2/3;
            object-fit: cover;
            display: block;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .new-arrival-card:hover .card-img-top {
            transform: scale(1.05);
        }
        .new-arrival-card .card-body {
            flex-grow: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: space-between !important;
            padding: 0.9rem 1rem;
            background: transparent;
        }
        .new-arrival-card .card-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            text-transform: uppercase;
            color: #fff;
            font-size: 0.88rem;
            letter-spacing: 0.5px;
            margin-bottom: 0.15rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .new-arrival-card .card-text {
            color: rgba(255,255,255,0.4);
            font-size: 0.72rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .new-arrival-card .price {
            background: crimson;
            color: #fff;
            padding: 3px 10px;
            font-weight: 900;
            font-size: 0.95rem;
            border: none;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(220, 20, 60, 0.3);
        }
        /* ────────────────────────────────────────────────── */

        /* ── BEST SELLERS CARD: Cyber Glow ─────── */
        .bestseller-anime-card {
            background: rgba(15, 15, 15, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            position: relative;
            overflow: visible;
            transition: transform 0.4s cubic-bezier(0.175,0.885,0.32,1.275), box-shadow 0.4s ease, border-color 0.4s ease;
            width: 100%;
            height: 100% !important;
            display: flex !important;
            flex-direction: column !important;
        }
        .bestseller-anime-card:hover .card-action-btn {
            opacity: 1 !important;
            visibility: visible !important;
            z-index: 110 !important;
        }
        .bestseller-anime-card .card-action-btn { z-index: 110 !important; }
        .bestseller-anime-card:hover {
            transform: translateY(-8px);
            border-color: crimson;
            box-shadow: 0 15px 35px rgba(220, 20, 60, 0.2), 0 0 15px rgba(220,20,60,0.2) !important;
        }
        .bestseller-anime-card .card-img-top {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: transform 0.6s ease;
            width: 100%;
            aspect-ratio: 2/3;
            object-fit: cover;
            display: block;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .bestseller-anime-card:hover .card-img-top {
            transform: scale(1.05);
        }
        .bestseller-anime-card .card-body {
            flex-grow: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: space-between !important;
            padding: 0.9rem 1rem;
            background: transparent;
        }
        .bestseller-anime-card .card-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            text-transform: uppercase;
            color: #fff;
            font-size: 0.88rem;
            letter-spacing: 0.5px;
            margin-bottom: 0.15rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .bestseller-anime-card .card-text {
            color: rgba(255,255,255,0.4);
            font-size: 0.72rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .bestseller-anime-card .price {
            background: crimson;
            color: #fff;
            padding: 3px 10px;
            font-weight: 900;
            font-size: 0.95rem;
            border: none;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(220, 20, 60, 0.3);
        }
        .bestseller-anime-card .btn-view, .new-arrival-card .btn-view {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 1px;
            padding: 6px 18px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 8px;
        }
        .bestseller-anime-card .btn-view:hover, .new-arrival-card .btn-view:hover {
            background: crimson;
            color: white;
            border-color: crimson;
            box-shadow: 0 5px 15px rgba(220, 20, 60, 0.4);
        }
        .bestseller-anime-card .badge { display: none !important; }
        /* ────────────────────────────────────────────────── */

        /* FLASH SALE SECTION */
        /* FLASH SALE BANNER STYLE (REVERTED) */
        .flash-sale-banner {
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 450px;
            display: flex;
            align-items: center;
            border-top: 3px solid crimson;
            border-bottom: 3px solid crimson;
            position: relative;
        }
        .flash-sale-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(rgba(0,0,0,0.8), rgba(20,0,0,0.6), rgba(0,0,0,0.8));
        }
        .timer-box {
            background: rgba(0,0,0,0.9);
            border: 2px solid crimson;
            padding: 20px 30px;
            margin: 0 10px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(220, 20, 60, 0.4);
            min-width: 120px;
        }
        .timer-box h3 {
            font-size: 2.5rem;
            margin: 0;
            color: crimson;
            font-weight: 800;
        }
        .timer-box small {
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #fff;
            font-size: 0.8rem;
        }
        
        /* SLEEK NEON BUTTONS - "Hikari" Style */
        .btn-minecraft {
            background: transparent;
            color: #fff !important;
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem !important;
            font-weight: 600;
            text-transform: uppercase;
            padding: 15px 45px !important;
            border: 2px solid crimson;
            border-radius: 4px !important;
            position: relative;
            display: inline-block;
            text-decoration: none;
            letter-spacing: 2px;
            transition: all 0.3s ease;
            overflow: hidden;
            background: rgba(220, 20, 60, 0.05);
            box-shadow: 0 0 10px rgba(220, 20, 60, 0.2);
        }
        .btn-minecraft:hover {
            background: crimson;
            color: #fff !important;
            box-shadow: 0 0 25px crimson;
            transform: translateY(-3px);
            border-color: #ff4d4d;
        }
        .btn-minecraft:active {
            transform: translateY(1px);
            box-shadow: 0 0 10px crimson;
        }
        /* Remove span skew from previous attempt */
        .btn-minecraft span {
            display: inline-block;
            transform: none !important;
        }
        
        /* FLASH SALE SPLIT LAYOUT */
        .flash-sale-split {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            gap: 40px;
        }
        .flash-info-side {
            flex: 1;
            text-align: left;
        }
        .flash-products-side {
            flex: 1.2;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
        }
        
        /* Flash Sale Responsiveness */
        /* Desktop: Show 2, hide 3rd */
        .flash-item-2 { display: none; }
        
        .flash-btn-mobile-wrapper { display: none; }
        .flash-btn-desktop { display: inline-block !important; }
        
        @media (max-width: 1200px) {
            /* tablet: Show 1 to prevent squishing */
            .flash-item-1 { display: none; }
            .flash-item-2 { display: none; }
        }
        
        @media (max-width: 991px) {
            .flash-sale-split {
                flex-direction: column;
                gap: 20px;
            }
            .flash-info-side {
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            #flash-countdown {
                justify-content: center;
            }
            .flash-products-side {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
            }
            
            .flash-item-0, .flash-item-1, .flash-item-2 { display: block !important; }
            
            .flash-btn-desktop { display: none !important; }
            .flash-btn-mobile-wrapper { display: block; margin-top: 20px; }
        }
        
        @media (max-width: 768px) {
            /* Drop to 2 cards instead of wrapping */
            .flash-products-side { grid-template-columns: repeat(2, 1fr); }
            .flash-item-2 { display: none !important; }
        }
        
        @media (max-width: 500px) {
            /* Drop to 1 card for very small phones, center it and prevent stretching */
            .flash-products-side { 
                grid-template-columns: minmax(auto, 280px); 
                justify-content: center;
                padding: 0 10px; 
            }
            .flash-item-1 { display: none !important; }
            
            /* Shrink actual JS timer elements so they fit perfectly */
            #flash-countdown {
                gap: 5px !important;
            }
            .timer-unit {
                min-width: 60px !important;
                padding: 8px 5px !important;
                border-width: 1px !important;
            }
            .timer-val {
                font-size: 1.4rem !important;
            }
            .timer-label {
                font-size: 0.55rem !important;
                letter-spacing: 0px !important;
            }
        }
        
        /* Best Sellers Grid Responsiveness (Squeeze and Hide) */
        .bestseller-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        
        @media (max-width: 1200px) {
            .bestseller-grid { grid-template-columns: repeat(3, 1fr); }
            .bs-item-3 { display: none !important; }
        }
        
        @media (max-width: 991px) {
            .bestseller-grid { grid-template-columns: repeat(2, 1fr); }
            .bs-item-2 { display: none !important; }
        }
        
        @media (max-width: 500px) {
            /* Drop to 1 card for very small phones, center it and prevent stretching */
            .bestseller-grid { 
                grid-template-columns: minmax(auto, 280px); 
                justify-content: center;
                padding: 0 10px; 
            }
            .bs-item-1 { display: none !important; }
        }
        
        .timer-box {
            background: #000;
            border: 3px solid crimson;
            padding: 15px;
            margin-right: 15px;
            border-radius: 4px;
            box-shadow: 4px 4px 0 crimson;
            min-width: 90px;
            text-align: center;
        }
        .timer-box h3 {
            font-size: 2rem;
            margin: 0;
            color: #fff;
            font-weight: 900;
        }
        .timer-box small {
            text-transform: uppercase;
            color: crimson;
            font-size: 0.7rem;
            font-weight: 700;
        }
        
        /* MANGA FRAME CATEGORIES */
        .manga-frame-card {
            position: relative;
            background: #000;
            border: 4px solid #fff;
            overflow: hidden;
            height: 350px;
            transition: all 0.4s ease;
            box-shadow: 10px 10px 0 #000;
        }
        .manga-frame-card:hover {
            border-color: crimson;
            box-shadow: 10px 10px 0 crimson;
            transform: translate(-5px, -5px);
        }
        .manga-frame-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(100%) contrast(1.2);
            transition: all 0.5s ease;
            opacity: 0.6;
        }
        .manga-frame-card:hover img {
            filter: grayscale(0%) contrast(1);
            opacity: 1;
            transform: scale(1.1);
        }
        .manga-frame-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #fff;
            color: #000;
            padding: 10px;
            transform: skewX(-15deg) translateX(-10px);
            width: 110%;
            transition: all 0.3s ease;
        }
        .manga-frame-card:hover .manga-frame-overlay {
            background: crimson;
             color: #fff;
        }
        /* CATEGORIES: MANGA PANEL GRID */
        .category-panel-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-auto-rows: 250px;
            gap: 15px;
            padding: 20px;
        }
        @media (min-width: 992px) {
            .category-panel-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        .category-panel {
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(220, 20, 60, 0.3);
            background: #000;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            border-radius: 8px;
        }
        .category-panel::after {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(transparent 60%, rgba(0,0,0,0.8));
            z-index: 1;
        }
        .category-panel img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(100%);
            transition: all 0.5s ease;
            opacity: 0.7;
        }
        .category-panel:hover {
            border-color: crimson;
            transform: scale(1.02);
            z-index: 10;
            box-shadow: 0 0 30px crimson;
        }
        .category-panel:hover img {
            filter: grayscale(0%);
            opacity: 1;
            transform: scale(1.1);
        }
        .category-text {
            position: absolute;
            bottom: 15px;
            left: 15px;
            z-index: 2;
            color: #fff;
            background: rgba(220, 20, 60, 0.85);
            padding: 5px 15px;
            transform: skewX(-15deg);
        }
        .category-text span, .category-text h3 {
            display: block;
            transform: skewX(15deg); /* Counter skew for readability */
        }
        .category-text span {
            font-size: 0.65rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.8);
        }
        .category-text h3 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-shadow: none;
        }
            font-family: 'Black Ops One', cursive;
            font-size: 1.8rem;
            margin: 0;
            text-transform: uppercase;
            text-shadow: 2px 2px 0 crimson;
            transform: skewX(-10deg);
        }
        .category-text span {
            font-size: 0.8rem;
            color: crimson;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        .pulse-btn {
            animation: pulse-crimson 2s infinite;
        }
        @keyframes pulse-crimson {
            0% { box-shadow: 0 0 0 0 rgba(220, 20, 60, 0.7); }
            70% { box-shadow: 0 0 0 20px rgba(220, 20, 60, 0); }
            100% { box-shadow: 0 0 0 0 rgba(220, 20, 60, 0); }
        }
        .flash-sale-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: repeating-linear-gradient(45deg, rgba(220, 20, 60, 0.03) 0, rgba(220, 20, 60, 0.03) 1px, transparent 1px, transparent 10px);
            pointer-events: none;
        }
        .timer-unit {
            background: rgba(0, 0, 0, 0.8);
            border: 2px solid crimson;
            min-width: 90px;
            padding: 10px;
            text-align: center;
            box-shadow: 0 0 15px rgba(220, 20, 60, 0.3);
            border-radius: 8px;
        }
        .timer-val {
            font-size: 2.5rem;
            font-weight: 900;
            color: #fff;
            line-height: 1;
            font-family: 'Black Ops One', cursive;
            display: block;
        }
        .timer-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: crimson;
            letter-spacing: 2px;
            font-weight: 700;
        }
        .flash-sale-card-wrapper {
            transition: transform 0.3s ease;
        }
        .flash-sale-card-wrapper:hover {
            transform: scale(1.02);
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
                                <button type="button" class="btn-minecraft">
                                    {{ $heroBtnText }}
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
                    <button type="button" class="btn-minecraft">
                         <span>{{ $heroBtnText }}</span>
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
    

    <div class="section-divider" style="margin-top: 1rem; margin-bottom: 1rem;"></div>

    <!-- Featured Products -->
    <!-- Featured Products (Renamed to New Arrivals for logic, or keep as Featured) -->
    <!-- Let's use the fetched $newArrivals for a "New Arrivals" section and $featured for the main grid -->

    <section class="container pt-2 pb-5" id="new-arrivals">
        <div class="mb-4" data-aos="fade-right">
            <h2 class="section-header text-center mb-3">New Arrivals</h2>
        </div>
        
        <div class="new-arrivals-wrapper position-relative">
            <!-- Arrows -->
            <div class="swiper-button-prev-custom" style="left: -50px;">
                <span class="anime-arrow">
                    <svg width="50" height="50" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M65 25L35 50L65 75" stroke="crimson" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M60 45L40 50L60 55" fill="white"/>
                    </svg>
                </span>
            </div>
            <div class="swiper-button-next-custom" style="right: -50px;">
                <span class="anime-arrow">
                    <svg width="50" height="50" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M35 25L65 50L35 75" stroke="crimson" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M40 45L60 50L40 55" fill="white"/>
                    </svg>
                </span>
            </div>

            <div class="swiper newArrivalsSwiper">
                <div class="swiper-wrapper">
                @if(isset($newArrivals) && count($newArrivals) > 0)
                @foreach($newArrivals as $index => $product)
                <div class="swiper-slide">
                    <div class="w-100">
                        @include('partials.product-card', [
                            'delay'     => ($index % 4) * 100,
                            'badge'     => 'NEW',
                            'cardClass' => 'new-arrival-card',
                            'btnClass'  => 'btn-view',
                        ])
                    </div>
                </div>
                @endforeach
                @else
                <div class="swiper-slide w-100 text-center text-white-50">
                    <p>No new arrivals at the moment.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    </section>

    @if(isset($promoBanner) && $promoBanner)
        @php
            $promoBg = $promoBanner->image_path ? 
                (Str::startsWith($promoBanner->image_path, 'http') ? $promoBanner->image_path : asset('storage/' . $promoBanner->image_path)) : 
                'https://images.unsplash.com/photo-1541562232579-512a21360020?q=80&w=1920&auto=format&fit=crop';
            $legacyEndDate = $promoBanner->description; 
            // Correct Link Logic: If we have an active flash sale, link to it. Otherwise use the banner link.
            $flashLink = (isset($activeFlashSale) && $activeFlashSale) ? route('flash-sales.show', $activeFlashSale->slug) : ($promoBanner->link ?? route('products.index'));
        @endphp
        
        <div class="flash-event-fullwidth py-0" style="margin-top: 150px;">
            <div class="container-fluid px-0">
                <center><h2 class="section-header mb-0" data-aos="zoom-in" style="font-size: 4rem; position: relative; top: -110px; z-index: 20; text-shadow: 0 0 30px rgba(220, 20, 60, 0.8);">{{ $promoBanner->title }}</h2></center>
                
                <section class="flash-sale-banner py-5" style="background-image: url('{{ $promoBg }}'); margin-top: -80px;" id="flash-sale-banner" data-end-date="{{ (isset($activeFlashSale) && $activeFlashSale) ? $activeFlashSale->end_time : $legacyEndDate }}">
                    <div class="flash-sale-overlay"></div>
                    <div class="container position-relative z-1">
                        <div class="flash-sale-split align-items-center">
                            <div class="flash-info-side" data-aos="fade-right">
                                <span class="badge bg-danger mb-4 px-4 py-2 fs-5 rounded-pill text-uppercase pulse-btn">Active Event</span>
                                <h2 class="display-3 fw-bold mb-2 text-white" style="font-family: 'Kaushan Script', cursive; text-shadow: 0 0 20px crimson;">
                                    {{ $activeFlashSale->title ?? 'Mega Event' }}
                                </h2>
                                
                                @if(isset($activeFlashSale) && $activeFlashSale->description)
                                    <p class="lead text-white mt-4 mb-5" style="max-width: 400px; font-family: 'M PLUS Rounded 1c', sans-serif; font-size: 1.15rem; font-weight: 400; opacity: 0.95; line-height: 1.8; letter-spacing: 0.5px; text-shadow: 0 2px 10px rgba(0,0,0,0.8);">
                                        {{ $activeFlashSale->description }}
                                    </p>
                                @endif
                                
                                <div class="d-flex mb-5 gap-3" id="flash-countdown"></div>
                                
                                <a href="{{ $flashLink }}" class="btn-minecraft flash-btn-desktop">
                                    {{ $promoBanner->btn_text ?? 'See All Deals' }}
                                </a>
                            </div>
                            
                            <div class="flash-products-side" data-aos="fade-left">
                                @if(isset($activeFlashSale) && $activeFlashSale->products->count() > 0)
                                    @foreach($activeFlashSale->products->take(3) as $index => $fProduct)
                                        <div class="mini-card-flash h-100 p-2 flash-item-{{ $index }}" style="min-width: 0; background: rgba(220, 20, 60, 0.05); border: 1px solid rgba(220, 20, 60, 0.2); border-radius: 12px; transition: all 0.3s ease;">
                                            @include('partials.product-card', [
                                                'product' => $fProduct,
                                                'cardClass' => 'new-arrival-card',
                                                'badge' => 'PROMO',
                                                'badgeClass' => 'bg-danger text-white pulse-btn'
                                            ])
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center text-white-50 p-5 w-100">
                                        <i class="bi bi-lightning-charge-fill display-1 mb-3"></i>
                                        <p class="lead">Mega Deals Coming Soon</p>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Mobile-only Button -->
                            <div class="w-100 text-center flash-btn-mobile-wrapper">
                                <a href="{{ $flashLink }}" class="btn-minecraft">
                                    {{ $promoBanner->btn_text ?? 'See All Deals' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    @endif


    <!-- Best Sellers -->
    <section class="container py-5">
        <h2 class="section-header" data-aos="zoom-in">Best Sellers</h2>
        <div class="bestseller-grid mt-4">
            @if(isset($bestSellers) && count($bestSellers) > 0)
            @foreach($bestSellers->take(4) as $index => $product)
            <div class="h-100 bs-item-{{ $index }}" style="min-width: 0;">
                <div class="h-100">
                @include('partials.product-card', [
                    'delay'     => $index * 100,
                    'cardClass' => 'bestseller-anime-card',
                    'badge'     => 'HOT',
                    'btnClass'  => 'btn-view',
                ])
                </div>
            </div>
            @endforeach
            @else
             <div class="text-center text-white-50 w-100" style="grid-column: 1 / -1;">
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
                <a href="{{ route('products.show', $otakuChoice->id) }}" class="btn-minecraft"><span>Check it Out</span></a>
            </div>
        </div>
    </section>
    @endif

    <!-- All Products Link -->
    <div class="text-center mt-5 mb-5" data-aos="fade-up">
        <a href="{{ route('products.index') }}" class="btn-minecraft">
            <span>View Full Collection</span>
        </a>
    </div>

    <div class="section-divider"></div>

    <!-- Categories Section -->
    <section class="container py-5 mb-5" id="categories-section">
        <h2 class="section-header" data-aos="zoom-in">Categories</h2>
        
        <div class="categories-wrapper position-relative" style="padding: 0 20px;">
            <div class="swiper-button-prev-categories" style="position: absolute; top: 50%; left: -30px; transform: translateY(-50%); z-index: 20; cursor: pointer; color: crimson;">
                <i class="fas fa-chevron-left fa-3x"></i>
            </div>
            <div class="swiper-button-next-categories" style="position: absolute; top: 50%; right: -30px; transform: translateY(-50%); z-index: 20; cursor: pointer; color: crimson;">
                 <i class="fas fa-chevron-right fa-3x"></i>
            </div>

            <div class="swiper categoriesSwiper py-4">
                <div class="swiper-wrapper">
                    @if(isset($categoryBanners) && $categoryBanners->count() > 0)
                        @foreach($categoryBanners as $index => $category)
                        <div class="swiper-slide h-auto">
                             <div class="category-panel w-100" style="height: 320px; border: 1px solid rgba(255,255,255,0.1);">
                                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="d-block w-100 h-100">
                                    <img src="{{ Str::startsWith($category->image_path, 'http') ? $category->image_path : asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" class="w-100 h-100 object-fit-cover shadow-lg">
                                    <div class="category-text">
                                        <span>Explore</span>
                                        <h3>{{ $category->name }}</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>



    @include('additions.footer')
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/hikari-interactions.js') }}"></script>
    
    <script>
        // Toast Notification Logic
        window.showHikariToast = function(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = 'hikari-toast';
            const icon = type === 'error' ? 'bi-exclamation-triangle' : 'bi-lightning-fill';
            toast.innerHTML = `<i class="bi ${icon} text-danger"></i> <span>${message}</span>`;
            document.body.appendChild(toast);
            
            // Auto remove
            setTimeout(() => {
                toast.style.animation = 'toastSlideIn 0.3s reverse forwards';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    </script>

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

            // New Arrivals Swiper - Slow Continuous Glide
            if (document.querySelector('.newArrivalsSwiper')) {
                new Swiper(".newArrivalsSwiper", {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    speed: 5000,
                    autoplay: {
                        delay: 0,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    observer: true,
                    observeParents: true,
                    loop: true,
                    allowTouchMove: true,
                    navigation: {
                        nextEl: ".new-arrivals-wrapper .swiper-button-next-custom",
                        prevEl: ".new-arrivals-wrapper .swiper-button-prev-custom",
                    },
                    breakpoints: {
                        640: { slidesPerView: 2 },
                        992: { slidesPerView: 4 }, // Exact match to wishlist grid density
                    },
                    on: {
                        init: function() {
                            this.el.addEventListener('mouseenter', () => {
                                this.autoplay.stop();
                            });
                            this.el.addEventListener('mouseleave', () => {
                                this.autoplay.start();
                            });
                        }
                    }
                });
            }

            // Categories Swiper - Smooth Continuous Glide
            if (document.querySelector('.categoriesSwiper')) {
                new Swiper(".categoriesSwiper", {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    speed: 5000,
                    loop: true,
                    autoplay: {
                        delay: 0,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next-categories",
                        prevEl: ".swiper-button-prev-categories",
                    },
                    breakpoints: {
                        640: { slidesPerView: 2 },
                        1024: { slidesPerView: 4 }, // Updated density
                    }
                });
            }

            // Flash Sale Timer Logic (Homepage Split Style)
            function initFlashSaleTimer() {
                const banner = document.getElementById('flash-sale-banner');
                if(!banner) return;
                
                const countdownEl = document.getElementById('flash-countdown');
                const endDateStr = banner.dataset.endDate;
                if(!endDateStr || !countdownEl) return;
                
                const endDate = new Date(endDateStr.replace(/-/g, "/")).getTime(); 
                
                const timer = setInterval(() => {
                    const now = new Date().getTime();
                    const distance = endDate - now;
                    
                    if (distance < 0) {
                        clearInterval(timer);
                        countdownEl.innerHTML = '<h3 class="text-danger fw-bold display-4">EVENT ENDED</h3>';
                        return;
                    }
                    
                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    
                    let html = '';
                    
                    if (window.innerWidth <= 500) {
                        // Tiny Mobile: Single combined box
                        let combinedTime = '';
                        if (days > 0) combinedTime += `${days}d `;
                        combinedTime += `${hours < 10 ? '0'+hours : hours}h `;
                        combinedTime += `${minutes < 10 ? '0'+minutes : minutes}m `;
                        combinedTime += `${seconds < 10 ? '0'+seconds : seconds}s`;
                        
                        html = `<div class="timer-box" style="padding: 15px 30px; min-width: 250px;">
                                    <h3 style="font-size: 1.8rem; letter-spacing: 2px;">${combinedTime}</h3>
                                    <small style="font-size: 0.75rem;">Time Remaining</small>
                                </div>`;
                    } else {
                        // Desktop/Tablet: Split boxes
                        if (days > 0) html += `<div class="timer-box"><h3>${days}</h3><small>Days</small></div>`;
                        if (hours > 0) html += `<div class="timer-box"><h3>${hours < 10 ? '0'+hours : hours}</h3><small>Hrs</small></div>`;
                        if (minutes > 0) html += `<div class="timer-box"><h3>${minutes < 10 ? '0'+minutes : minutes}</h3><small>Min</small></div>`;
                        if (seconds > 0) html += `<div class="timer-box"><h3>${seconds < 10 ? '0'+seconds : seconds}</h3><small>Sec</small></div>`;
                    }
                    
                    countdownEl.innerHTML = html;
                }, 1000);
            }
            initFlashSaleTimer();

            // Start Engine
            init();
        });
    </script>
</body>
</html>
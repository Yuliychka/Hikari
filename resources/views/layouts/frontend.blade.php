<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ?? 'Hikari Anime Store' }}</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- SwiperJS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0b0b0b !important;
            color: #fff !important;
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            margin-top: 100px; /* Offset for floating navbar */
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #1a1a1a;
        }
        .hover-crimson:hover {
            color: crimson !important;
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
            opacity: 1;
            visibility: visible;
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

        /* Fixed Aspect Ratio for Product Images */
        .card-img-top {
            width: 100%;
            aspect-ratio: 3/4;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .manga-card:hover .card-img-top,
        .bestseller-card:hover .card-img-top {
            transform: scale(1.05);
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
        ::-webkit-scrollbar-thumb {
            background: crimson;
            border-radius: 5px;
        }

        /* Custom Cursor */
        body, a, button {
            cursor: url('https://cdn.custom-cursor.com/db/cursor/32/katana_cursor.png'), auto !important;
        /* MANGA STYLE CARD - GLOBAL */
        .manga-card {
            background: #fff !important;
            color: #000 !important;
            border: 4px solid #000 !important;
            box-shadow: 10px 10px 0 #000 !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease !important;
            position: relative;
            /* overflow: hidden; */ /* Removed to allow tooltips to show */
        }
        .manga-card:hover {
            transform: translate(-5px, -5px) !important;
            box-shadow: 15px 15px 0 #000 !important;
        }
        .manga-card .card-img-top {
            filter: grayscale(100%) contrast(1.2);
            border-bottom: 4px solid #000;
        }
        .manga-card:hover .card-img-top {
            filter: grayscale(0%) contrast(1);
        }
        .manga-card .card-body {
            background: repeating-linear-gradient(45deg, #fff, #fff 10px, #eee 10px, #eee 20px) !important;
        }
        .manga-card .card-title {
            font-family: 'Kaushan Script', cursive !important;
            font-weight: bold;
            text-transform: uppercase;
            color: #000 !important;
            text-shadow: 2px 2px 0 #ccc !important;
        }
        .manga-card .price {
            color: #fff !important;
            background: #000 !important;
            padding: 2px 8px;
            border: 2px solid #000;
            font-weight: 900;
            box-shadow: 3px 3px 0 crimson;
        }
        /* BEST SELLER STYLE CARD - GLOBAL */
        .bestseller-card {
            background: linear-gradient(135deg, #2a0000 0%, #000 100%) !important;
            border: 2px solid #ff4500 !important;
            box-shadow: 0 0 15px rgba(255, 69, 0, 0.5) !important;
            transition: all 0.4s ease !important;
            /* overflow: hidden; */
        }
        .bestseller-card:hover {
            transform: scale(1.05) !important;
            box-shadow: 0 0 25px rgba(255, 69, 0, 0.8), 0 0 10px #ffcc00 !important;
            border-color: #ffcc00 !important;
        }
        .bestseller-card .card-body {
            background: rgba(0,0,0,0.8) !important;
        }
        .bestseller-card .card-title {
            background: -webkit-linear-gradient(#ffcc00, #ff4500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        /* Pagination Styling */
        .pagination .page-link {
            background: #000 !important;
            color: #fff !important;
            border: 1px solid crimson !important;
            border-radius: 0 !important;
            font-family: 'monospace';
            font-weight: bold;
        }
        .pagination .page-item.active .page-link {
            background: crimson !important;
            border-color: #fff !important;
            box-shadow: 3px 3px 0 #fff;
        }
        .pagination .page-link:hover {
            background: #fff !important;
            color: crimson !important;
        }
        .pagination p.small.text-muted, 
        .pagination .flex-sm-fill > div:first-child {
            display: none !important;
        }
    </style>
    @stack('styles')
</head>
<body class="mt-body">

    @include('additions.navbar')

    <main>
        @yield('content')
    </main>

    @include('additions.footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/hikari-interactions.js') }}"></script>
    <script>
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

        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
    @stack('scripts')
</body>
</html>

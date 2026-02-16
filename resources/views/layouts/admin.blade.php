<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hikari Admin - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            /* Manga Book Theme - Volume 1 Style */
            --admin-bg: #fdfdfd; 
            --admin-card: #ffffff;
            --admin-accent: #000000;
            --admin-text: #050505;
            --admin-secondary: #444444;
            --admin-border: #000000;
            --admin-hover: #f0f0f0;
            
            /* Screentone: Visible dots for texture/shading */
            --manga-tone: radial-gradient(circle, #000 1.5px, transparent 1.6px);
            --manga-tone-sm: radial-gradient(circle, #000 1px, transparent 1.1px);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--admin-bg);
            color: var(--admin-text);
            margin: 0;
            overflow-x: hidden;
            /* Authentic Paper Texture */
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.05'/%3E%3C/svg%3E");
            counter-reset: chapter; /* Initialize chapter counter for sidebar */
        }

        /* Sidebar - The Spine */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            background: #111;
            color: #fff;
            border-right: 4px solid #000;
            padding: 2rem 1.5rem; /* More padding for book layouts */
            z-index: 1000;
            /* Scrollable Sidebar */
            overflow-y: auto;
            scrollbar-width: none; /* Firefox */
        }
        
        .sidebar::-webkit-scrollbar {
            display: none; /* Chrome/Safari */
        }

        .sidebar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 900;
            color: #fff;
            text-align: center;
            margin-bottom: 2rem;
            letter-spacing: 1px;
            padding-bottom: 1rem;
            border-bottom: 2px solid #fff;
            text-transform: uppercase;
            position: relative;
        }
        
        /* Volume Label */
        .sidebar-brand::after {
            content: 'VOL. 1';
            display: block;
            font-size: 0.8rem;
            letter-spacing: 4px;
            margin-top: 0.5rem;
            font-weight: 400;
            opacity: 0.7;
        }

        /* Navigation - Table of Contents Style */
        .nav-link {
            color: #aaa;
            padding: 0.6rem 0;
            margin: 0.5rem 0;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: space-between; /* Spacing for dots */
            border-bottom: 1px dotted #444; /* Dotted line like TOC */
            border-radius: 0;
        }

        .nav-link:hover, .nav-link.active {
            color: #fff;
            background: transparent;
            border-bottom-style: solid;
            border-bottom-color: #fff;
            padding-left: 5px; /* Slight drift */
        }
        
        .nav-link.active {
            font-weight: 700;
        }

        .nav-link i {
            width: 24px;
            text-align: center;
            font-size: 0.9rem;
            margin-right: 8px;
            display: none; /* Hide icons for pure TOC look? Or keep them subtle? Keeping them but modifying layout */
        }
        
        /* Custom "Chapter" text layout */
        .nav-text {
            display: flex;
            align-items: baseline;
            width: 100%;
        }
        
        .nav-text::before {
            counter-increment: chapter;
            content: "CH. " counter(chapter, decimal-leading-zero) " ";
            font-family: 'Courier New', monospace;
            font-size: 0.75rem;
            margin-right: 8px;
            opacity: 0.5;
        }

        /* Submenu */
        .nav-parent {
            cursor: pointer;
            position: relative;
        }

        .nav-parent::after {
            content: '+'; /* Simple plus instead of chevron */
            font-family: 'Courier New', monospace;
            font-weight: 900;
            position: absolute;
            right: 0;
            font-size: 1.2rem;
            line-height: 1;
        }

        .nav-parent.open::after {
            content: '-';
        }

        .nav-children {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.25, 1, 0.5, 1);
            background: transparent;
            margin-left: 1rem;
            border-left: 1px solid #333;
            padding-left: 1rem;
        }

        .nav-children.open {
            max-height: 500px;
            padding-bottom: 1rem;
        }

        .nav-child {
            padding: 0.4rem 0;
            font-size: 0.85rem;
            color: #888;
            margin: 0;
            border: none;
            display: block;
        }

        .nav-child:hover, .nav-child.active {
            color: #fff;
            background: transparent;
            text-decoration: underline;
        }

        /* Main Content area */
        .main-content {
            margin-left: 280px;
            padding: 3rem 4rem; /* Wide margins like a book Page */
            min-height: 100vh;
            position: relative;
            /* Gutter Shadow Effect - deeper shadow on loop */
            box-shadow: inset 40px 0 40px -20px rgba(0,0,0,0.15); 
        }

        /* Header */
        header h1 {
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 3.5rem; /* Big Chapter Title */
            letter-spacing: -1px;
            border-bottom: 4px solid #000;
            padding-bottom: 0.5rem;
            margin-bottom: 0;
            display: block;
            background: transparent;
            color: #000;
            padding: 0;
            box-shadow: none;
            /* Inky texture on text */
        }

        .user-profile {
            position: absolute;
            top: 3rem;
            right: 4rem;
            font-weight: 700;
            font-size: 0.9rem;
            border: 2px solid #000;
            padding: 0.5rem 1rem;
            background: #fff;
            box-shadow: 3px 3px 0 #000;
            transform: rotate(-1deg); /* Slight imperfection */
        }

        /* Cards / Panels - Ink Box Style */
        .glass-card {
            background: #fff;
            border: 2px solid #000;
            border-radius: 3px;
            padding: 2.5rem;
            margin-top: 3rem;
            margin-bottom: 3rem;
            box-shadow: 8px 8px 0 #000; /* Deep shadow */
            position: relative;
        }
        
        /* Panel Label/Tag */
        .glass-card::before {
            content: 'PANEL';
            position: absolute;
            top: -12px;
            left: 20px;
            background: #000;
            color: #fff;
            padding: 0 10px;
            font-size: 0.7rem;
            font-weight: 900;
            letter-spacing: 1px;
        }

        /* Headers inside cards */
        .glass-card h4, .glass-card h2, .glass-card h3 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            background: transparent;
            color: #000;
            padding: 0;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px dashed #000; /* Dashed line separator */
            display: block;
            position: relative;
        }

        /* Buttons - Sketchy/Ink Style */
        .btn-premium {
            background: #fff;
            color: #000;
            border: 2px solid #000;
            padding: 0.8rem 2rem;
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px; /* Sketchy border */
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 0.9rem;
            transition: all 0.2s;
            box-shadow: 4px 4px 0 #000;
        }

        .btn-premium:hover {
            background: #000;
            color: #fff;
            transform: scale(1.02);
            box-shadow: 2px 2px 0 #000;
            border-radius: 4px; 
        }
        
        /* Table Styles */
        .table {
            border: 2px solid #000;
            margin-bottom: 0;
        }

        .table thead {
            background: #000;
            color: #fff;
            border-bottom: 4px solid #000;
        }

        .table thead th {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            border-bottom: 2px solid #fff;
            color: #fff;
            padding: 1.2rem;
        }

        .table td {
            padding: 1.2rem;
            border-bottom: 1px solid #000;
            vertical-align: middle;
            font-weight: 600;
            font-family: 'Courier New', monospace; /* Data looks like typed text/notes */
        }
        
        .table tbody tr:hover {
            background-color: #f0f0f0;
            color: #000;
            /* Screentone row hover */
            background-image: var(--manga-tone-sm);
            background-size: 3px 3px;
        }

        /* Status Badges */
        .status-badge {
            padding: 0.4rem 1rem;
            border: 2px solid #000;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: #fff;
            color: #000;
            box-shadow: 2px 2px 0 rgba(0,0,0,1);
        }
        
        .status-active {
            background: #000;
            color: #fff;
            box-shadow: 2px 2px 0 #888;
        }
        
        /* Page Number Fixed Element */
        .page-number {
             position: fixed;
             bottom: 20px;
             right: 30px;
             font-family: 'Courier New', monospace;
             font-weight: 900;
             font-size: 1rem;
             border: 2px solid #000;
             padding: 5px 10px;
             background: #fff;
             z-index: 100;
             box-shadow: 3px 3px 0 #000;
             transform: rotate(-3deg);
        }

        /* Forms */
        .form-control, .form-select {
            border: 2px solid #000;
            border-radius: 0;
            padding: 0.8rem 1rem;
            font-size: 0.95rem;
            background: #fff;
            font-family: 'Courier New', monospace;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #000;
            box-shadow: 4px 4px 0 #000; /* Hard focus shadow */
            background-color: #fff;
        }

        /* Alerts - Force Manga Theme (White & Black) */
        .alert, .alert-success, .alert-info, .alert-warning, .alert-danger {
            background: #fff !important;
            border: 3px solid #000 !important;
            color: #000 !important;
            border-radius: 0 !important;
            border-left: 10px solid #000 !important;
            box-shadow: 6px 6px 0 #000 !important;
            font-family: 'Courier New', monospace !important;
            font-weight: 800 !important;
            text-transform: uppercase !important;
        }
        
        .alert .btn-close {
            filter: none !important;
            opacity: 1 !important;
        }
        
        /* Utility Buttons */
        .btn-outline-info, .btn-outline-danger, .btn-outline-secondary {
            border: 2px solid #000;
            color: #000;
            border-radius: 0;
            font-weight: 600;
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
            background: transparent;
            transition: 0.2s;
        }
        
        .btn-outline-info:hover, .btn-outline-danger:hover, .btn-outline-secondary:hover {
            background: #000;
            color: #fff;
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-brand">Hikari</div>
        <nav class="nav flex-column">
            <!-- Added .nav-text span for Chapter numbering CSS -->
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <span class="nav-text">Dashboard</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                <span class="nav-text">Categories</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                <span class="nav-text">Products</span>
            </a>
            
            <!-- Collapsible Banners & Media Menu -->
            <div class="nav-link nav-parent {{ request()->routeIs('admin.hero-banners.*') || request()->routeIs('admin.intro-panels.*') || request()->routeIs('admin.promo-banners.*') ? 'open' : '' }}" onclick="toggleBannerMenu()">
                <span class="nav-text">Media</span>
            </div>
            <div class="nav-children {{ request()->routeIs('admin.hero-banners.*') || request()->routeIs('admin.intro-panels.*') || request()->routeIs('admin.promo-banners.*') ? 'open' : '' }}" id="bannerMenu">
                <a class="nav-child {{ request()->routeIs('admin.hero-banners.*') ? 'active' : '' }}" href="{{ route('admin.hero-banners.index') }}">
                    Hero Banners
                </a>
                <a class="nav-child {{ request()->routeIs('admin.intro-panels.*') ? 'active' : '' }}" href="{{ route('admin.intro-panels.index') }}">
                    Intro Panels
                </a>
                <a class="nav-child {{ request()->routeIs('admin.promo-banners.*') ? 'active' : '' }}" href="{{ route('admin.promo-banners.index') }}">
                    Promo Banners
                </a>
            </div>
            
            <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                <span class="nav-text">Orders</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                <span class="nav-text">Settings</span>
            </a>
            
            <div style="margin-top: 3rem; border-top: 2px solid #333; padding-top: 1rem;">
                <a class="nav-link" href="{{ url('/') }}" target="_blank">
                     <span class="nav-text" style="color: #666;">View Shop</span> <!-- style override to look like appendix -->
                </a>
                <form action="{{ route('logout') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start p-0">
                         <span class="nav-text" style="color: #666;">Logout</span>
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <main class="main-content">
        <!-- Decoration Page Number -->
        <div class="page-number">p.42</div>
        
        <header class="mb-5 d-flex justify-content-between align-items-center">
            <h1 class="h2">@yield('title')</h1>
            <div class="user-profile">
                <span>{{ auth()->user()->name }}</span>
            </div>
        </header>

        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleBannerMenu() {
            const parent = document.querySelector('.nav-parent');
            const menu = document.getElementById('bannerMenu');
            parent.classList.toggle('open');
            menu.classList.toggle('open');
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hikari Admin - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            /* Manga Book Theme - Black & White with Halftone */
            --admin-bg: #f5f5f0; /* Off-white paper */
            --admin-card: #ffffff;
            --admin-accent: #000000; /* Pure black ink */
            --admin-text: #1a1a1a;
            --admin-secondary: #666666;
            --admin-border: #d0d0d0;
            --admin-hover: #f0f0f0;
            --manga-dot: radial-gradient(circle, #000 1px, transparent 1px);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--admin-bg);
            background-image: 
                repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,0,0,0.03) 2px, rgba(0,0,0,0.03) 4px);
            color: var(--admin-text);
            margin: 0;
            overflow-x: hidden;
        }

        /* Sidebar Styling - Manga Book Spine */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            background: linear-gradient(to right, #1a1a1a 0%, #2a2a2a 50%, #1a1a1a 100%);
            border-right: 3px solid #000;
            box-shadow: 3px 0 10px rgba(0,0,0,0.3);
            padding: 2rem 0;
            z-index: 1000;
        }

        .sidebar-brand {
            font-family: 'Kaushan Script', cursive;
            font-size: 2.5rem;
            color: #fff;
            text-align: center;
            margin-bottom: 3rem;
            text-shadow: 2px 2px 0 #000;
            padding: 0 1rem;
            border-bottom: 2px solid #444;
            padding-bottom: 1rem;
        }

        .nav-link {
            color: #ccc;
            padding: 1rem 1.5rem;
            margin: 0;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 15px;
            border-left: 3px solid transparent;
            position: relative;
        }

        .nav-link:hover, .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.1);
            border-left-color: #fff;
        }

        .nav-link i {
            width: 20px;
        }

        /* Collapsible Menu Styles */
        .nav-parent {
            cursor: pointer;
            position: relative;
        }

        .nav-parent::after {
            content: '\f078'; /* Font Awesome chevron down */
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 1.5rem;
            transition: transform 0.3s;
        }

        .nav-parent.open::after {
            transform: rotate(180deg);
        }

        .nav-children {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background: rgba(0,0,0,0.3);
        }

        .nav-children.open {
            max-height: 300px;
        }

        .nav-child {
            padding-left: 3.5rem;
            font-size: 0.9rem;
            border-left: 3px solid transparent;
        }

        .nav-child:hover, .nav-child.active {
            background: rgba(255,255,255,0.05);
            border-left-color: #888;
        }

        /* Main Content - Manga Panel Style */
        .main-content {
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
            position: relative;
        }

        /* Manga Panel Division Lines */
        .main-content::before {
            content: '';
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            height: 100vh;
            background-image: 
                linear-gradient(to right, transparent 49.5%, #000 49.5%, #000 50.5%, transparent 50.5%);
            opacity: 0.1;
            pointer-events: none;
            z-index: 0;
        }

        .glass-card {
            background: var(--admin-card);
            border: 2px solid #000;
            border-radius: 0;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 5px 5px 0 rgba(0,0,0,0.1);
            position: relative;
            z-index: 1;
        }

        /* Manga Corner Fold Effect */
        .glass-card::before {
            content: '';
            position: absolute;
            top: -2px;
            right: -2px;
            width: 20px;
            height: 20px;
            background: #000;
            clip-path: polygon(100% 0, 0 0, 100% 100%);
        }

        /* Halftone Pattern on Hover */
        .glass-card:hover {
            background-image: 
                radial-gradient(circle, #000 1px, transparent 1px),
                radial-gradient(circle, #000 1px, transparent 1px);
            background-size: 8px 8px;
            background-position: 0 0, 4px 4px;
            background-color: #fff;
        }

        /* Speech Bubble Headers */
        .glass-card h4, .glass-card h1, .glass-card h2, .glass-card h3 {
            position: relative;
            display: inline-block;
            background: #000;
            color: #fff;
            padding: 0.5rem 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .glass-card h4::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 20px;
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-top: 10px solid #000;
        }

        .btn-premium {
            background: #000;
            color: #fff;
            border: 2px solid #000;
            padding: 0.8rem 1.5rem;
            border-radius: 0;
            font-weight: 700;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
        }

        .btn-premium:hover {
            background: #fff;
            color: #000;
            transform: translate(-3px, -3px);
            box-shadow: 3px 3px 0 #000;
        }

        .table {
            color: var(--admin-text);
            border: 2px solid #000;
        }

        .table thead {
            background: #000;
            color: #fff;
            border-bottom: 3px solid #000;
        }

        .table tbody tr {
            border-bottom: 1px solid var(--admin-border);
            transition: 0.2s;
        }

        .table tbody tr:hover {
            background: var(--admin-hover);
        }

        .table thead th {
            border-bottom: 2px solid var(--admin-accent);
            color: #aaa;
            font-weight: 400;
        }

        .table td {
            vertical-align: middle;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 0;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 2px solid #000;
        }

        .status-active {
            background: #fff;
            color: #000;
        }

        .status-inactive {
            background: #000;
            color: #fff;
        }

        .form-control, .form-select {
            background: #fff;
            color: var(--admin-text);
            border: 2px solid #000;
            border-radius: 0;
        }

        .form-control:focus, .form-select:focus {
            background: #fff;
            color: var(--admin-text);
            border-color: #000;
            box-shadow: 3px 3px 0 rgba(0,0,0,0.2);
        }

        .btn-outline-info {
            color: #000;
            border: 2px solid #000;
            border-radius: 0;
        }

        .btn-outline-info:hover {
            background: #000;
            color: #fff;
        }

        .btn-outline-danger {
            color: #000;
            border: 2px solid #000;
            border-radius: 0;
        }

        .btn-outline-danger:hover {
            background: #000;
            color: #fff;
        }

        .btn-outline-secondary {
            color: #000;
            border: 2px solid #000;
            border-radius: 0;
        }

        .btn-outline-secondary:hover {
            background: #000;
            color: #fff;
        }

        .alert-success {
            background: #fff !important;
            color: #000 !important;
            border: 2px solid #000 !important;
            border-radius: 0 !important;
            font-weight: 600;
        }

    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-brand">Hikari Admin</div>
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                <i class="fas fa-shopping-bag"></i> Products
            </a>
            
            <!-- Collapsible Banners & Media Menu -->
            <div class="nav-link nav-parent {{ request()->routeIs('admin.hero-banners.*') || request()->routeIs('admin.category-banners.*') || request()->routeIs('admin.intro-panels.*') || request()->routeIs('admin.promo-banners.*') ? 'open' : '' }}" onclick="toggleBannerMenu()">
                <i class="fas fa-images"></i> Banners & Media
            </div>
            <div class="nav-children {{ request()->routeIs('admin.hero-banners.*') || request()->routeIs('admin.category-banners.*') || request()->routeIs('admin.intro-panels.*') || request()->routeIs('admin.promo-banners.*') ? 'open' : '' }}" id="bannerMenu">
                <a class="nav-link nav-child {{ request()->routeIs('admin.hero-banners.*') ? 'active' : '' }}" href="{{ route('admin.hero-banners.index') }}">
                    <i class="fas fa-image"></i> Hero Banners
                </a>
                <a class="nav-link nav-child {{ request()->routeIs('admin.category-banners.*') ? 'active' : '' }}" href="{{ route('admin.category-banners.index') }}">
                    <i class="fas fa-th-large"></i> Category Banners
                </a>
                <a class="nav-link nav-child {{ request()->routeIs('admin.intro-panels.*') ? 'active' : '' }}" href="{{ route('admin.intro-panels.index') }}">
                    <i class="fas fa-film"></i> Intro Panels
                </a>
                <a class="nav-link nav-child {{ request()->routeIs('admin.promo-banners.*') ? 'active' : '' }}" href="{{ route('admin.promo-banners.index') }}">
                    <i class="fas fa-bullhorn"></i> Promo Banners
                </a>
            </div>
            
            <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                <i class="fas fa-shopping-cart"></i> Orders
            </a>
            <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                <i class="fas fa-cog"></i> Site Settings
            </a>
            <hr class="border-secondary mx-3 my-4">
            <a class="nav-link" href="{{ url('/') }}" target="_blank">
                <i class="fas fa-external-link-alt"></i> View Shop
            </a>
            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </nav>
    </aside>

    <main class="main-content">
        <header class="mb-5 d-flex justify-content-between align-items-center">
            <h1 class="h2">@yield('title')</h1>
            <div class="user-profile">
                <span>Welcome, {{ auth()->user()->name }}</span>
            </div>
        </header>

        @if(session('success'))
            <div class="alert alert-success bg-success text-white border-0 rounded-3 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

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

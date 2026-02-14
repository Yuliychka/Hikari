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
            --admin-bg: #0a0a0a;
            --admin-card: rgba(255, 255, 255, 0.05);
            --admin-accent: crimson;
            --admin-text: #eee;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--admin-bg);
            color: var(--admin-text);
            margin: 0;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(15px);
            border-right: 1px solid rgba(220, 20, 60, 0.3);
            padding: 2rem 1rem;
            z-index: 1000;
        }

        .sidebar-brand {
            font-family: 'Kaushan Script', cursive;
            font-size: 2.5rem;
            color: var(--admin-accent);
            text-align: center;
            margin-bottom: 3rem;
            text-shadow: 0 0 10px var(--admin-accent);
        }

        .nav-link {
            color: #aaa;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 0.5rem;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-link:hover, .nav-link.active {
            color: #fff;
            background: var(--admin-accent);
            box-shadow: 0 0 15px rgba(220, 20, 60, 0.4);
        }

        .nav-link i {
            width: 20px;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
        }

        .glass-card {
            background: var(--admin-card);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .btn-premium {
            background: var(--admin-accent);
            color: #fff;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 20, 60, 0.5);
            color: #fff;
        }

        .table {
            color: var(--admin-text);
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
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-active { background: rgba(0, 255, 100, 0.1); color: #00ff64; }
        .status-inactive { background: rgba(255, 50, 50, 0.1); color: #ff3232; }

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
            <a class="nav-link {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}" href="{{ route('admin.banners.index') }}">
                <i class="fas fa-image"></i> Banners & Slides
            </a>
            <a class="nav-link" href="#">
                <i class="fas fa-shopping-cart"></i> Orders
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
</body>
</html>

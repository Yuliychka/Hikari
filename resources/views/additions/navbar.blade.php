
<style>
    /* Navbar Container */
    .glass-nav {
        position: fixed;
        background: rgba(0, 0, 0, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 2px solid crimson; /* full border for pill */
        box-shadow: 0 5px 20px rgba(220, 20, 60, 0.3);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        height: 65px;
        padding: 0;
        width: 95%;
        max-width: 1400px;
        left: 50%;
        transform: translateX(-50%);
        top: 20px; /* Floating from top */
        border-radius: 50px;
        margin: 0 auto;
        z-index: 9999;
        /* Stable, explicit transition to prevent vibration */
        transition: width 0.4s ease, border-radius 0.4s ease, top 0.4s ease, background 0.4s ease;
    }

    /* Scrolled State - Take Full Page but keep content in container */
    .glass-nav.scrolled {
        width: 92% !important;
        max-width: 1520px !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        top: 0 !important;
        border-radius: 0 0 20px 20px !important;
        border-left: 2px solid crimson !important;
        border-right: 2px solid crimson !important;
        border-top: none !important;
        border-bottom: 2px solid crimson;
        box-shadow: 0 2px 10px rgba(220, 20, 60, 0.4);
    }

    /* Ultra-wide screens — reduce edge space further */
    @media (min-width: 1600px) {
        .glass-nav.scrolled {
            width: 96% !important;
            max-width: 1900px !important;
        }
    }
    @media (min-width: 2000px) {
        .glass-nav.scrolled {
            width: 97% !important;
            max-width: 2400px !important;
        }
    }

    /* Mobile Responsive Fix - Restoration of Transformation */
    @media (max-width: 768px) {
        .glass-nav {
            width: 90% !important; /* Pill state on mobile */
            max-width: calc(100vw - 20px) !important; /* Prevent overflow */
            left: 50% !important;
            transform: translateX(-50%) !important;
            top: 15px !important;
            border-radius: 40px !important;
            height: 55px !important;
        }
        
        .glass-nav.scrolled {
            width: 100% !important;
            max-width: 100vw !important;
            left: 0 !important;
            transform: none !important;
            top: 0 !important;
            border-radius: 0 !important;
            height: 60px !important;
        }

        /* 2-Column Grid for Burger Menu - Minimalist */
        .mobile-menu-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: 100%;
            max-width: 400px;
            gap: 15px;
            padding: 0 25px;
        }

        .mobile-menu-grid .collection-item {
            font-size: 1.1rem !important;
            margin: 0 !important;
            padding: 12px 5px;
            background: none !important; /* No more box */
            border: none !important; /* No more border */
            border-bottom: 1px solid rgba(220, 20, 60, 0.1) !important; /* Subtle separator */
            border-radius: 0 !important;
            transition: all 0.3s ease;
        }

        .mobile-menu-grid .collection-item:hover {
            color: crimson !important;
            border-bottom-color: crimson !important;
            text-shadow: 0 0 10px rgba(220, 20, 60, 0.5);
        }

        .mobile-menu-grid .collection-item span {
            font-size: 0.55rem !important;
            margin-top: 1px !important;
            opacity: 0.6;
        }

        #mobileMenuOverlay .d-flex.flex-column {
            padding-top: 15px !important; /* Further reduced */
            gap: 8px !important; /* Further reduced */
        }
        
        /* Reduce search bar size */
        #mobileMenuOverlay .search-bar-container {
            margin-top: 3px !important;
            margin-bottom: 3px !important;
        }
        
        #mobileMenuOverlay .search-bar-container input {
            font-size: 0.75rem !important;
            padding: 0.4rem !important;
        }
        
        #mobileMenuOverlay .search-bar-container button {
            font-size: 0.65rem !important;
            padding: 0.4rem 0.6rem !important;
        }
        
        /* Reduce social icons spacing */
        #mobileMenuOverlay .d-flex.gap-4 {
            gap: 0.8rem !important;
            margin-top: 0.3rem !important;
            margin-bottom: 0.8rem !important;
        }
    }

    /* Scaling for Intermediate Desktop/Tablet Screens */
    @media (max-width: 1400px) and (min-width: 992px) {
        .nav-content-grid {
            gap: 20px !important; 
        }
        .nav-link {
            font-size: 0.8rem !important;
            padding: 6px 14px !important;
        }
        .navbar-nav {
            gap: 15px !important;
        }
        .nav-icons {
            gap: 15px !important;
        }
        .brand-logo {
            height: 40px !important; 
        }
        .nav-icon {
            width: 45px !important;
            height: 45px !important;
        }
        .nav-icon svg {
            width: 22px !important;
            height: 22px !important;
        }
        .nav-icon::after {
            font-size: 0.7rem !important;
            bottom: -32px !important;
        }
        .btn-outline-danger {
            font-size: 0.8rem !important;
            padding: 6px 12px !important;
        }
    }

    /* Extra Tightening for 1155px and below */
    @media (max-width: 1155px) and (min-width: 992px) {
        .nav-content-grid {
            gap: 8px !important;
            padding: 0 5px !important;
        }
        .navbar-nav {
            gap: 5px !important;
        }
        .nav-icons {
            gap: 5px !important;
        }
        .nav-link {
            padding: 6px 8px !important;
            font-size: 0.75rem !important;
        }
        .nav-icon {
            width: 40px !important;
            height: 40px !important;
        }
        .brand-logo {
            height: 35px !important;
        }
    }

    /* Flex Layout - Precision Alignment */
    .nav-content-grid {
        display: grid !important;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;
        width: 100%;
        height: 100%;
        gap: 20px; /* Base safe gap */
        padding: 0 !important;
    }

    .nav-link {
        color: #fff !important;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px !important; 
        font-size: 0.72rem !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        padding: 6px 14px !important; 
        white-space: nowrap;
        overflow: hidden;
        z-index: 1;
    }

    .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -110%;
        width: 120%;
        height: 100%;
        background: crimson;
        transform: skewX(-20deg);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        z-index: -1;
    }

    .nav-link:hover::before {
        left: -10%;
    }

    .nav-link i {
        font-size: 0.85rem !important;
        vertical-align: middle;
        position: relative;
        z-index: 2;
    }

    /* Active State Indicator */
    .nav-link.active {
        color: crimson !important;
    }
    
    .navbar-brand img {
        max-height: 38px !important;
        transition: transform 0.3s ease;
    }
    .navbar-brand:hover img {
        transform: scale(1.1);
    }


    .nav-left { 
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }
    .nav-center {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative !important;
        transform: none !important;
        left: 0 !important;
    }
    .nav-right { 
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    /* Target right icons except Search/Sharingan */
    .nav-right .nav-icon:not(.sharingan-parent),
    .nav-right .btn-outline-danger {
        transform: none;
    }

    /* Wishlist Devil Heart Wings Animation */
    .wishlist-devil-heart .devil-wings {
        opacity: 0;
        transform: scaleX(0);
        transform-origin: center;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    }
    .nav-icon:hover .wishlist-devil-heart .devil-wings {
        opacity: 1;
        transform: scaleX(1);
    }
    .nav-icon:hover .wishlist-devil-heart .devil-tail {
        animation: tailWag 0.6s ease-in-out infinite;
    }
    @keyframes tailWag {
        0%, 100% { transform: rotate(0deg); }
        50% { transform: rotate(10deg); }
    }

    /* Custom Tooltip */
    .nav-icon {
        position: relative;
    }
    .nav-icon::after {
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
        font-size: 0.75rem;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        border: 1px solid crimson;
        box-shadow: 0 0 10px rgba(220, 20, 60, 0.3);
        pointer-events: none;
        z-index: 1050;
    }
    .nav-icon:hover::after {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
        visibility: visible;
    }

    /* Suppress Tooltip when Search or Profile is Open */
    .dropdown.active .nav-icon::after,
    .profile-dropdown.active .nav-icon::after {
        opacity: 0 !important;
        visibility: hidden !important;
        transform: translateX(-50%) translateY(10px) !important;
    }

    /* Logo - Smaller & Static */
    .brand-logo {
        filter: drop-shadow(0 0 2px rgba(255, 255, 255, 0.3));
        transition: transform 0.3s;
        height: 45px; /* Smaller size */
    }
    .brand-logo:hover {
        transform: scale(1.1);
        filter: drop-shadow(0 0 10px crimson);
    }

    /* Icons */
    .nav-icon {
        color: #ddd;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        position: relative;
    }

    /* Profile Dropdown Styling */
    .profile-dropdown {
        position: relative;
        display: inline-block;
    }

    .profile-menu {
        position: absolute;
        top: 100%;
        right: 0;
        background: rgba(0, 0, 0, 0.95);
        backdrop-filter: blur(20px);
        border: 2px solid crimson;
        border-radius: 0;
        min-width: 180px;
        display: none;
        z-index: 100001;
        padding: 10px 0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        margin-top: 10px;
    }

    .profile-menu::before {
        content: '';
        position: absolute;
        bottom: 100%;
        right: 15px;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid crimson;
    }

    .profile-menu.show {
        display: block;
    }


    .profile-item {
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        display: block;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s;
        border-left: 3px solid transparent;
    }

    .profile-item:hover {
        background: rgba(220, 20, 60, 0.1);
        color: crimson;
        border-left: 3px solid crimson;
    }
    .nav-icon svg {
        width: 24px; /* Standardize SVG size */
        height: 24px;
    }
    .nav-icon:hover {
        color: crimson;
        background: rgba(220, 20, 60, 0.1);
        transform: translateY(-2px);
    }

    /* Sharingan - Enhanced Detail */
    .sharingan-icon {
        transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    }
    .nav-icon:hover .sharingan-icon {
        animation: activeSharingan 2s infinite linear;
        filter: drop-shadow(0 0 5px red);
    }
    @keyframes activeSharingan {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    /* Garganta Visuals (Admin Panel Icon) */
    .admin-void-crack-svg .void-crack-open {
        opacity: 0.6; /* More open by default */
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        transform: scaleY(0.5); /* Wider idle state */
        transform-origin: center;
        filter: url(#voidWarpIdle) drop-shadow(0 0 5px white);
    }
    .admin-void-crack-svg .reishi-particle {
        opacity: 0;
        transition: all 0.5s ease;
    }
    @keyframes reishiEscape {
        0% { transform: translate(0, 0); opacity: 1; }
        100% { transform: translate(var(--tx), var(--ty)); opacity: 0; }
    }
    .admin-void-crack-svg .void-crack-reveal {
        opacity: 0;
        transform: scale(0.6) translateY(5px);
        transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .nav-icon:hover .admin-void-crack-svg .void-crack-open {
        opacity: 1;
        transform: scaleY(1.5); /* Even wider on hover */
        filter: url(#voidWarpActive) drop-shadow(0 0 15px white);
        animation: riftJitter 0.15s infinite;
    }
    @keyframes riftJitter {
        0% { transform: scaleY(1.4) translateX(0); }
        50% { transform: scaleY(1.42) translateX(1px); }
        100% { transform: scaleY(1.4) translateX(0); }
    }
    .nav-icon:hover .admin-void-crack-svg .reishi-particle {
        animation: reishiEscape 1.5s infinite linear;
    }
    .nav-icon:hover .admin-void-crack-svg .void-crack-reveal {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
    .admin-void-crack-svg .void-crack-closed {
        opacity: 0.6;
        transition: opacity 0.3s ease;
        filter: url(#voidWarpIdle);
    }
    .nav-icon:hover .admin-void-crack-svg .void-crack-closed {
        opacity: 0;
    }

    .admin-void-crack-svg {
        transform: translateY(4px); /* Vertical adjustment */
        transition: all 0.3s ease;
    }

    /* Standardized Icon Wrapper */
    .nav-icons {
        display: flex;
        align-items: center;
        gap: 15px; 
    }

    /* --- EXTREME SOCIAL & PORTAL OVERHAUL --- */
    .social-orb {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent; /* Minimalist floating */
        border: 1px solid rgba(220, 20, 60, 0.2);
        border-radius: 50%;
        color: rgba(255, 255, 255, 0.6);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.5),
                    0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .social-orb::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(220, 20, 60, 0.2) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .social-orb:hover {
        color: #fff;
        transform: translateY(-5px) scale(1.1);
        border-color: crimson;
        box-shadow: 0 0 20px rgba(220, 20, 60, 0.4),
                    inset 0 0 5px rgba(220, 20, 60, 0.5);
    }

    .social-orb:hover::before {
        opacity: 1;
    }

    .social-orb svg {
        position: relative;
        z-index: 1;
        filter: drop-shadow(0 0 5px rgba(0,0,0,0.5));
    }

    /* Garganta Portal (Admin) */
    .garganta-portal {
        width: 55px;
        height: 55px;
        background: rgba(0, 0, 0, 0.8);
        border: 2px solid crimson;
        box-shadow: 0 0 25px rgba(220, 20, 60, 0.4);
        border-radius: 50%;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        animation: portalFloat 3s infinite ease-in-out;
    }

    @keyframes portalFloat {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }

    .garganta-portal::after {
        content: '';
        position: absolute;
        width: 120%;
        height: 120%;
        border: 1px dashed crimson;
        border-radius: 50%;
        opacity: 0.3;
        animation: portalRotate 10s infinite linear;
    }

    @keyframes portalRotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .garganta-portal .reishi-ring {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        box-shadow: 0 0 10px crimson;
        opacity: 0.5;
        animation: portalPulse 2s infinite alternate;
    }

    @keyframes portalPulse {
        from { transform: scale(0.9); opacity: 0.3; }
        to { transform: scale(1.1); opacity: 0.7; }
    }

    .garganta-portal:hover {
        transform: scale(1.2) rotate(5deg);
        box-shadow: 0 0 50px crimson, inset 0 0 20px white;
    }

    .garganta-portal svg {
        width: 30px;
        height: 30px;
        filter: drop-shadow(0 0 8px white);
        transition: all 0.3s;
    }

    .garganta-portal:hover svg {
        transform: scale(1.2);
    }

    /* Collections Mega Menu Overlay */
    .collections-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 0;
        background: rgba(10, 10, 10, 0.98);
        z-index: 99999; /* Just below navbar */
        overflow: hidden;
        transition: height 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.4s ease;
        opacity: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
    }
    .collections-overlay.active {
        height: 100vh;
        opacity: 1;
        z-index: 100001; /* On top of everything */
    }
    
    .collection-item {
        color: white;
        text-decoration: none;
        font-family: 'Kaushan Script', cursive;
        font-size: 3rem;
        margin: 0 2rem;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.3s ease;
        position: relative;
    }
    .collections-overlay    .nav-link {
        color: #fff !important;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: -0.1px !important; 
        font-size: 0.72rem !important; /* Bigger as requested */
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        padding: 0.4rem 0.6rem !important; 
        white-space: nowrap;
        overflow: hidden;
    }

    /* Old Style Skewed Hover */
    .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: crimson;
        transform: skewX(-20deg);
        transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: -1;
    }

    .nav-link:hover {
        color: #fff !important;
    }

    .nav-link:hover::before {
        left: 0;
    }

    .collections-overlay.active .collection-item {
        opacity: 1;
        transform: translateY(0);
        /* Staggered animation handled by JS/CSS delay */
    }
    .collection-item:hover {
        color: crimson;
        text-shadow: 0 0 20px crimson;
        transform: scale(1.1) !important;
    }
    .collection-item span {
        display: block;
        font-size: 0.85rem;
        font-family: 'Poppins', sans-serif;
        text-align: center;
        color: #888;
        margin-top: 5px;
        max-width: 100%;
        line-height: 1.4;
        word-wrap: break-word;
        white-space: normal;
        padding: 0 10px;
    }

    .close-btn {
        position: absolute;
        top: 30px;
        right: 40px;
        font-size: 3rem;
        color: white;
        cursor: pointer;
        transition: transform 0.3s;
    }
    .close-btn:hover {
        transform: rotate(90deg);
        color: crimson;
    }

    /* Manga Menu Toggler */
    .manga-toggler {
        border: none !important;
        box-shadow: none !important;
        padding: 0;
        width: 40px;
        height: 40px;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .manga-line {
        fill: none;
        stroke: white;
        stroke-width: 3;
        stroke-linecap: round;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        transform-origin: center;
    }
    /* Default State (Parallel Lines - "Speed Lines") */
    .manga-toggler.collapsed .line-top {
        d: path("M 2 10 L 38 10");
    }
    .manga-toggler.collapsed .line-mid {
        d: path("M 10 20 L 30 20");
        opacity: 1;
    }
    .manga-toggler.collapsed .line-bot {
        d: path("M 5 30 L 35 30");
    }

    /* Active State (X Shape) */
    .manga-toggler:not(.collapsed) .line-top {
        d: path("M 10 10 L 30 30"); /* Cross 1 */
        stroke: crimson;
    }
    .manga-toggler:not(.collapsed) .line-mid {
        opacity: 0;
        transform: scale(0);
    }
    .manga-toggler:not(.collapsed) .line-bot {
        d: path("M 10 30 L 30 10"); /* Cross 2 */
        stroke: crimson;
    }
</style>

<!-- PC Navbar (Desktop Only) -->
<nav class="navbar navbar-expand-lg fixed-top glass-nav navbar-dark d-none d-lg-block">
    <div id="navContainer" class="container h-100 px-4 transition-all">
        <div class="nav-content-grid">
            <!-- LEFT: Links -->
            <div class="nav-left">
                <ul class="navbar-nav gap-3 ms-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Store</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" onclick="toggleCollections(event)">Collections</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>

            <!-- CENTER: Logo -->
            <div class="nav-center">
                <a class="navbar-brand m-0" href="/">
                    <img src="{{ asset('Images/Logo.png') }}" alt="Hikari" class="brand-logo">
                </a>
            </div>

            <!-- RIGHT: Icons -->
            <div class="nav-right">
                <div class="nav-icons me-0">
                    <!-- Search -->
                    <div class="dropdown">
                        <a class="nav-icon sharingan-parent" href="#" role="button" data-tooltip="Search" onclick="toggleSearchDropdown(event)">
                             <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 100 100" class="sharingan-icon">
                                <circle cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="6"/>
                                <circle cx="50" cy="50" r="10" fill="currentColor"/>
                                <circle cx="50" cy="50" r="28" fill="none" stroke="currentColor" stroke-width="2" style="opacity: 0.6;"/>
                                <path d="M50 20 Q 56 16, 50 12 A 4 4 0 1 0 50 20" fill="currentColor" transform="rotate(0, 50, 50)"/>
                                <circle cx="50" cy="16" r="5" fill="currentColor" transform="rotate(0, 50, 50)"/>
                                <path d="M50 20 Q 56 16, 50 12 A 4 4 0 1 0 50 20" fill="currentColor" transform="rotate(120, 50, 50)"/>
                                <circle cx="50" cy="16" r="5" fill="currentColor" transform="rotate(120, 50, 50)"/>
                                <path d="M50 20 Q 56 16, 50 12 A 4 4 0 1 0 50 20" fill="currentColor" transform="rotate(240, 50, 50)"/>
                                <circle cx="50" cy="16" r="5" fill="currentColor" transform="rotate(240, 50, 50)"/>
                            </svg>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-2 mt-3 glass-dropdown" style="min-width: 250px; background: rgba(0,0,0,0.95); border: 1px solid crimson;">
                            <form action="{{ route('products.index') }}" method="GET" class="d-flex">
                                <input class="form-control me-2 bg-transparent text-white border-crimson rounded-0" type="search" name="search" placeholder="Search...">
                                <button class="btn btn-danger rounded-0" type="submit">GO</button>
                            </form>
                        </ul>
                    </div>

                    <!-- Wishlist -->
                    <!-- Wishlist -->
                    <a class="nav-icon" href="{{ route('wishlist.index') }}" data-tooltip="Wishlist" style="transform: translateY(0px);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 32 32" class="wishlist-devil-heart">
                            <!-- Bat Wings (appear on hover) -->
                            <g class="devil-wings">
                                <!-- Left Wing -->
                                <path d="M4 12 Q2 10, 1 12 Q2 14, 4 13 Q5 11, 6 12 Q7 10, 8 12" fill="currentColor" opacity="0.8"/>
                                <!-- Right Wing -->
                                <path d="M28 12 Q30 10, 31 12 Q30 14, 28 13 Q27 11, 26 12 Q25 10, 24 12" fill="currentColor" opacity="0.8"/>
                            </g>
                            <!-- Devil Heart Body -->
                            <path d="M16 27 l-1.8-1.6 C9.3 21 6 18.3 6 14.5 C6 11.4 8.4 9 11.5 9 c2.2 0 4.3 1 5.5 2.6 C18.2 10 20.3 9 22.5 9 C25.6 9 28 11.4 28 14.5 c0 3.8-3.3 6.5-8.2 10.9 L16 27z" stroke="currentColor" stroke-width="1.8" fill="none"/>
                            <!-- Prominent Left Horn -->
                            <path d="M11 9 Q9.5 6, 8.5 5 Q9 6, 10 7.5 Q10.5 8.5, 11 9" fill="currentColor" stroke="currentColor" stroke-width="0.8"/>
                            <!-- Prominent Right Horn -->
                            <path d="M21 9 Q22.5 6, 23.5 5 Q23 6, 22 7.5 Q21.5 8.5, 21 9" fill="currentColor" stroke="currentColor" stroke-width="0.8"/>
                            <!-- Visible Devil Tail with arrow tip -->
                            <g class="devil-tail" transform-origin="16 27">
                                <path d="M16 27 Q18 29, 20 28.5 Q19.5 29, 19 29.5" stroke="crimson" stroke-width="1.8" fill="none" stroke-linecap="round"/>
                                <path d="M20 28.5 L21 27.5 L20.5 29 L19 29.5 Z" fill="crimson"/>
                            </g>
                            <!-- Heart Accent -->
                            <circle cx="16" cy="16" r="2" fill="crimson" opacity="0.7"/>
                        </svg>
                    </a>

                    <!-- Cart -->
                    <a class="nav-icon" href="{{ route('cart.index') }}" data-tooltip="Cart">
                       <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M2 12 L12 7 L22 12" stroke="currentColor" stroke-width="2" fill="none"/>
                          <rect x="4" y="12" width="16" height="8" stroke="currentColor" stroke-width="2" fill="none"/>
                          <circle cx="20" cy="14" r="2" fill="crimson"/>
                          <circle cx="6" cy="21" r="2" fill="currentColor"/>
                          <circle cx="18" cy="21" r="2" fill="currentColor"/>
                          <path d="M5 12 V15 M9 12 V15 M15 12 V15 M19 12 V15" stroke="currentColor" stroke-width="1"/>
                        </svg>
                    </a>

                    <!-- Share -->
                     <a class="nav-icon d-none d-sm-flex" href="#" onclick="copyLink(event)" data-tooltip="Share">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24" style="transform: rotate(45deg);">
                             <path d="M12 2 L15 10 L12 16 L9 10 Z" fill="none" stroke="currentColor" stroke-width="2"/>
                             <path d="M12 16 L12 20" stroke="currentColor" stroke-width="2"/>
                             <circle cx="12" cy="22" r="2" fill="none" stroke="currentColor" stroke-width="2"/>
                             <path d="M14 22 L20 22 L22 18 L16 18 Z" fill="none" stroke="currentColor" stroke-width="1.5" stroke-dasharray="2,2"/>
                        </svg>
                    </a>

                    @auth
                        @if(auth()->user()->role == 'admin')
                            <a class="nav-icon" href="{{ route('admin.dashboard') }}" data-tooltip="Admin Panel">
                                <svg viewBox="0 0 100 100" class="admin-void-crack-svg" style="overflow: visible;">
                                    <defs>
                                        <filter id="voidWarpIdle">
                                            <feTurbulence type="fractalNoise" baseFrequency="0.05" numOctaves="2" result="noise">
                                                <animate attributeName="baseFrequency" values="0.05;0.06;0.05" dur="3s" repeatCount="indefinite" />
                                            </feTurbulence>
                                            <feDisplacementMap in="SourceGraphic" in2="noise" scale="2" />
                                        </filter>
                                        <filter id="voidWarpActive">
                                            <feTurbulence type="fractalNoise" baseFrequency="0.1" numOctaves="3" result="noise">
                                                <animate attributeName="baseFrequency" values="0.1;0.15;0.1" dur="0.5s" repeatCount="indefinite" />
                                            </feTurbulence>
                                            <feDisplacementMap in="SourceGraphic" in2="noise" scale="5" />
                                        </filter>
                                    </defs>
                                    <rect class="reishi-particle" x="50" y="50" width="1.5" height="1.5" fill="white" style="--tx: -30px; --ty: -40px; animation-delay: 0s;"/>
                                    <rect class="reishi-particle" x="50" y="50" width="2" height="2" fill="white" style="--tx: 25px; --ty: -35px; animation-delay: 0.3s;"/>
                                    <rect class="reishi-particle" x="50" y="50" width="1" height="1" fill="white" style="--tx: -20px; --ty: 40px; animation-delay: 0.7s;"/>
                                    <path class="void-crack-open" d="M2 50 L10 32 L20 52 L30 25 L40 55 L50 20 L60 58 L70 28 L80 65 L90 35 L98 50 L88 65 L78 45 L68 75 L58 45 L48 80 L38 45 L28 75 L18 42 L10 65 Z" fill="white"/>
                                    <g class="void-crack-reveal">
                                        <path d="M35 50 L50 35 L65 50 L50 65 Z" fill="crimson" opacity="0.4"/> 
                                        <path d="M40 50 L60 50" stroke="white" stroke-width="3" stroke-linecap="round" style="filter: blur(1px);"/>
                                        <circle cx="50" cy="50" r="18" fill="none" stroke="crimson" stroke-width="0.5" opacity="0.3"/>
                                    </g>
                                    <rect class="void-crack-glow" x="5" y="49.5" width="90" height="1" fill="crimson" opacity="0.8">
                                        <animate attributeName="opacity" values="0.6;1;0.6" dur="1s" repeatCount="indefinite" />
                                    </rect>
                                    <path class="void-crack-closed" d="M2 50 L15 45 L35 55 L55 42 L75 58 L98 50" fill="none" stroke="white" stroke-width="2" style="filter: drop-shadow(0 0 3px white);"/>
                                </svg>
                            </a>
                        @endif
                        <div class="profile-dropdown">
                            <a class="nav-icon" href="javascript:void(0)" onclick="toggleProfileDropdown(event)" data-tooltip="Profile">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                                </svg>
                            </a>
                            <div class="profile-menu">
                                <a href="{{ route('profile.edit') }}" class="profile-item">Account Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" class="profile-item" 
                                       onclick="event.preventDefault(); this.closest('form').submit();">
                                        Logout Session
                                    </a>
                                </form>
                            </div>
                        </div>
                    @else
                        <a class="btn btn-outline-danger rounded-0 px-2 btn-sm fw-bold border-2" href="{{ route('login') }}" style="font-size: 0.7rem;">
                            JOIN
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Navbar (Mobile Only) -->
<nav class="navbar fixed-top glass-nav navbar-dark d-flex d-lg-none">
    <div class="w-100 h-100 px-4">
        <div class="nav-content-grid">
            <!-- LEFT: Toggler -->
            <div class="nav-left">
                <button class="navbar-toggler manga-toggler collapsed" type="button" onclick="toggleMobileMenu()">
                     <svg width="30" height="30" viewBox="0 0 40 40">
                        <path class="manga-line line-top" d="M 2 10 L 38 10" />
                        <path class="manga-line line-mid" d="M 10 20 L 30 20" />
                        <path class="manga-line line-bot" d="M 5 30 L 35 30" />
                    </svg>
                </button>
            </div>

            <!-- CENTER: Logo -->
            <div class="nav-center">
                <a class="navbar-brand m-0" href="/">
                    <img src="{{ asset('Images/Logo.png') }}" alt="Hikari" class="brand-logo" style="height: 32px;">
                </a>
            </div>

            <!-- RIGHT: Basic Icons -->
            <div class="nav-right">
                <div class="nav-icons" style="gap: 12px;">
                    <!-- Wishlist -->
                    <a class="nav-icon text-center text-decoration-none" href="{{ route('wishlist.index') }}" data-tooltip="Wishlist" style="width: auto; height: auto;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 32 32" class="wishlist-devil-heart">
                            <!-- Bat Wings (appear on hover) -->
                            <g class="devil-wings">
                                <!-- Left Wing -->
                                <path d="M4 12 Q2 10, 1 12 Q2 14, 4 13 Q5 11, 6 12 Q7 10, 8 12" fill="currentColor" opacity="0.8"/>
                                <!-- Right Wing -->
                                <path d="M28 12 Q30 10, 31 12 Q30 14, 28 13 Q27 11, 26 12 Q25 10, 24 12" fill="currentColor" opacity="0.8"/>
                            </g>
                            <!-- Devil Heart Body -->
                            <path d="M16 27 l-1.8-1.6 C9.3 21 6 18.3 6 14.5 C6 11.4 8.4 9 11.5 9 c2.2 0 4.3 1 5.5 2.6 C18.2 10 20.3 9 22.5 9 C25.6 9 28 11.4 28 14.5 c0 3.8-3.3 6.5-8.2 10.9 L16 27z" stroke="currentColor" stroke-width="1.8" fill="none"/>
                            <!-- Prominent Left Horn -->
                            <path d="M11 9 Q9.5 6, 8.5 5 Q9 6, 10 7.5 Q10.5 8.5, 11 9" fill="currentColor" stroke="currentColor" stroke-width="0.8"/>
                            <!-- Prominent Right Horn -->
                            <path d="M21 9 Q22.5 6, 23.5 5 Q23 6, 22 7.5 Q21.5 8.5, 21 9" fill="currentColor" stroke="currentColor" stroke-width="0.8"/>
                            <!-- Visible Devil Tail with arrow tip -->
                            <g class="devil-tail" transform-origin="16 27">
                                <path d="M16 27 Q18 29, 20 28.5 Q19.5 29, 19 29.5" stroke="crimson" stroke-width="1.8" fill="none" stroke-linecap="round"/>
                                <path d="M20 28.5 L21 27.5 L20.5 29 L19 29.5 Z" fill="crimson"/>
                            </g>
                            <!-- Heart Accent -->
                            <circle cx="16" cy="16" r="2" fill="crimson" opacity="0.7"/>
                        </svg>
                    </a>

                    <!-- Simple Cart -->
                    <a class="nav-icon text-center text-decoration-none" href="{{ route('cart.index') }}" data-tooltip="Cart" style="width: auto; height: auto;">
                       <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M2 12 L12 7 L22 12" stroke="currentColor" stroke-width="2" fill="none"/>
                          <rect x="4" y="12" width="16" height="8" stroke="currentColor" stroke-width="2" fill="none"/>
                          <circle cx="20" cy="14" r="2" fill="crimson"/>
                          <circle cx="6" cy="21" r="2" fill="currentColor"/>
                          <circle cx="18" cy="21" r="2" fill="currentColor"/>
                          <path d="M5 12 V15 M9 12 V15 M15 12 V15 M19 12 V15" stroke="currentColor" stroke-width="1"/>
                        </svg>
                    </a>
                    
                    @auth
                    <div class="profile-dropdown">
                        <a class="nav-icon text-center text-decoration-none" href="javascript:void(0)" onclick="toggleProfileDropdown(event)" data-tooltip="Profile" style="width: auto; height: auto;">
                             <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                            </svg>
                        </a>
                        <div class="profile-menu">
                            <a href="{{ route('profile.show') }}" class="profile-item border-bottom border-secondary mb-2">MY FULL PROFILE</a>
                            
                            <!-- Section: Edit -->
                            <div class="px-3 py-1 mb-1 bg-dark-50">
                                <small class="text-danger-emphasis text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">Account Management</small>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="profile-item mb-2 mt-1">EDIT MY IDENTITY</a>
                            
                            <!-- Section: History -->
                            <div class="px-3 py-1 mb-1 mt-2 border-top border-secondary pt-2 bg-dark-50">
                                <small class="text-danger-emphasis text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">Command History</small>
                            </div>
                            <a href="{{ route('orders.index') }}" class="profile-item mb-2 mt-1">ORDER HISTORY</a>
                            
                            <form method="POST" action="{{ route('logout') }}" class="border-top border-dark mt-2 pt-2">
                                @csrf
                                <button type="submit" class="profile-item w-100 text-start border-0 bg-transparent text-danger">LOGOUT SESSION</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a class="btn btn-outline-danger border-2 p-1" href="{{ route('login') }}" style="font-size: 0.6rem; font-weight: 800; line-height: 1;">JOIN</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Menu Overlay (New) -->
<div id="mobileMenuOverlay" class="collections-overlay">
    <div class="close-btn" onclick="toggleMobileMenu()">&times;</div>
    <div class="d-flex flex-column align-items-center h-100 gap-2" style="padding-top: 40px; overflow-y: auto;">
        <div class="mobile-menu-grid">
            <a href="{{ route('products.index') }}" class="collection-item d-flex flex-column align-items-center" style="transition-delay: 0.2s;">
                Store
                <span>商店</span>
            </a>
            <a href="#" onclick="toggleCollections(event); toggleMobileMenu();" class="collection-item d-flex flex-column align-items-center" style="transition-delay: 0.3s;">
                Collections
                <span>コレクション</span>
            </a>
            <a href="{{ route('about') }}" class="collection-item d-flex flex-column align-items-center" style="transition-delay: 0.4s;">
                About Us
                <span>について</span>
            </a>
            <a href="{{ route('contact') }}" class="collection-item d-flex flex-column align-items-center" style="transition-delay: 0.45s;">
                Contact Us
                <span>お問い合わせ</span>
            </a>

            @auth
            <a href="{{ route('profile.show') }}" class="collection-item d-flex flex-column align-items-center" style="transition-delay: 0.5s;">
                My Profile
                <span>プロフィール</span>
            </a>
            <a href="{{ route('profile.edit') }}" class="collection-item d-flex flex-column align-items-center" style="transition-delay: 0.55s;">
                Edit Profile
                <span>編集</span>
            </a>
            <a href="{{ route('orders.index') }}" class="collection-item d-flex flex-column align-items-center" style="transition-delay: 0.6s;">
                History
                <span>履歴</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="w-100">
                @csrf
                <a href="{{ route('logout') }}" class="collection-item d-flex flex-column align-items-center" style="transition-delay: 0.7s;"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                    Logout
                    <span>ログアウト</span>
                </a>
            </form>
            @else
            <a href="{{ route('login') }}" class="collection-item d-flex flex-column align-items-center" style="transition-delay: 0.5s;">
                Login
                <span>ログイン</span>
            </a>
            @endauth
        </div>

        <!-- Search Bar Relocated Here -->
        <div class="search-bar-container w-100 mb-1" style="max-width: 320px; margin-top: 5px;">
            <form action="{{ route('products.index') }}" method="GET" class="d-flex shadow-sm" style="border: 1px solid rgba(220, 20, 60, 0.3); padding: 2px;">
                <input class="form-control bg-transparent text-white border-0 rounded-0 p-1" type="search" name="search" placeholder="Search Hikari..." style="box-shadow: none; font-size: 0.8rem;">
                <button class="btn btn-danger rounded-0 px-3 py-1 fw-bold" type="submit" style="font-size: 0.7rem;">GO</button>
            </form>
        </div>

        <!-- Drawer Footer Row (Minimalist Redesign) -->
        <div class="d-flex align-items-center justify-content-center gap-4 mt-1 mb-3 w-100" style="background: none; border: none; box-shadow: none;">
             
             <a href="{{ \App\Models\Setting::get('instagram_url', '#') }}" target="_blank" class="social-orb text-decoration-none">
                <i class="bi bi-instagram fs-5"></i>
              </a>

             <!-- Discord -->
             <a href="{{ \App\Models\Setting::get('discord_url', '#') }}" target="_blank" class="social-orb text-decoration-none">
                <i class="bi bi-discord fs-5"></i>
              </a>

             <!-- Facebook -->
             <a href="{{ \App\Models\Setting::get('facebook_url', '#') }}" target="_blank" class="social-orb text-decoration-none">
                <i class="bi bi-facebook fs-5"></i>
              </a>

             <!-- Admin Portal (Final Piece) -->
             @auth
                @if(auth()->user()->role == 'admin')
                     <a class="garganta-portal text-decoration-none" href="{{ route('admin.dashboard') }}">
                        <div class="reishi-ring"></div>
                        <svg viewBox="0 0 100 100" class="admin-void-crack-svg" style="overflow: visible;">
                            <path class="void-crack-open" d="M2 50 L10 32 L20 52 L30 25 L40 55 L50 20 L60 58 L70 28 L80 65 L90 35 L98 50 L88 65 L78 45 L68 75 L58 45 L48 80 L38 45 L28 75 L18 42 L10 65 Z" fill="#fff"/>
                        </svg>
                    </a>
                @endif
             @endauth
        </div>
    </div>
</div>

<!-- Collections Overlay -->
<div id="collectionsOverlay" class="collections-overlay">
    <div class="close-btn" onclick="toggleCollections(event)">&times;</div>
    <div class="container h-100">
        <div class="d-flex flex-column justify-content-center h-100">
            <h2 class="text-center text-white mb-5" style="font-family: 'Kaushan Script', cursive; font-size: 3rem; text-shadow: 0 0 10px crimson;">Our Collections</h2>
            <div class="row g-4 justify-content-center">
                @foreach($navbarCategories as $category)
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('products.index', ['category_id' => $category->id]) }}" class="collection-item w-100 text-center d-flex flex-column align-items-center justify-content-center" style="transition-delay: {{ $loop->iteration * 0.1 }}s;">
                        {{ $category->name }}
                        <!-- Optional: Add random Japanese text or description if available -->
                        <span>{{ $category->description ?? 'Explore ' . $category->name }}</span>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('categories.index') }}" class="btn btn-outline-danger btn-lg rounded-0 px-5 fw-bold" style="letter-spacing: 2px;">VIEW ALL CATEGORIES</a>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleCollections(event) {
        if(event) event.preventDefault();
        const overlay = document.getElementById('collectionsOverlay');
        overlay.classList.toggle('active');
    }

    function copyLink(event) {
        event.preventDefault();
        navigator.clipboard.writeText(window.location.href).then(() => {
            const toast = document.createElement('div');
            toast.innerText = 'Link Copied!';
            toast.style.position = 'fixed';
            toast.style.bottom = '20px';
            toast.style.right = '20px';
            toast.style.background = 'crimson';
            toast.style.color = 'white';
            toast.style.padding = '10px 20px';
            toast.style.borderRadius = '0px';
            toast.style.border = '2px solid white';
            toast.style.fontFamily = 'monospace';
            toast.style.fontWeight = 'bold';
            toast.style.zIndex = '10000';
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 2000);
        });
    }
    function toggleMobileMenu() {
        const overlay = document.getElementById('mobileMenuOverlay');
        const toggler = document.querySelector('.manga-toggler');
        if(overlay) overlay.classList.toggle('active');
        if(toggler) toggler.classList.toggle('collapsed');
    }

    // Toggle Search Dropdown
    function toggleSearchDropdown(event) {
        event.preventDefault();
        event.stopPropagation();
        const parent = event.currentTarget.closest('.dropdown');
        const menu = parent.querySelector('.dropdown-menu');
        
        // Close profile if open
        document.querySelectorAll('.profile-menu').forEach(m => m.classList.remove('show'));
        document.querySelectorAll('.profile-dropdown').forEach(p => p.classList.remove('active'));
        
        const isShowing = menu.classList.toggle('show');
        parent.classList.toggle('active', isShowing);
    }

    // Toggle Profile Dropdown
    function toggleProfileDropdown(event) {
        event.preventDefault();
        event.stopPropagation();
        const icon = event.currentTarget;
        const menu = icon.nextElementSibling;
        const parent = icon.closest('.profile-dropdown');
        
        // Close search if open
        document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.remove('show'));
        document.querySelectorAll('.dropdown').forEach(p => p.classList.remove('active'));
        
        const isShowing = menu.classList.toggle('show');
        if (parent) parent.classList.toggle('active', isShowing);
    }

    // Close dropdowns on outside click
    document.addEventListener('click', () => {
        document.querySelectorAll('.profile-menu, .dropdown-menu').forEach(m => m.classList.remove('show'));
        document.querySelectorAll('.profile-dropdown, .dropdown').forEach(p => p.classList.remove('active'));
    });

    // Scroll Transformation Logic
    function applyNavScroll() {
        const navs = document.querySelectorAll('.glass-nav');
        const navContainer = document.getElementById('navContainer');
        if (window.scrollY > 50) {
            navs.forEach(nav => nav.classList.add('scrolled'));
        } else {
            navs.forEach(nav => nav.classList.remove('scrolled'));
        }
    }
    window.addEventListener('scroll', applyNavScroll);
    // Run on page load to apply correct initial state
    applyNavScroll();
</script>
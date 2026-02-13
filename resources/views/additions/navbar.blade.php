
<style>
    /* Navbar Container */
    .glass-nav {
        background: rgba(0, 0, 0, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 2px solid crimson;
        box-shadow: 0 5px 20px rgba(220, 20, 60, 0.3);
        transition: all 0.3s ease;
        height: 70px; /* Reduced height for sleekness */
        padding: 0 2rem;
    }

    /* Flex Layout - Perfect Centering */
    .nav-left, .nav-right {
        flex: 1;
        display: flex;
        align-items: center;
    }
    .nav-left { justify-content: flex-start; }
    .nav-right { 
        justify-content: flex-end;
    }
    .nav-center {
        display: flex;
        justify-content: center;
        align-items: center;
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

    /* Links */
    .nav-link {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        letter-spacing: 1px;
        color: #ddd !important;
        position: relative;
        overflow: hidden;
        padding: 5px 12px !important;
        transition: color 0.3s;
        font-size: 0.85rem;
        text-transform: uppercase;
    }
    .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: crimson;
        transform: skewX(-20deg);
        transition: left 0.3s ease;
        z-index: -1;
    }
    .nav-link:hover::before {
        left: 0;
    }
    .nav-link:hover {
        color: #fff !important;
        text-shadow: 0 0 5px crimson;
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
        padding: 0; /* Remove padding to rely on flex centering */
        width: 45px; /* Fixed width */
        height: 45px; /* Fixed height */
        border-radius: 50%;
        position: relative;
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

    /* Collections Mega Menu Overlay */
    .collections-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 0;
        background: rgba(10, 10, 10, 0.98);
        z-index: 999; /* Below navbar (1030) but covering content */
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
        z-index: 2000; /* On top of everything */
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
        font-size: 1rem;
        font-family: 'Poppins', sans-serif;
        text-align: center;
        color: #888;
        margin-top: -10px;
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

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top glass-nav navbar-dark">
    <div class="container-fluid px-0 h-100">
        
        <!-- Navbar Layout Wrapper -->
        <div class="d-flex w-100 align-items-center h-100">
            <!-- LEFT: Links -->
            <div class="nav-left d-none d-lg-flex">
                <ul class="navbar-nav gap-3 ms-3">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Store</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" onclick="toggleCollections(event)">Collections</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                </ul>
            </div>

            <!-- Mobile Toggler (Left on Mobile) -->
            <button class="navbar-toggler manga-toggler ms-3 d-lg-none collapsed" type="button" onclick="toggleMobileMenu()">
                 <svg width="35" height="35" viewBox="0 0 40 40">
                    <path class="manga-line line-top" d="M 2 10 L 38 10" />
                    <path class="manga-line line-mid" d="M 10 20 L 30 20" />
                    <path class="manga-line line-bot" d="M 5 30 L 35 30" />
                </svg>
            </button>

            <!-- CENTER: Logo (Absolute centered) -->
            <div class="nav-center position-absolute start-50 translate-middle-x">
                <a class="navbar-brand m-0" href="/">
                    <img src="{{ asset('Images/Logo.png') }}" alt="Hikari" class="brand-logo">
                </a>
            </div>

            <!-- RIGHT: Icons (Always Visible) -->
            <div class="nav-right">
                <div class="d-flex align-items-center gap-2 me-3">
                    <!-- Search -->
                    <div class="dropdown">
                        <a class="nav-icon" href="#" role="button" data-bs-toggle="dropdown" data-tooltip="Search">
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
                        <a class="nav-icon" href="{{ route('profile.edit') }}" data-tooltip="Profile">
                             <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                            </svg>
                        </a>
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

<!-- Mobile Menu Overlay (New) -->
<div id="mobileMenuOverlay" class="collections-overlay">
    <div class="close-btn" onclick="toggleMobileMenu()">&times;</div>
    <div class="d-flex flex-column justify-content-center align-items-center h-100 gap-4">
        <a href="/" class="collection-item" style="transition-delay: 0.1s;">Home</a>
        <a href="{{ route('products.index') }}" class="collection-item" style="transition-delay: 0.2s;">Store</a>
        <a href="#" onclick="toggleCollections(event); toggleMobileMenu();" class="collection-item" style="transition-delay: 0.3s;">Collections</a>
        <a href="{{ route('about') }}" class="collection-item" style="transition-delay: 0.4s;">About</a>
    </div>
</div>

<!-- Collections Overlay -->
<div id="collectionsOverlay" class="collections-overlay">
    <div class="close-btn" onclick="toggleCollections(event)">&times;</div>
    <div class="d-flex flex-wrap justify-content-center align-items-center h-100">
        <a href="{{ route('products.index', ['category' => 'figures']) }}" class="collection-item" style="transition-delay: 0.1s;">
            Figures
            <span>Originals & Scale</span>
        </a>
        <a href="{{ route('products.index', ['category' => 'apparel']) }}" class="collection-item" style="transition-delay: 0.2s;">
            Apparel
            <span>Hoodies & Tees</span>
        </a>
        <a href="{{ route('products.index', ['category' => 'accessories']) }}" class="collection-item" style="transition-delay: 0.3s;">
            Accessories
            <span>Katana & Masks</span>
        </a>
        <a href="{{ route('products.index', ['category' => 'manga']) }}" class="collection-item" style="transition-delay: 0.4s;">
            Manga
            <span>Comics & Books</span>
        </a>
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
</script>
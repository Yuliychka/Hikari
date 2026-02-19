<footer class="bg-black py-5 mt-auto border-top border-danger" style="position: relative; z-index: 10;">
    <div class="container">
        <div class="row g-4 justify-content-center text-center text-md-start">
            <!-- Brand -->
            <div class="col-md-4 mb-4 mb-md-0 d-flex flex-column align-items-center align-items-md-start">
                <h3 class="fw-bold" style="font-family: 'Kaushan Script', cursive; color: crimson; font-size: 2rem;">Hikari</h3>
                <p class="text-secondary small mt-2">
                    Your ultimate destination for premium anime merchandise. Figures, apparel, and more directly from Japan.
                </p>
                <div class="d-flex gap-3 mt-3">
                    <a href="{{ \App\Models\Setting::get('facebook_url', '#') }}" target="_blank" class="text-white text-decoration-none hover-crimson" title="Facebook">
                        <i class="bi bi-facebook fs-5"></i>
                    </a>
                    <a href="{{ \App\Models\Setting::get('instagram_url', '#') }}" target="_blank" class="text-white text-decoration-none hover-crimson" title="Instagram">
                        <i class="bi bi-instagram fs-5"></i>
                    </a>
                    <a href="{{ \App\Models\Setting::get('discord_url', '#') }}" target="_blank" class="text-white text-decoration-none hover-crimson" title="Discord">
                        <i class="bi bi-discord fs-5"></i>
                    </a>
                    <a href="{{ \App\Models\Setting::get('twitter_url', '#') }}" target="_blank" class="text-white text-decoration-none hover-crimson" title="X (Twitter)">
                        <i class="bi bi-twitter-x fs-5"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-6 col-md-2 mb-4 mb-md-0">
                <h6 class="text-white fw-bold mb-3 text-uppercase" style="letter-spacing: 1px;">Shop</h6>
                <ul class="list-unstyled text-secondary small">
                    <li class="mb-2"><a href="{{ route('products.index') }}" class="text-decoration-none text-secondary hover-crimson">All Products</a></li>
                    <li class="mb-2"><a href="{{ route('products.index', ['filter' => 'new']) }}" class="text-decoration-none text-secondary hover-crimson">New Arrivals</a></li>
                    <li class="mb-2"><a href="{{ route('products.index', ['filter' => 'popular']) }}" class="text-decoration-none text-secondary hover-crimson">Best Sellers</a></li>
                </ul>
            </div>

            <!-- Information -->
            <div class="col-6 col-md-2 mb-4 mb-md-0">
                <h6 class="text-white fw-bold mb-3 text-uppercase" style="letter-spacing: 1px;">Info</h6>
                <ul class="list-unstyled text-secondary small">
                    <li class="mb-2"><a href="{{ route('about') }}" class="text-decoration-none text-secondary hover-crimson">About Us</a></li>
                    <li class="mb-2"><a href="{{ route('policies.shipping') }}" class="text-decoration-none text-secondary hover-crimson">Shipping Policy</a></li>
                    <li class="mb-2"><a href="{{ route('policies.returns') }}" class="text-decoration-none text-secondary hover-crimson">Returns</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="col-md-4">
                <h6 class="text-white fw-bold mb-3 text-uppercase" style="letter-spacing: 1px;">Stay Updated</h6>
                <p class="text-secondary small mb-3">Subscribe for exclusive offers and new drops.</p>
                <form action="#" class="d-flex">
                    <input type="email" class="form-control rounded-0 bg-dark border-secondary text-white" placeholder="Enter your email">
                    <button class="btn btn-danger rounded-0 fw-bold px-3">JOIN</button>
                </form>
            </div>
        </div>

        <hr class="border-secondary my-4 opacity-25">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p class="mb-0 text-secondary small">&copy; {{ date('Y') }} Hikari Anime Store. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/PayPal.svg/2560px-PayPal.svg.png" alt="PayPal" height="20" class="mx-2 opacity-50 grayscale hover-color" style="transition: all 0.3s; filter: grayscale(100%);">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/Visa.svg/1200px-Visa.svg.png" alt="Visa" height="20" class="mx-2 opacity-50 grayscale hover-color" style="transition: all 0.3s; filter: grayscale(100%);">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png" alt="Mastercard" height="20" class="mx-2 opacity-50 grayscale hover-color" style="transition: all 0.3s; filter: grayscale(100%);">
            </div>
        </div>
    </div>
    
    <style>
        .hover-crimson:hover {
            color: crimson !important;
        }
        .hover-color:hover {
            filter: grayscale(0%) !important;
            opacity: 1 !important;
        }
    </style>
</footer>

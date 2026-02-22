<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item->name }} - Hikari Anime Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- CSS for theme -->
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #080808;
            color: #fff;
            cursor: url('https://cdn.custom-cursor.com/db/cursor/32/katana_cursor.png'), auto !important;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Anime Style Background Elements */
        .kanji-watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 50vw;
            color: rgba(220, 20, 60, 0.03);
            font-weight: 900;
            z-index: -1;
            pointer-events: none;
            user-select: none;
            line-height: 1;
        }

        .product-showroom {
            min-height: 100vh;
            padding: 80px 0;
            position: relative;
            z-index: 1;
        }

        .premium-glass-card {
            background: linear-gradient(135deg, rgba(20, 20, 20, 0.8) 0%, rgba(10, 10, 10, 0.9) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(220, 20, 60, 0.2);
            border-radius: 0;
            padding: 60px;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.5), inset 0 0 20px rgba(220, 20, 60, 0.1);
            position: relative;
            overflow: hidden;
        }

        .premium-glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 40px;
            height: 40px;
            border-top: 3px solid crimson;
            border-left: 3px solid crimson;
        }

        .premium-glass-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 40px;
            height: 40px;
            border-bottom: 3px solid crimson;
            border-right: 3px solid crimson;
        }

        .breadcrumb-showroom {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.4);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 30px;
            padding-left: 10px;
            border-left: 3px solid crimson;
        }

        .breadcrumb-showroom a {
            color: #fff;
            text-decoration: none;
            opacity: 0.6;
            transition: all 0.3s ease;
        }

        .breadcrumb-showroom a:hover {
            opacity: 1;
            color: crimson;
            text-shadow: 0 0 10px crimson;
        }

        /* Cyber Showcase */
        .image-showcase {
            position: relative;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        .main-image-viewport {
            position: relative;
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
            aspect-ratio: 4 / 5;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
        }

        .main-image-viewport::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.25) 50%), linear-gradient(90deg, rgba(255, 0, 0, 0.06), rgba(0, 255, 0, 0.02), rgba(0, 0, 255, 0.06));
            z-index: 2;
            background-size: 100% 2px, 3px 100%;
            pointer-events: none;
            opacity: 0.3;
        }

        .main-image-viewport:hover {
            border-color: crimson;
            box-shadow: 0 0 40px rgba(220, 20, 60, 0.2);
            transform: scale(1.02);
        }

        .main-image-viewport img {
            max-width: 85%;
            max-height: 85%;
            object-fit: contain;
            filter: drop-shadow(0 0 20px rgba(220, 20, 60, 0.2));
            z-index: 1;
            transition: transform 0.5s ease;
        }

        .main-image-viewport:hover img {
            transform: scale(1.05);
        }

        .thumb-nav {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 25px;
        }

        .thumb-item {
            width: 65px;
            height: 65px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.3);
            padding: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .thumb-item.active {
            border-color: crimson;
            box-shadow: 0 0 15px rgba(220, 20, 60, 0.3);
            transform: translateY(-3px);
        }

        /* Typography */
        .artifact-label {
            font-family: 'Kaushan Script', cursive;
            color: crimson;
            font-size: 1.2rem;
            display: block;
            margin-bottom: 5px;
        }

        .product-name-container {
            position: relative;
            margin-bottom: 20px;
        }

        .product-name {
            font-weight: 900;
            font-size: 4rem;
            line-height: 1;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: -2px;
            position: relative;
            z-index: 1;
        }

        .glitch-effect {
            animation: glitch 3s infinite;
        }

        @keyframes glitch {
            0% { text-shadow: 2px 2px crimson; }
            2% { text-shadow: -2px -2px blue; }
            4% { text-shadow: 0px 0px crimson; }
            100% { text-shadow: 2px 2px crimson; }
        }

        .price-display {
            font-size: 3rem;
            font-weight: 900;
            color: crimson;
            display: flex;
            align-items: baseline;
            gap: 15px;
            font-family: 'Poppins', sans-serif;
        }

        .price-old {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.2);
            text-decoration: line-through;
            font-weight: 400;
        }

        /* JRPG Stats */
        .jrpg-stats {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 20px;
            margin: 30px 0;
            position: relative;
        }

        .jrpg-stat-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding-bottom: 8px;
        }

        .jrpg-stat-row:last-child {
            margin-bottom: 0;
            border-bottom: none;
        }

        .jrpg-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: crimson;
            letter-spacing: 2px;
            font-weight: 700;
        }

        .jrpg-value {
            font-weight: 600;
            font-size: 0.9rem;
            color: #fff;
        }

        .stock-bar-container {
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            margin-top: 10px;
        }

        .stock-bar-fill {
            height: 100%;
            background: crimson;
            box-shadow: 0 0 10px crimson;
        }

        /* Buttons */
        .btn-acquire-anime {
            background: crimson;
            color: #fff;
            border: none;
            padding: 20px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 3px;
            width: 100%;
            position: relative;
            transition: all 0.3s ease;
            clip-path: polygon(5% 0, 100% 0, 95% 100%, 0 100%);
        }

        .btn-acquire-anime:hover:not(:disabled) {
            background: #fff;
            color: crimson;
            transform: translateX(10px);
        }

        .btn-wish-anime {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-wish-anime:hover {
            border-color: crimson;
            color: crimson;
            background: rgba(220, 20, 60, 0.1);
        }

        .theme-section-title {
            font-family: 'Kaushan Script', cursive;
            color: crimson;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .theme-section-title::after {
            content: '';
            height: 2px;
            flex-grow: 1;
            background: linear-gradient(to right, crimson, transparent);
        }
    </style>
    </style>
</head>

<body>
    @include('additions.navbar')

    <div class="kanji-watermark">光</div>

    <div class="product-showroom">
        <div class="container">
            <!-- Navigation Breadcrumbs (Moved Outside) -->
            <div class="breadcrumb-showroom" data-aos="fade-down">
                <a href="/">HUB</a>
                <span class="mx-2 opacity-25">/</span>
                @if($item->category)
                    <a href="{{ route('products.index', ['category' => $item->category->slug]) }}">{{ $item->category->name }}</a>
                    <span class="mx-2 opacity-25">/</span>
                @endif
                <span class="opacity-50 fw-light">{{ $item->name }}</span>
            </div>

            <div class="premium-glass-card" data-aos="fade-up">
                <div class="row g-5">
                    <!-- Image Showcase Section -->
                    <div class="col-lg-6">
                        <div class="image-showcase">
                            <div class="main-image-viewport" data-aos="zoom-in" data-aos-delay="200">
                                <img src="{{ Str::startsWith($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}" alt="{{ $item->name }}" id="mainImage">
                                
                                @if($item->active_flash_sale)
                                    <div class="position-absolute top-0 end-0 p-4">
                                        <span class="badge bg-danger rounded-pill px-3 py-2 fw-bold shadow"><i class="bi bi-lightning-charge-fill me-1"></i> FLASH SALE</span>
                                    </div>
                                @elseif($item->discount_active)
                                    <div class="position-absolute top-0 end-0 p-4">
                                        <span class="badge bg-danger rounded-pill px-3 py-2 fw-bold shadow">PROMO</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Thumbnail Navigation -->
                            <div class="thumb-nav" data-aos="fade-up" data-aos-delay="400">
                                <div class="thumb-item active" onclick="updateMainImage(this)">
                                    <img src="{{ Str::startsWith($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}" class="w-100 h-100 object-fit-contain">
                                </div>
                                @foreach($item->images as $galleryImg)
                                    <div class="thumb-item" onclick="updateMainImage(this)">
                                        <img src="{{ asset('storage/' . $galleryImg->image_path) }}" class="w-100 h-100 object-fit-contain">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Product Specifications Section -->
                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                        <div class="ps-lg-5">
                            <span class="artifact-label">ARTIFACT ACCESS</span>
                            
                            <div class="product-name-container">
                                <h1 class="product-name glitch-effect">{{ $item->name }}</h1>
                            </div>

                            <div class="d-flex align-items-center gap-3 mb-4">
                                <div class="price-display">
                                    ${{ number_format($item->effective_price, 2) }}
                                    @if($item->active_flash_sale)
                                        <span class="price-old">${{ number_format($item->price, 2) }}</span>
                                    @elseif($item->discount_active && $item->old_price)
                                        <span class="price-old">${{ number_format($item->old_price, 2) }}</span>
                                    @endif
                                </div>
                                <div class="font-monospace text-white-50 small">ID: {{ $item->sku ?? 'HK-'.$item->id }}</div>
                            </div>

                            <!-- JRPG Stats Card -->
                            <div class="jrpg-stats">
                                <div class="jrpg-stat-row">
                                    <span class="jrpg-label">Class</span>
                                    <span class="jrpg-value text-uppercase">{{ $item->category->name }} / {{ $item->subcategory->name ?? 'Core' }}</span>
                                </div>
                                <div class="jrpg-stat-row">
                                    <span class="jrpg-label">Durability</span>
                                    <span class="jrpg-value">{{ $item->stock_quantity > 0 ? 'Optimal ('.$item->stock_quantity.' Units)' : 'DEPLETED' }}</span>
                                </div>
                                <div class="jrpg-stat-row">
                                    <span class="jrpg-label">Warrior Rank</span>
                                    <div class="jrpg-value">
                                        @php 
                                            $avgRating = $item->reviews->avg('rating') ?: 5.0; 
                                            $reviewCount = $item->reviews->count();
                                        @endphp
                                        <span class="text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star{{ $i <= round($avgRating) ? '-fill' : '' }}"></i>
                                            @endfor
                                        </span>
                                        <small class="text-white-50 ms-2">({{ $avgRating }})</small>
                                    </div>
                                </div>
                                <div class="stock-bar-container">
                                    <div class="stock-bar-fill" style="width: {{ $item->stock_quantity > 0 ? min(100, $item->stock_quantity * 5) : 0 }}%"></div>
                                </div>
                            </div>

                            <!-- Artifact Chronicle (Description) -->
                            <div class="mb-5">
                                <h6 class="jrpg-label mb-3">Artifact Chronicle</h6>
                                <p class="text-white-50 fw-light lead mb-0" style="font-size: 0.95rem; line-height: 1.8; letter-spacing: 0.5px;">
                                    {{ $item->description ?? 'No detailed chronicle found for this artifact.' }}
                                </p>
                            </div>

                            <div class="row g-3">
                                <div class="col-sm-9">
                                    <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                        @csrf
                                        @php $isInCart = Auth::check() && $item->isInCart(Auth::id()); @endphp
                                        <button type="submit" class="btn-acquire-anime" {{ ($item->stock_quantity <= 0 || !$item->status) && !$isInCart ? 'disabled' : '' }}>
                                            <i class="bi {{ $isInCart ? 'bi-check2-circle' : 'bi-lightning-charge' }} me-2"></i> 
                                            {{ $isInCart ? 'VIEW IN CART' : 'ACQUIRE ARTIFACT' }}
                                        </button>
                                    </form>
                                </div>
                                <div class="col-sm-3">
                                    <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST">
                                        @csrf
                                        @php $isInWishlist = Auth::check() && $item->isInWishlist(Auth::id()); @endphp
                                        <button type="submit" class="btn btn-wish-anime">
                                            <i class="bi {{ $isInWishlist ? 'bi-heart-fill text-danger' : 'bi-heart' }}"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <!-- Similar Treasures -->
        <div class="row mt-5" data-aos="fade-up">
            <div class="col-12 mb-4">
                <h2 class="theme-section-title">Synchronized Treasures</h2>
            </div>
            @forelse($similarProducts as $similar)
                <div class="col-md-3">
                    <a href="{{ route('products.show', $similar->id) }}" class="text-decoration-none">
                        <div class="premium-glass-card p-3 h-100 border-white border-opacity-10 hover-scale" style="padding: 15px !important; border-radius: 15px !important;">
                            <img src="{{ Str::startsWith($similar->image, 'http') ? $similar->image : asset('storage/' . $similar->image) }}" class="rounded-3 w-100 mb-3 shadow" style="height: 180px; object-fit: cover;">
                            <h6 class="text-white mb-2 fw-bold small text-uppercase">{{ $similar->name }}</h6>
                            <span class="text-danger fw-bold small">${{ number_format($similar->effective_price, 2) }}</span>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-white-50 py-5">No synchronized chronicles found.</div>
            @endforelse
        </div>

        <!-- Reviews Section -->
        <div class="row mt-5 pt-5" data-aos="fade-up">
            <div class="col-lg-8 mx-auto">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h3 class="theme-section-title mb-0">Warrior Feedback</h3>
                    @if($hasPurchased)
                        <button class="btn btn-outline-danger btn-sm px-4 rounded-3 fw-bold" data-bs-toggle="collapse" data-bs-target="#reviewForm">
                            LEAVE FEEDBACK
                        </button>
                    @endif
                </div>

                @if($hasPurchased)
                <div class="collapse mb-5" id="reviewForm">
                    <div class="premium-glass-card p-4 rounded-4 border-danger border-opacity-20">
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item->id }}">
                            <div class="mb-4 text-center">
                                <label class="form-label text-white-50 fw-bold mb-2 text-uppercase small">Your Ranking</label>
                                <div class="rating-input text-warning fs-2 d-flex justify-content-center gap-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" class="btn-check" required>
                                        <label for="star{{ $i }}" class="cursor-pointer hover-scale opacity-50"><i class="bi bi-star-fill"></i></label>
                                    @endfor
                                </div>
                            </div>
                            <div class="mb-4">
                                <textarea name="comment" class="form-control bg-white bg-opacity-5 text-white border-white border-opacity-10 rounded-3 p-3" rows="3" placeholder="Share your experience..."></textarea>
                            </div>
                            <button type="submit" class="btn-acquire py-3">SUBMIT FEEDBACK</button>
                        </form>
                    </div>
                </div>
                @endif

                <div class="reviews-list">
                    @forelse($item->reviews->where('is_visible', true) as $review)
                        <div class="premium-glass-card p-4 mb-4 rounded-4 border-white border-opacity-5">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="text-white mb-1 fw-bold small text-uppercase">{{ $review->user->name }}</h6>
                                    <div class="text-warning x-small">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                                <span class="x-small text-white-50 opacity-50">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-white-50 mb-0 fw-light small">"{{ $review->comment }}"</p>
                        </div>
                    @empty
                        <div class="text-center py-5 opacity-25">
                            <i class="bi bi-chat-dots fs-1 mb-3 d-block"></i>
                            <p class="mb-0 small">The archive is silent. Be the first to speak.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 50
        });

        function updateMainImage(btn) {
            const mainImg = document.getElementById('mainImage');
            const newSrc = btn.querySelector('img').src;
            
            mainImg.style.opacity = '0';
            mainImg.style.transform = 'scale(0.95)';
            
            setTimeout(() => {
                mainImg.src = newSrc;
                mainImg.style.opacity = '1';
                mainImg.style.transform = 'scale(1)';
                
                // Update active state
                document.querySelectorAll('.thumb-item').forEach(item => item.classList.remove('active'));
                btn.classList.add('active');
            }, 250);
        }
    </script>
</body>

</html>
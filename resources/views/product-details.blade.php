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
            background-color: #111;
            color: #fff;
            cursor: url('https://cdn.custom-cursor.com/db/cursor/32/katana_cursor.png'), auto !important;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Showroom Container */
        .product-showroom {
            min-height: 100vh;
            padding: 60px 0;
            position: relative;
            z-index: 1;
        }

        .premium-glass-card {
            background: rgba(20, 20, 20, 0.6);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 24px;
            padding: 60px;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.3);
        }

        .breadcrumb-showroom {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.4);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 25px;
            padding-left: 20px;
        }

        .breadcrumb-showroom a {
            color: #fff;
            text-decoration: none;
            opacity: 0.6;
            transition: opacity 0.3s;
        }

        .breadcrumb-showroom a:hover {
            opacity: 1;
            color: crimson;
        }

        /* Image Display Logic (4:5 Hybrid) */
        .image-showcase {
            position: relative;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        .main-image-viewport {
            position: relative;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 20px;
            aspect-ratio: 4 / 5;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.05);
            transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .main-image-viewport:hover {
            transform: scale(1.02);
        }

        .main-image-viewport img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            filter: drop-shadow(0 15px 30px rgba(0,0,0,0.5));
        }

        /* Refined Thumbnails */
        .thumb-nav {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }

        .thumb-item {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .thumb-item.active {
            border-color: crimson;
            background: rgba(220, 20, 60, 0.1);
            transform: translateY(-5px);
        }

        /* Typography & Components */
        .badge-category {
            background: rgba(220, 20, 60, 0.1);
            color: #ff4d4d;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 1px solid rgba(220, 20, 60, 0.2);
            display: inline-block;
        }

        .product-name {
            font-weight: 800;
            font-size: 3.2rem;
            margin: 10px 0;
            line-height: 1.1;
            color: #fff;
            letter-spacing: -1px;
        }

        .price-badge-showroom {
            font-size: 2.2rem;
            font-weight: 800;
            color: #ff3333;
            display: flex;
            align-items: baseline;
            gap: 12px;
        }

        .price-old {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.2);
            text-decoration: line-through;
            font-weight: 400;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .stat-box {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 12px;
            text-align: center;
        }

        .stat-label {
            font-size: 0.6rem;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.3);
            letter-spacing: 1px;
            margin-bottom: 3px;
            display: block;
        }

        .stat-value {
            font-weight: 600;
            font-size: 0.85rem;
        }

        .btn-acquire {
            background: #cc0000;
            color: #fff;
            border: none;
            padding: 18px;
            border-radius: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-acquire:hover:not(:disabled) {
            background: #e60000;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(204, 0, 0, 0.3);
        }

        .btn-wish-icon {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            color: #fff;
            width: 100%;
            height: 100%;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            transition: all 0.3s ease;
        }

        .btn-wish-icon:hover {
            background: rgba(255, 255, 255, 0.06);
        }
    </style>
</head>

<body>
    @include('additions.navbar')

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
                                
                                @if($item->discount_active)
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
                        <div class="ps-lg-4">
                            <!-- Top Info Bar -->
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    @if($item->category)
                                        <span class="badge-category me-2">{{ $item->category->name }}</span>
                                    @endif
                                    @if($item->subcategory)
                                        <span class="badge-category">{{ $item->subcategory->name }}</span>
                                    @endif
                                </div>
                                <div class="price-badge-showroom">
                                    ${{ number_format($item->price, 2) }}
                                    @if($item->discount_active && $item->old_price)
                                        <span class="price-old">${{ number_format($item->old_price, 2) }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Main Headings -->
                            <h1 class="product-name">{{ $item->name }}</h1>
                            <div class="mb-4">
                                <span class="text-white-50 small font-monospace">REF: {{ $item->sku ?? 'HK-'.$item->id }}</span>
                            </div>

                            <!-- Dynamic Ratings -->
                            <div class="mb-4">
                                @php 
                                    $avgRating = $item->reviews->avg('rating') ?: 5.0; 
                                    $reviewCount = $item->reviews->count();
                                @endphp
                                <div class="d-flex align-items-center gap-2">
                                    <div class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= round($avgRating) ? '-fill' : '' }}"></i>
                                        @endfor
                                    </div>
                                    <span class="small text-white-50">({{ $avgRating }} / {{ $reviewCount }} WARRIORS)</span>
                                </div>
                            </div>

                            <!-- Stock Status -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="badge {{ $item->status && $item->stock_quantity > 0 ? 'bg-success' : 'bg-danger' }} rounded-pill px-3 py-1 bg-opacity-10 text-{{ $item->status && $item->stock_quantity > 0 ? 'success' : 'danger' }} border border-{{ $item->status && $item->stock_quantity > 0 ? 'success' : 'danger' }} border-opacity-25" style="font-size: 0.75rem;">
                                        {{ $item->status && $item->stock_quantity > 0 ? 'READY TO ACQUIRE' : 'ARCHIVED' }}
                                    </div>
                                    @if($item->stock_quantity > 0 && $item->stock_quantity < 10)
                                        <span class="text-danger small fw-bold anim-pulse">ONLY {{ $item->stock_quantity }} LEFT IN STOCK!</span>
                                    @elseif($item->stock_quantity > 0)
                                        <span class="text-white-50 small">{{ $item->stock_quantity }} units available</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-5">
                                <p class="text-white-50 fw-light lead mb-0" style="font-size: 1rem; line-height: 1.8;">
                                    {{ $item->description ?? 'No detailed chronicle found for this artifact.' }}
                                </p>
                            </div>

                            <div class="row g-3">
                                <div class="col-sm-9">
                                    <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                        @csrf
                                        @php $isInCart = Auth::check() && $item->isInCart(Auth::id()); @endphp
                                        <button type="submit" class="btn-acquire" {{ ($item->stock_quantity <= 0 || !$item->status) && !$isInCart ? 'disabled' : '' }}>
                                            <i class="bi {{ $isInCart ? 'bi-check2-circle' : 'bi-shield-check' }} me-2"></i> 
                                            {{ $isInCart ? 'VIEW IN CART' : 'ACQUIRE ARTIFACT' }}
                                        </button>
                                    </form>
                                </div>
                                <div class="col-sm-3">
                                    <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST">
                                        @csrf
                                        @php $isInWishlist = Auth::check() && $item->isInWishlist(Auth::id()); @endphp
                                        <button type="submit" class="btn btn-wish-icon">
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
                <div class="d-flex align-items-center gap-3">
                    <h2 class="h4 fw-bold text-white mb-0 text-uppercase letter-spacing-1">Synchronized Treasures</h2>
                    <div class="flex-grow-1 h-px bg-white opacity-10"></div>
                </div>
            </div>
            @forelse($similarProducts as $similar)
                <div class="col-md-3">
                    <a href="{{ route('products.show', $similar->id) }}" class="text-decoration-none">
                        <div class="premium-glass-card p-3 h-100 border-white border-opacity-10 hover-scale" style="padding: 15px !important; border-radius: 15px !important;">
                            <img src="{{ Str::startsWith($similar->image, 'http') ? $similar->image : asset('storage/' . $similar->image) }}" class="rounded-3 w-100 mb-3 shadow" style="height: 180px; object-fit: cover;">
                            <h6 class="text-white mb-2 fw-bold small text-uppercase">{{ $similar->name }}</h6>
                            <span class="text-danger fw-bold small">${{ number_format($similar->price, 2) }}</span>
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
                    <h3 class="h4 fw-bold text-white mb-0 text-uppercase letter-spacing-1">Warrior Feedback</h3>
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
                        <div class="premium-glass-card p-4 mb-4 rounded-3 border-white border-opacity-5">
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
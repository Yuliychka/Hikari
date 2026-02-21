@php
    $isInWishlist = in_array($product->id, $wishlistProductIds ?? []);
    $isInCart = in_array($product->id, $cartProductIds ?? []);
    $activeFlashSale = $product->active_flash_sale;
    $isSale = $activeFlashSale ? true : false;
    $finalPrice = $product->effective_price;
    
    // Auto-badge for sales
    if ($isSale && !isset($badge)) {
        $badge = 'PROMO';
        $badgeClass = 'bg-danger text-white pulse-btn';
    }
@endphp

<div class="card {{ $cardClass ?? 'manga-card' }} h-100" data-aos="fade-up" data-aos-delay="{{ $delay ?? 0 }}">
    <!-- Wishlist Button -->
    <div class="card-action-btn left ajax-wishlist {{ $isInWishlist ? 'active' : '' }}" 
         data-id="{{ $product->id }}" 
         data-tooltip="{{ $isInWishlist ? 'Remove from Heart' : 'Add to Heart' }}">
        <i class="bi {{ $isInWishlist ? 'bi-heart-fill' : 'bi-heart' }}"></i>
    </div>

    <!-- Cart Button -->
    <div class="card-action-btn right ajax-cart {{ $isInCart ? 'active' : '' }}" 
         data-id="{{ $product->id }}" 
         data-tooltip="{{ $isInCart ? 'Remove from Cart' : 'Add to Cart' }}">
        <i class="bi {{ $isInCart ? 'bi-cart-check-fill' : 'bi-cart-plus' }}"></i>
    </div>

    <!-- Top Left Badge System (Horizontal Pills) -->
    @php
        $badgeList = [];
        // 1. Detect "NEW" status
        if (($cardClass ?? '') === 'new-arrival-card' || (isset($badge) && strtoupper($badge) === 'NEW')) {
            $badgeList[] = 'NEW';
        }
        // 2. Detect "PROMO" status
        if ($isSale) {
            $badgeList[] = 'PROMO';
        }
        // 3. Detect other manual status (HOT, etc.)
        if (isset($badge) && !in_array(strtoupper($badge), ['NEW', 'PROMO'])) {
            $badgeList[] = strtoupper($badge);
        }
    @endphp

    @if(count($badgeList) > 0)
        <div class="badge-row position-absolute d-flex flex-row gap-2" style="top: 15px; left: 15px; z-index: 1000; pointer-events: none;">
            @foreach($badgeList as $label)
                <span class="badge bg-danger text-white shadow-lg px-2 py-1" 
                      style="font-family: 'Poppins', sans-serif; font-size: 0.7rem; font-weight: 800; border-radius: 4px; border: 1px solid rgba(255,255,255,0.2); box-shadow: 0 0 10px crimson; letter-spacing: 1px; min-width: 60px; text-align: center; display: inline-block !important;">
                    {{ $label }}
                </span>
            @endforeach
        </div>
    @endif


    <div class="overflow-hidden rounded-top position-relative" style="background: #111;">
        <a href="{{ route('products.show', $product->id) }}">
            <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" 
                 class="card-img-top" 
                 alt="{{ $product->name }}"
                 style="display: block;">
        </a>
    </div>

    <div class="card-body d-flex flex-column justify-content-between">
        <div>
            @if($product->category)
                <div class="mb-1 d-flex align-items-center" style="overflow: hidden; max-height: 1.2em;">
                    <small class="text-danger fw-bold text-uppercase text-truncate" style="font-size: 0.65rem; letter-spacing: 1px; flex-shrink: 0; max-width: 50%;">
                        {{ $product->category->name }}
                    </small>
                    @if($product->subcategory)
                        <span class="text-secondary opacity-50 mx-1" style="flex-shrink: 0;">/</span>
                        <small class="fw-bold text-uppercase text-truncate" style="font-size: 0.65rem; letter-spacing: 1px; color: #888; overflow: hidden; white-space: nowrap; min-width: 0;">
                            {{ $product->subcategory->name }}
                        </small>
                    @endif
                </div>
            @endif
            <h5 class="card-title text-truncate fw-bold text-uppercase mb-1" style="font-size: 1rem;">{{ $product->name }}</h5>
            <p class="card-text small text-truncate fw-bold text-secondary mb-3">{{ $product->description }}</p>
        </div>
        <div class="mt-auto d-flex flex-column gap-1">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    @if($isSale)
                        <span class="text-secondary text-decoration-line-through mb-n1" style="font-size: 0.75rem;">${{ number_format($product->price, 2) }}</span>
                    @endif
                    <span class="price fs-5 fw-bold" style="background: #000; color: #fff; padding: 2px 8px; border: 1px solid crimson; box-shadow: 2px 2px 0 crimson; transition: all 0.3s ease;">
                        ${{ number_format($finalPrice, 2) }}
                    </span>
                </div>
            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm {{ $btnClass ?? 'btn-outline-dark border-2 hover-crimson' }} fw-bold rounded-0">VIEW</a>
        </div>
    </div>
</div>
</div>

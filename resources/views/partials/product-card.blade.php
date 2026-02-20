@php
    $isInWishlist = in_array($product->id, $wishlistProductIds ?? []);
    $isInCart = in_array($product->id, $cartProductIds ?? []);
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

    @if($badge ?? false)
        <span class="badge position-absolute top-0 start-50 translate-middle-x mt-2 {{ $badgeClass ?? 'bg-dark border border-dark' }} rounded-0" style="z-index:10; font-family:'Courier New', monospace; font-weight:bold;">{{ $badge }}</span>
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
        <div class="mt-auto d-flex justify-content-between align-items-center">
            <span class="price fs-5 fw-bold" style="background: #000; color: #fff; padding: 2px 8px; border: 1px solid crimson; box-shadow: 2px 2px 0 crimson;">${{ number_format($product->price, 2) }}</span>
            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm {{ $btnClass ?? 'btn-outline-dark border-2 hover-crimson' }} fw-bold rounded-0">VIEW</a>
        </div>
    </div>
</div>

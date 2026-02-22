@extends('layouts.frontend')

@section('content')
<!-- System Background Overlay -->
<div class="system-bg-overlay"></div>

<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10" data-aos="fade-up">
            <!-- Quest Log Header -->
            <div class="quest-log-header mb-5">
                <div>
                    <h1 class="quest-title text-uppercase">QUEST_LOG</h1>
                    <div class="quest-subtitle text-uppercase">PLAYER_MISSION_RECORDS_V2.0</div>
                </div>
            </div>

            @if($orders->isEmpty())
                <div class="sl-system-menu p-5 text-center">
                    <div class="text-white-50 mb-3">NO_MISSIONS_DETECTED</div>
                    <h3 class="fw-900 text-uppercase">Empty Quest Log</h3>
                    <a href="{{ route('products.index') }}" class="sl-system-btn mt-4 d-inline-block px-5">INITIALIZE_HUNT</a>
                </div>
            @else
                <div class="quest-list d-flex flex-column gap-4">
                    @foreach($orders as $order)
                        @php
                            $statusMap = [
                                'completed' => ['label' => 'S_RANK_CLEAR', 'color' => '#00ff88'],
                                'pending' => ['label' => 'MISSION_ONGOING', 'color' => '#ffaa00'],
                                'shipped' => ['label' => 'IN_TRANSIT', 'color' => '#00ccff'],
                                'cancelled' => ['label' => 'QUEST_FAILED', 'color' => '#ff0044'],
                            ];
                            $status = $statusMap[$order->status] ?? ['label' => strtoupper($order->status), 'color' => '#fff'];
                        @endphp
                        
                        <!-- Mission Card -->
                        <div class="mission-card sl-system-menu overflow-hidden">
                            <div class="row g-0">
                                <!-- Product Image Carousel (Thematic) -->
                                <div class="col-md-3">
                                    <div class="artifact-carousel">
                                        @foreach($order->items as $index => $item)
                                            <div class="carousel-img-wrapper {{ $index == 0 ? 'active' : '' }}" data-order-id="{{ $order->id }}">
                                                <img src="{{ Str::startsWith($item->product->image, 'http') ? $item->product->image : asset('storage/' . $item->product->image) }}" alt="Product Image" class="mission-artifact">
                                                <div class="artifact-overlay">
                                                    <span class="qty-tag">x{{ $item->quantity }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="scanline"></div>
                                        <div class="carousel-indicators">
                                            @foreach($order->items as $index => $item)
                                                <div class="indicator-dot {{ $index == 0 ? 'active' : '' }}"></div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Mission Data -->
                                <div class="col-md-9 p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="mission-identity">
                                            <div class="mission-id">MISSION_ID: #HKR-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
                                            <h4 class="mission-name text-uppercase">Acquired Artifacts: {{ $order->items->count() }}</h4>
                                        </div>
                                        <div class="mission-status" style="--status-color: {{ $status['color'] }}">
                                            <div class="status-label">{{ $status['label'] }}</div>
                                            <div class="status-glow"></div>
                                        </div>
                                    </div>

                                    <div class="mission-details row g-3">
                                        <div class="col-md-4">
                                            <div class="detail-box">
                                                <div class="label">TIMESTAMP</div>
                                                <div class="value">{{ $order->created_at->format('M d, Y') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="detail-box">
                                                <div class="label">REWARD_COST</div>
                                                <div class="value text-crimson">${{ number_format($order->total_price, 2) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="detail-box">
                                                <div class="label">PAYMENT_MODULE</div>
                                                <div class="value">{{ strtoupper($order->payment_method) }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mission-actions mt-4 d-flex justify-content-between align-items-center">
                                        <div class="mission-brief small text-white-50">LOCATION: {{ $order->shipping_address }}</div>
                                        <a href="{{ route('orders.show', $order->id) }}" class="sl-system-btn py-2 px-4 shadow-none" style="font-size: 0.7rem;">
                                            VIEW_MISSION_REPORTS
                                            <div class="btn-scanner"></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Brackets -->
                            <div class="bracket tl"></div>
                            <div class="bracket tr"></div>
                            <div class="bracket bl"></div>
                            <div class="bracket br"></div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    :root {
        --system-crimson: crimson;
        --glass-bg: rgba(0, 0, 0, 0.4);
    }

    /* Seamless Integration - No Body BG overrides */

    .quest-log-header .quest-title {
        font-weight: 900; font-size: 3.5rem; letter-spacing: -2px; color: #fff; line-height: 1;
        text-shadow: 0 0 15px var(--system-crimson); margin: 0;
    }
    .quest-log-header .quest-subtitle {
        color: var(--system-crimson); font-weight: 800; font-size: 0.8rem; letter-spacing: 5px;
        opacity: 0.6; margin-top: 5px;
    }

    /* Mission Card - Minimal Website Suitability */
    .mission-card {
        background: rgba(255, 255, 255, 0.03); 
        border: 1px solid rgba(220, 20, 60, 0.15);
        backdrop-filter: blur(5px); transition: all 0.3s ease;
        position: relative; overflow: hidden;
    }
    .mission-card:hover { 
        background: rgba(220, 20, 60, 0.05); 
        border-color: var(--system-crimson);
        transform: translateY(-3px);
    }
    @keyframes logo-glitch {
        0% { transform: translate(0); opacity: 1; filter: drop-shadow(0 0 8px var(--system-crimson)); }
        92% { transform: translate(0); opacity: 1; }
        93% { transform: translate(1px, -1px); opacity: 0.8; filter: drop-shadow(-1px 0 var(--system-crimson)); }
        94% { transform: translate(-1px, 1px); opacity: 1; }
        95% { transform: translate(0); }
    }

    /* Mission Card - Glassmorphism */
    .mission-card {
        background: var(--glass-bg); 
        border: 1px solid rgba(220, 20, 60, 0.2);
        position: relative; backdrop-filter: blur(10px); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .mission-card:hover { 
        border-color: var(--system-crimson); 
        transform: translateY(-5px); 
        background: rgba(220, 20, 60, 0.05);
        box-shadow: 0 15px 40px rgba(220, 20, 60, 0.1);
    }

    /* Brackets */
    .bracket { position: absolute; width: 12px; height: 12px; border: 2px solid var(--system-crimson); z-index: 5; opacity: 0.5; }
    .bracket.tl { top: -2px; left: -2px; border-right: none; border-bottom: none; }
    .bracket.tr { top: -2px; right: -2px; border-left: none; border-bottom: none; }
    .bracket.bl { bottom: -2px; left: -2px; border-right: none; border-top: none; }
    .bracket.br { bottom: -2px; right: -2px; border-left: none; border-top: none; }

    /* Carousel */
    .artifact-carousel {
        position: relative; height: 100%; min-height: 200px; background: rgba(0,0,0,0.3);
        border-right: 1px solid rgba(220, 20, 60, 0.1); overflow: hidden;
    }
    .carousel-img-wrapper {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        opacity: 0; transition: opacity 0.8s ease-in-out;
    }
    .carousel-img-wrapper.active { opacity: 1; z-index: 2; }
    .mission-artifact { width: 100%; height: 100%; object-fit: cover; }
    
    .artifact-overlay {
        position: absolute; bottom: 10px; right: 10px; z-index: 5;
    }
    .qty-tag {
        background: var(--system-crimson); color: #fff; font-weight: 900;
        font-size: 0.7rem; padding: 2px 8px; border: 1px solid rgba(255,255,255,0.2);
    }

    .scanline {
        position: absolute; top: 0; left: 0; width: 100%; height: 1px;
        background: rgba(220, 20, 60, 0.1); z-index: 4;
        animation: scanline 4s linear infinite;
    }
    @keyframes scanline { 0% { top: 0; } 100% { top: 100%; } }

    .carousel-indicators {
        position: absolute; bottom: 12px; left: 50%; transform: translateX(-50%);
        display: flex; gap: 8px; z-index: 5; padding: 0; margin: 0;
    }
    .indicator-dot {
        width: 12px; height: 2px; background: rgba(255,255,255,0.1);
    }
    .indicator-dot.active { background: var(--system-crimson); box-shadow: 0 0 10px var(--system-crimson); }

    /* Mission Content */
    .mission-id { color: var(--system-crimson); font-weight: 800; font-size: 0.75rem; letter-spacing: 2px; text-transform: uppercase; }
    .mission-name { font-weight: 900; font-size: 1.25rem; color: #fff; margin: 0; letter-spacing: 1px; }

    .mission-status {
        position: relative; padding: 6px 15px; border: 1px solid var(--status-color);
        background: rgba(0,0,0,0.4);
    }
    .status-label {
        color: var(--status-color); font-weight: 900; font-size: 0.7rem; letter-spacing: 2px;
        position: relative; z-index: 2;
    }
    .status-glow {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        box-shadow: inset 0 0 12px var(--status-color); opacity: 0.25;
    }

    .detail-box { border-left: 2px solid rgba(220,20,60,0.1); padding-left: 15px; }
    .detail-box .label { font-size: 0.65rem; color: rgba(255,255,255,0.5); font-weight: 800; letter-spacing: 1px; }
    .detail-box .value { font-weight: 700; font-size: 1rem; color: #fff; }
    .text-crimson { color: var(--system-crimson); }

    /* Buttons */
    .sl-system-btn {
        display: inline-block; background: rgba(220, 20, 60, 0.1);
        border: 1px solid var(--system-crimson); color: #fff !important;
        text-align: center; text-decoration: none !important; font-weight: 900;
        letter-spacing: 2px; position: relative; overflow: hidden; transition: all 0.3s;
        text-transform: uppercase; font-size: 0.8rem;
    }
    .sl-system-btn:hover { background: var(--system-crimson); box-shadow: 0 0 20px rgba(220, 20, 60, 0.4); }
    
    .btn-scanner {
        position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: 1s;
    }
    .sl-system-btn:hover .btn-scanner { left: 100%; }

    @media (max-width: 768px) {
        .artifact-carousel { min-height: 250px; border-right: none; border-bottom: 1px solid rgba(220,20,60,0.1); }
        .mission-card:hover { transform: none; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Multi-artifact Carousel Logic
    const orders = {};
    document.querySelectorAll('.carousel-img-wrapper').forEach(wrapper => {
        const orderId = wrapper.dataset.orderId;
        if (!orders[orderId]) orders[orderId] = { wrappers: [], indicators: [], current: 0 };
        orders[orderId].wrappers.push(wrapper);
    });

    document.querySelectorAll('.mission-card').forEach((card, index) => {
        const indicators = card.querySelectorAll('.indicator-dot');
        const orderId = card.querySelector('.carousel-img-wrapper')?.dataset.orderId;
        if (orderId && orders[orderId]) {
            orders[orderId].indicators = Array.from(indicators);
        }
    });

    // Cycle through images every 3 seconds
    setInterval(() => {
        Object.keys(orders).forEach(orderId => {
            const order = orders[orderId];
            if (order.wrappers.length <= 1) return;

            order.wrappers[order.current].classList.remove('active');
            order.indicators[order.current].classList.remove('active');
            
            order.current = (order.current + 1) % order.wrappers.length;
            
            order.wrappers[order.current].classList.add('active');
            order.indicators[order.current].classList.add('active');
        });
    }, 3000);
});
</script>
@endsection

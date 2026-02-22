@extends('layouts.frontend')

@section('content')
<!-- System Background Overlay -->
<div class="system-bg-overlay"></div>

<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-11" data-aos="zoom-in">
            <!-- Mission Report Header -->
            <div class="mission-report-header mb-4 d-flex justify-content-between align-items-end">
                <div>
                    <h1 class="report-title text-uppercase">MISSION_REPORT</h1>
                    <div class="report-subtitle text-uppercase">SECURE_LEVEL_ALPHA_CLEARANCE</div>
                </div>
                <div class="status-badge-glitch {{ $order->status }}" data-text="{{ strtoupper($order->status) }}">
                    {{ strtoupper($order->status) }}
                </div>
            </div>

            <div class="row g-4">
                <!-- Left: Content Panels -->
                <div class="col-md-8">
                    <!-- Artifact List Panel -->
                    <div class="sl-system-menu p-4 mb-4 position-relative">
                        <h4 class="panel-header mb-4">[RECOVERED_ARTIFACTS]</h4>
                        
                        <div class="artifact-list">
                            @foreach($order->items as $item)
                            <div class="artifact-item d-flex align-items-center p-3 mb-3 border border-crimson-10 bg-crimson-05">
                                <div class="artifact-frame me-3">
                                    <img src="{{ Str::startsWith($item->product->image, 'http') ? $item->product->image : asset('storage/' . $item->product->image) }}" alt="" class="artifact-img">
                                    <div class="frame-bracket tl"></div>
                                    <div class="frame-bracket br"></div>
                                </div>
                                <div class="artifact-info flex-grow-1">
                                    <div class="artifact-name fw-bold">{{ $item->product->name }}</div>
                                    <div class="artifact-meta small text-white-50">UNIT_COST: ${{ number_format($item->price, 2) }}</div>
                                </div>
                                <div class="artifact-quantity text-end">
                                    <div class="label small text-white-50">QUANTITY</div>
                                    <div class="value h5 mb-0 fw-900">x{{ $item->quantity }}</div>
                                </div>
                                <div class="artifact-total text-end ms-4">
                                    <div class="label small text-white-50">SUM</div>
                                    <div class="value h5 mb-0 fw-900 text-crimson">${{ number_format($item->price * $item->quantity, 2) }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Brackets -->
                        <div class="bracket tl"></div>
                        <div class="bracket tr"></div>
                        <div class="bracket bl"></div>
                        <div class="bracket br"></div>
                    </div>

                    <!-- Logistics Panel -->
                    <div class="sl-system-menu p-4 position-relative">
                        <h4 class="panel-header mb-4">[MISSION_LOGISTICS]</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="logistics-box">
                                    <div class="label">DESTINATION_SECTOR</div>
                                    <div class="value">{{ $order->shipping_address }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="logistics-box">
                                    <div class="label">PAYMENT_RITUAL</div>
                                    <div class="value text-uppercase">{{ $order->payment_method == 'cod' ? 'Cash on Delivery' : 'Credit Card' }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Brackets -->
                        <div class="bracket tl"></div>
                        <div class="bracket tr"></div>
                        <div class="bracket bl"></div>
                        <div class="bracket br"></div>
                    </div>
                </div>

                <!-- Right: Summary & Actions -->
                <div class="col-md-4">
                    <div class="sl-system-menu p-4 position-relative h-100">
                        <h4 class="panel-header mb-4">[REWARD_CALCULATION]</h4>
                        
                        <div class="reward-summary mb-5">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-white-50">BASE_COST</span>
                                <span>${{ number_format($order->total_price + ($order->discount_amount ?? 0), 2) }}</span>
                            </div>
                            @if($order->discount_amount > 0)
                            <div class="d-flex justify-content-between mb-2 text-success">
                                <span>COUPON_REDUCTION</span>
                                <span>-${{ number_format($order->discount_amount, 2) }}</span>
                            </div>
                            @endif
                            <div class="d-flex justify-content-between mb-4">
                                <span class="text-white-50">LOGISTICS_FEE</span>
                                <span>FREE</span>
                            </div>
                            <hr class="border-crimson-20">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="fw-900 mb-0" style="font-size: 1.1rem; letter-spacing: 1px;">TOTAL_REWARD</h4>
                                <h4 class="fw-900 text-crimson mb-0" style="font-size: 1.4rem;">${{ number_format($order->total_price, 2) }}</h4>
                            </div>
                        </div>

                        <div class="mission-actions-vertical d-flex flex-center">
                            <a href="{{ route('orders.index') }}" class="sl-system-btn py-2 px-4" style="width: auto; min-width: 200px; font-size: 0.75rem;">
                                RETURN_TO_QUEST_LOG
                                <div class="btn-scanner"></div>
                            </a>
                        </div>

                        <!-- Brackets -->
                        <div class="bracket tl"></div>
                        <div class="bracket tr"></div>
                        <div class="bracket bl"></div>
                        <div class="bracket br"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --system-crimson: crimson;
        --glass-bg: rgba(0, 0, 0, 0.4);
    }

    /* Seamless Integration */

    .report-title {
        font-weight: 900; font-size: 3.5rem; letter-spacing: -2px; color: #fff; line-height: 1;
        text-shadow: 0 0 15px var(--system-crimson); margin: 0;
    }
    .report-subtitle {
        color: var(--system-crimson); font-weight: 800; font-size: 0.8rem; letter-spacing: 5px;
        opacity: 0.6; margin-top: 5px;
    }

    .status-badge-glitch {
        padding: 6px 20px; border: 1px solid var(--system-crimson);
        color: var(--system-crimson); font-weight: 900; font-size: 0.8rem;
        position: relative; background: rgba(0,0,0,0.5); letter-spacing: 2px;
    }
    .status-badge-glitch.completed { border-color: #00ff88; color: #00ff88; box-shadow: 0 0 15px rgba(0,255,136,0.3); }

    .sl-system-menu {
        background: var(--glass-bg); 
        border: 1px solid rgba(220, 20, 60, 0.2);
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    .panel-header {
        font-size: 0.8rem; color: var(--system-crimson); font-weight: 900; letter-spacing: 3px;
        text-transform: uppercase; border-bottom: 1px solid rgba(220,20,60,0.1); padding-bottom: 10px;
    }

    /* Artifact Item */
    .artifact-frame {
        position: relative; width: 70px; height: 70px; border: 1px solid rgba(220, 20, 60, 0.2);
        background: rgba(0,0,0,0.3); padding: 5px;
    }
    .artifact-img { width: 100%; height: 100%; object-fit: cover; }
    .frame-bracket { position: absolute; width: 8px; height: 8px; border: 2px solid var(--system-crimson); opacity: 0.6; }
    .frame-bracket.tl { top: -2px; left: -2px; border-right: none; border-bottom: none; }
    .frame-bracket.br { bottom: -2px; right: -2px; border-left: none; border-top: none; }

    .logistics-box { border-left: 2px solid var(--system-crimson); padding-left: 15px; }
    .logistics-box .label { font-size: 0.65rem; color: rgba(255,255,255,0.5); font-weight: 800; letter-spacing: 1px; }
    .logistics-box .value { font-weight: 700; font-size: 1.1rem; color: #fff; }

    /* Brackets */
    .bracket { position: absolute; width: 14px; height: 14px; border: 2px solid var(--system-crimson); opacity: 0.5; }
    .bracket.tl { top: -2px; left: -2px; border-right: none; border-bottom: none; }
    .bracket.tr { top: -2px; right: -2px; border-left: none; border-bottom: none; }
    .bracket.bl { bottom: -2px; left: -2px; border-right: none; border-top: none; }
    .bracket.br { bottom: -2px; right: -2px; border-left: none; border-top: none; }

    .sl-system-btn {
        display: block; background: rgba(220, 20, 60, 0.1);
        border: 1px solid var(--system-crimson); color: #fff !important;
        text-align: center; text-decoration: none !important; font-weight: 900;
        letter-spacing: 3px; position: relative; overflow: hidden; transition: 0.4s;
        text-transform: uppercase; padding: 15px;
    }
    .sl-system-btn:hover { background: var(--system-crimson); box-shadow: 0 0 30px rgba(220, 20, 60, 0.4); }

    .btn-scanner {
        position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 1s;
    }
    .sl-system-btn:hover .btn-scanner { left: 100%; }
</style>
@endsection

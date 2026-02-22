@extends('layouts.frontend')

@section('content')
@php
    $orderCount = $user->orders()->count();
    
    // 1. Rank Logic (Harder)
    if ($orderCount >= 150) $rank = 'S-RANK';
    elseif ($orderCount >= 76) $rank = 'A-RANK';
    elseif ($orderCount >= 36) $rank = 'B-RANK';
    elseif ($orderCount >= 16) $rank = 'C-RANK';
    elseif ($orderCount >= 6) $rank = 'D-RANK';
    else $rank = 'E-RANK';

    // 2. Status Logic (Role-based SL Titles)
    $statusTitle = match($user->role) {
        'super admin' => 'NATIONAL LEVEL HUNTER (SUPER ADMIN)',
        'admin' => 'SHADOW MONARCH (ADMIN)',
        'manager' => 'GUILD MASTER (MANAGER)',
        'seller' => 'MONSTER MERCHANT (SELLER)',
        'delivery' => 'SHADOW EXTRACTOR (DELIVERY)',
        default => 'HUNTER (USER)'
    };

    // 3. HP Logic (Profile Completion %)
    $profileFields = ['phone', 'city', 'address', 'zip_code', 'country'];
    $filledFields = 0;
    foreach($profileFields as $field) { if($user->$field) $filledFields++; }
    $hpPercentage = ($filledFields / count($profileFields)) * 100;

    // 4. MP Logic (3% per order + 20% base)
    $mpPercentage = min(100, 20 + ($orderCount * 3));

    // 5. Credibility Logic (Monthly Refresh)
    $ordersThisMonth = $user->orders()->whereMonth('created_at', now()->month)->count();
    $credibility = $ordersThisMonth >= 5 ? 'MAX' : ($ordersThisMonth >= 1 ? 'REPUTABLE' : 'NEWBIE');

    // 6. Security Protocol (Warnings)
    $shieldStatus = 'SHIELD_ACTIVE';
    if ($user->warnings >= 3) $shieldStatus = 'SYSTEM_CRITICAL';
    elseif ($user->warnings >= 1) $shieldStatus = 'SHIELD_CRACKED';

    // 7. Wishlist Count (Actual)
    $wishlistCount = \App\Models\Wishlist::where('user_id', $user->id)->count();

    // 8. Items Acquired (Actual)
    $itemsAcquired = \App\Models\OrderItem::whereHas('order', function($q) use($user) {
        $q->where('user_id', $user->id);
    })->sum('quantity');
@endphp

<!-- System Background Overlay -->
<div class="system-bg-overlay"></div>

<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10" data-aos="zoom-in">
            <!-- Holographic System Menu -->
            <div class="sl-system-menu">
                <!-- System Header -->
                <div class="system-header d-flex align-items-center gap-4 p-4">
                    <div class="header-avatar-container">
                        <div class="avatar-shrine mini">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="avatar-img mini">
                            @else
                                <div class="avatar-placeholder mini"><i class="fas fa-user-ninja"></i></div>
                            @endif
                            <div class="bracket tl"></div>
                            <div class="bracket tr"></div>
                            <div class="bracket bl"></div>
                            <div class="bracket br"></div>
                        </div>
                    </div>
                    <div class="player-info flex-grow-1">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <div class="level-tag">RANK: {{ $rank }}</div>
                            <div class="vertical-divider"></div>
                            <div class="job-tag">STATUS: {{ $statusTitle }}</div>
                        </div>
                        <h1 class="player-name text-uppercase">{{ $user->name }}</h1>
                    </div>
                    <div class="system-title align-self-start mt-2">MERCHANT_INTERFACE_V2.0</div>
                </div>

                <div class="row g-0 main-interface">
                    <!-- Left Column: Status & Attributes -->
                    <div class="col-md-7 p-4 border-end border-crimson-10">
                        <!-- Resource Bars -->
                        <div class="resource-bars mb-4">
                            <div class="resource-item p-2 mb-2">
                                <div class="d-flex justify-content-between small fw-bold text-uppercase">
                                    <span>SECURE_STATE (HP)</span>
                                    <span>{{ round($hpPercentage) }}%</span>
                                </div>
                                <div class="progress-bar-sl hp"><div class="fill" style="width: {{ $hpPercentage }}%;"></div></div>
                                <div class="small text-white-50 mt-1" style="font-size: 0.6rem;">COMPLETE PROFILE TO REGENERATE HP</div>
                            </div>
                            <div class="resource-item p-2">
                                <div class="d-flex justify-content-between small fw-bold text-uppercase">
                                    <span>REWARD_POWER (MP)</span>
                                    <span>{{ $mpPercentage }}%</span>
                                </div>
                                <div class="progress-bar-sl mp"><div class="fill" style="width: {{ $mpPercentage }}%;"></div></div>
                                <div class="small text-white-50 mt-1" style="font-size: 0.6rem;">PERFORM MORE SUMMONS TO INCREASE POWER</div>
                            </div>
                        </div>

                        <!-- Attributes Grid -->
                        <div class="attributes-grid row g-3">
                            <div class="col-6">
                                <div class="attr-box">
                                    <span class="attr-label">TOTAL ORDERS</span>
                                    <span class="attr-value">{{ $orderCount }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="attr-box border-gold">
                                    <span class="attr-label">LOYALTY LV (MO)</span>
                                    <span class="attr-value">{{ max(1, $user->created_at->diffInMonths(now())) }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="attr-box border-red">
                                    <span class="attr-label">WISHLIST</span>
                                    <span class="attr-value">{{ $wishlistCount }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="attr-box border-dark">
                                    <span class="attr-label">CREDIBILITY</span>
                                    <span class="attr-value" style="font-size: 1.2rem;">{{ $credibility }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Identity Info -->
                        <div class="identity-panel mt-4 p-3 bg-crimson-05 border-crimson-20 text-uppercase">
                            <h6 class="text-crimson small fw-bold mb-3">[PLAYER_IDENTIFICATION]</h6>
                            <div class="identity-item mb-2">
                                <span class="label">EMAIL_LINK:</span>
                                <span class="value">{{ $user->email }}</span>
                            </div>
                            <div class="identity-item mb-2">
                                <span class="label">SECTOR:</span>
                                <span class="value">{{ $user->city ?? 'UNKNOWN_DOMAIN' }}</span>
                            </div>
                            <div class="identity-item">
                                <span class="label">FORTRESS:</span>
                                <span class="value">{{ $user->address ?? 'UNDEFINED' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Status Windows -->
                    <div class="col-md-5 p-4 d-flex flex-column gap-3">
                        <!-- Preserved Security Protocol -->
                        <div class="status-window security">
                            <div class="window-title">SECURITY_PROTOCOL</div>
                            <div class="window-content p-3">
                                <div class="indicator-row">
                                    <div class="status-dot {{ $user->warnings >= 3 ? 'critical' : ($user->warnings >= 1 ? 'warning' : 'online') }}"></div>
                                    <span class="status-text">{{ $shieldStatus }}</span>
                                </div>
                                <div class="encryption-txt small text-white-50 mt-1">WARNINGS: {{ $user->warnings }} / 3</div>
                                <div class="encryption-bar mt-2">
                                    @for($i = 0; $i < 4; $i++)
                                        <div class="encryption-segment {{ $user->warnings <= $i ? 'active' : 'inactive' }}"></div>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <!-- Preserved Shopping Stats -->
                        <div class="status-window summary">
                            <div class="window-title">SHOPPING_STATS</div>
                            <div class="window-content p-3">
                                <div class="stat-item d-flex justify-content-between">
                                    <span class="label text-white-50 small">TOTAL_SUMMONS</span>
                                    <span class="value text-crimson fw-bold">{{ $orderCount }}</span>
                                </div>
                                <div class="stat-item d-flex justify-content-between mt-2">
                                    <span class="label text-white-50 small">ITEMS_ACQUIRED</span>
                                    <span class="value text-white fw-bold">{{ $itemsAcquired }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- System Actions -->
                        <div class="mt-auto pt-4">
                            <a href="{{ route('profile.edit') }}" class="sl-system-btn w-100">
                                <span>UPDATE_IDENTITY</span>
                                <div class="btn-scanner"></div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Corner Crosshair Brackets -->
                <div class="bracket tl"></div>
                <div class="bracket tr"></div>
                <div class="bracket bl"></div>
                <div class="bracket br"></div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Reset custom fonts and use website defaults */
    :root {
        --system-crimson: #dc143c;
        --system-gold: #ffcc00;
        --system-bg: rgba(10, 0, 0, 0.95);
        --glow-crimson: 0 0 15px rgba(220, 20, 60, 0.4);
    }

    body { background-color: #000; color: #fff; }

    .system-bg-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: radial-gradient(circle at center, rgba(220, 20, 60, 0.1) 0%, transparent 70%);
        pointer-events: none; z-index: -1;
    }

    .sl-system-menu {
        background: var(--system-bg);
        border: 1px solid rgba(220, 20, 60, 0.3);
        box-shadow: var(--glow-crimson), inset 0 0 30px rgba(220, 20, 60, 0.1);
        position: relative;
        backdrop-filter: blur(20px);
        margin-bottom: 50px;
        border-radius: 4px;
    }

    /* Brackets */
    .bracket { position: absolute; width: 15px; height: 15px; border: 2px solid var(--system-crimson); z-index: 5; }
    .bracket.tl { top: -2px; left: -2px; border-right: none; border-bottom: none; }
    .bracket.tr { top: -2px; right: -2px; border-left: none; border-bottom: none; }
    .bracket.bl { bottom: -2px; left: -2px; border-right: none; border-top: none; }
    .bracket.br { bottom: -2px; right: -2px; border-left: none; border-top: none; }

    /* Header */
    .system-header { border-bottom: 1px solid rgba(220, 20, 60, 0.2); background: rgba(220, 20, 60, 0.05); }
    .level-tag { color: var(--system-crimson); font-weight: 800; font-size: 0.8rem; letter-spacing: 1px; }
    .job-tag { color: rgba(255,255,255,0.7); font-weight: 700; font-size: 0.8rem; letter-spacing: 0.5px; }
    .vertical-divider { width: 1px; height: 12px; background: rgba(220, 20, 60, 0.4); }
    .player-name { font-weight: 900; font-size: 2.5rem; text-shadow: 0 0 15px var(--system-crimson); margin: 0; line-height: 1; }
    .system-title { color: rgba(255,255,255,0.1); font-size: 0.6rem; letter-spacing: 3px; font-weight: bold; text-transform: uppercase; }

    /* Avatar Mini */
    .avatar-shrine.mini { 
        position: relative; width: 80px; height: 80px; 
        background: rgba(0,0,0,0.5); border: 1px solid rgba(220, 20, 60, 0.2);
    }
    .avatar-img.mini { width: 100%; height: 100%; object-fit: cover; }
    .avatar-placeholder.mini { 
        width: 100%; height: 100%; display: flex; align-items: center; 
        justify-content: center; font-size: 1.5rem; color: #333; 
    }
    .avatar-shrine.mini .bracket { width: 8px; height: 8px; border-width: 1px; }

    /* Resource Bars */
    .progress-bar-sl { height: 10px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 2px; position: relative; }
    .progress-bar-sl .fill { height: 100%; transition: width 1.5s cubic-bezier(0.19, 1, 0.22, 1); }
    .hp .fill { background: linear-gradient(90deg, #ff0044, #dc143c); box-shadow: 0 0 10px #ff0044; }
    .mp .fill { background: linear-gradient(90deg, #ffcc00, #ffaa00); box-shadow: 0 0 10px #ffcc00; }

    /* Attributes */
    .attr-box {
        background: rgba(255,255,255,0.02);
        border-left: 3px solid var(--system-crimson);
        padding: 12px 15px; display: flex; flex-direction: column;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .attr-box:hover { background: rgba(220, 20, 60, 0.1); transform: translateX(8px); }
    .attr-label { font-size: 0.7rem; color: #888; font-weight: 800; letter-spacing: 1px; }
    .attr-value { font-size: 1.6rem; color: #fff; font-weight: 900; }

    .border-gold { border-left-color: #ffcc00; }
    .border-red { border-left-color: #ff0000; }
    .border-dark { border-left-color: #555; }

    /* Identity Panel */
    .bg-crimson-05 { background: rgba(220, 20, 60, 0.05); }
    .border-crimson-20 { border: 1px solid rgba(220, 20, 60, 0.2); }
    .text-crimson { color: var(--system-crimson); }
    .identity-item { display: flex; font-size: 0.85rem; font-weight: 600; }
    .identity-item .label { width: 120px; color: #666; }
    .identity-item .value { color: #fff; flex: 1; }

    /* Windows */
    .status-window { background: rgba(0, 0, 0, 0.6); border: 1px solid rgba(220, 20, 60, 0.2); }
    .window-title {
        background: rgba(220, 20, 60, 0.15); color: var(--system-crimson);
        font-size: 0.7rem; font-weight: 900; padding: 6px 12px;
        border-bottom: 1px solid rgba(220, 20, 60, 0.2); letter-spacing: 1px;
    }
    .status-dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 10px; }
    .status-dot.online { background: #00ff00; box-shadow: 0 0 10px #00ff00; }
    .status-dot.warning { background: #ffaa00; box-shadow: 0 0 10px #ffaa00; }
    .status-dot.critical { background: #ff0000; box-shadow: 0 0 10px #ff0000; }
    .status-text { color: #fff; font-size: 0.85rem; font-weight: 800; }

    .encryption-bar { display: flex; gap: 5px; height: 5px; }
    .encryption-segment { flex: 1; border-radius: 1px; }
    .encryption-segment.active { background: var(--system-crimson); box-shadow: 0 0 8px var(--system-crimson); }
    .encryption-segment.inactive { background: rgba(255,255,255,0.05); }

    /* Button */
    .sl-system-btn {
        display: block; padding: 16px; background: rgba(220, 20, 60, 0.1);
        border: 1px solid var(--system-crimson); color: var(--system-crimson) !important;
        text-align: center; text-decoration: none !important; font-weight: 900;
        letter-spacing: 3px; position: relative; overflow: hidden; transition: all 0.4s;
    }
    .sl-system-btn:hover {
        background: var(--system-crimson); color: #fff !important;
        box-shadow: 0 0 25px var(--glow-crimson); transform: translateY(-3px);
    }
    .btn-scanner {
        position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: 0.8s;
    }
    .sl-system-btn:hover .btn-scanner { left: 100%; }

    .border-crimson-10 { border-right: 1px solid rgba(220, 20, 60, 0.1); }

    @media (max-width: 768px) {
        .player-name { font-size: 2rem; }
        .main-interface .col-md-7 { border-right: none !important; border-bottom: 1px solid rgba(220, 20, 60, 0.1); }
    }
</style>
@endsection



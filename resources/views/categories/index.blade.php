@extends('layouts.frontend')

@php
    $title = 'All Categories - Hikari Anime Store';
@endphp

@push('styles')
    <style>
        /* 3D Flip Animation Styles */
        .card-container {
            width: 100%;
            aspect-ratio: 59 / 86; /* Standard Yu-Gi-Oh ratio */
            perspective: 1000px;
            cursor: pointer;
            margin: 0 auto;
            max-width: 320px;
        }

        .yugioh-card {
            width: 100%;
            height: 100%;
            position: relative;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            transform-style: preserve-3d;
        }

        .yugioh-card.flipped {
            transform: rotateY(180deg);
        }

        .card-front, .card-back {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 4px; /* Slight rounding to match common cards */
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.8);
        }

        .card-back {
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
            z-index: 2;
        }

        .card-front {
            transform: rotateY(180deg);
            background-size: 100% 100%;
            background-repeat: no-repeat;
            z-index: 1;
            background-position: center;
        }

        /* Fixed Coordinate Overlays (Percentages based on standard YGO layout) */
        
        .card-name-overlay {
            position: absolute;
            top: 5.8%;
            left: 9.1%; /* Moved right 2px from 8.5% (approx +0.6%) */
            width: 73%;
            height: 5%;
            font-family: 'Times New Roman', serif;
            font-weight: 900;
            text-transform: uppercase;
            font-size: 0.95rem;
            color: #111;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: flex;
            align-items: center;
            z-index: 10;
        }

        .card-attribute-overlay {
            position: absolute;
            top: 4.5%;
            right: 9.3%; /* Moved RIGHT by approx 10px (from 12.5% to ~9.3%) */
            width: 9.5%;
            aspect-ratio: 1;
            z-index: 10;
        }

        .card-attribute-overlay img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .card-stars-overlay {
            position: absolute;
            top: 12.5%;
            left: 10%;
            width: 80%;
            height: 4.2%;
            display: flex;
            flex-direction: row;
            gap: 1.5%;
            z-index: 10;
            pointer-events: none;
        }

        .card-stars-overlay img {
            height: 100%;
            width: auto;
            object-fit: contain;
        }

        .card-artwork-overlay {
            position: absolute;
            top: 25.7%; /* Reverted to stable position */
            left: 12.2%;
            width: 75.6%;
            height: 35.8%;
            background: #000;
            overflow: hidden;
            z-index: 5;
        }

        .card-artwork-overlay img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .card-description-overlay {
            position: absolute;
            bottom: -5.1%;
            left: 7.6%; /* Stable position restored */
            width: 83%;
            height: 29.5%;
            padding: 1% 4% 3% 4%;
            overflow: hidden;
            z-index: 10;
            display: flex;
            flex-direction: column;
            pointer-events: none;
        }

        .card-type-overlay {
            font-weight: 900;
            font-family: 'Times New Roman', serif;
            font-size: 0.64rem; /* Smaller font as requested */
            color: #000;
            margin-top: -0.4%; /* Stable position restored */
            margin-bottom: 2.5%; /* Keep 7px gap */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }

        .card-text-overlay {
            font-family: 'Arial Narrow', sans-serif;
            font-size: 0.62rem;
            line-height: 1.1;
            font-style: italic;
            color: #111;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex-grow: 1;
            margin-top: 1%;
        }

        .card-stats-overlay {
            display: flex;
            justify-content: flex-end;
            gap: 12%;
            font-family: 'Times New Roman', serif;
            font-weight: 950;
            font-size: 0.68rem;
            color: #000;
            border-top: none;
            padding-top: 1%;
            margin-top: auto;
            margin-bottom: 15.85%; /* Moved UP independently by 10px (5.7% + 2.15%) */
            margin-right: 2%;
        }
    </style>
@endpush

@section('content')
<div class="container py-5">
    <header class="text-center mb-5 mt-5" data-aos="fade-down">
        <h1 class="display-3" style="font-family: 'Kaushan Script', cursive; color: crimson; text-shadow: 0 0 10px #000;">Deck Collection</h1>
        <p class="lead text-white-50">Precision-crafted for the ultimate duelist experience.</p>
    </header>

    <div class="row g-5 justify-content-center">
        @foreach($categories as $category)
        <div class="col-sm-6 col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 100 }}">
            <div class="card-container" onmouseenter="handleCardEnter(this)" onmouseleave="handleCardLeave(this)">
                <a href="{{ route('products.index', ['category_id' => $category->id]) }}" class="text-decoration-none">
                    <div class="yugioh-card">
                        <!-- Card Back -->
                        <div class="card-back" style="background-image: url('{{ $cardBack ? asset('storage/' . $cardBack) : 'https://i.pinimg.com/736x/01/2d/73/012d73f30964147317e303414734b26c.jpg' }}');">
                        </div>

                        <!-- Card Front (Frame is the background image) -->
                        @php 
                            $frameImage = $category->cardFrame ? asset('storage/' . $category->cardFrame->image_path) : asset('img/default-frame.jpg');
                        @endphp
                        <div class="card-front" style="background-image: url('{{ $frameImage }}');">
                            <!-- Title Bar Overlays -->
                            <div class="card-name-overlay">{{ $category->name }}</div>
                            
                            @if($category->cardAttribute)
                            <div class="card-attribute-overlay">
                                <img src="{{ asset('storage/' . $category->cardAttribute->image_path) }}" alt="{{ $category->cardAttribute->name }}">
                            </div>
                            @endif

                            <!-- Stars Bar Overlay -->
                            <div class="card-stars-overlay">
                                @php 
                                    $starImage = $category->cardStar ? asset('storage/' . $category->cardStar->image_path) : null;
                                    $level = $category->card_level ?? 4;
                                @endphp
                                @for($i = 0; $i < $level; $i++) 
                                    @if($starImage)
                                        <img src="{{ $starImage }}" alt="Star">
                                    @endif
                                @endfor
                            </div>

                            <!-- Artwork Viewport Overlay -->
                            <div class="card-artwork-overlay">
                                @php
                                    $artworkUrl = $category->image_path 
                                        ? (Str::startsWith($category->image_path, 'http') ? $category->image_path : asset('storage/' . $category->image_path))
                                        : 'https://i.pinimg.com/736x/8e/8e/8e/8e8e8e8e8e8e8e8e8e8e8e8e8e8e8e8e.jpg'; // Placeholder
                                @endphp
                                <img src="{{ $artworkUrl }}" alt="{{ $category->name }}">
                            </div>

                            <!-- Lower Parchment Overlay (Description & Stats) -->
                            <div class="card-description-overlay">
                                <div class="card-type-overlay">
                                    @php
                                        $subcats = $category->children->pluck('name')->toArray();
                                        $typeText = count($subcats) > 0 ? implode(' / ', $subcats) : $category->name;
                                    @endphp
                                    [ {{ $typeText }} ]
                                </div>
                                <div class="card-text-overlay">
                                    {{ $category->description ?? 'Explore the vast and powerful collection of ' . $category->name . ' artifacts. Each item is selected for its rarity and impact in the grand duel.' }}
                                </div>

                                @if($category->show_card_stats)
                                <div class="card-stats-overlay">
                                    <span><small>ATK : {{ $category->card_atk ?? '0' }}</small></span>
                                    <span><small>DEF : {{ $category->card_def ?? '0' }}</small></span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    const persistenceTime = 60000; // 1 minute
    const timers = new Map();

    function handleCardEnter(wrapper) {
        const card = wrapper.querySelector('.yugioh-card');
        card.classList.add('flipped');
        if (timers.has(wrapper)) {
            clearTimeout(timers.get(wrapper));
            timers.delete(wrapper);
        }
    }

    function handleCardLeave(wrapper) {
        const card = wrapper.querySelector('.yugioh-card');
        const timer = setTimeout(() => {
            card.classList.remove('flipped');
            timers.delete(wrapper);
        }, persistenceTime);
        timers.set(wrapper, timer);
    }
</script>
@endpush

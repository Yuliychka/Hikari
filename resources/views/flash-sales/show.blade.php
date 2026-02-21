@extends('layouts.frontend')

@section('title', $flashSale->title)

@section('content')
<!-- Flash Sale Hero -->
<div class="container-fluid p-0 mb-5 text-center text-white position-relative overflow-hidden" 
     style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.8)), url('{{ $flashSale->banner_image ? Storage::url($flashSale->banner_image) : 'https://images.unsplash.com/photo-1550684848-fac1c5b4e853?q=80&w=1920&auto=format&fit=crop' }}'); 
            background-size: cover; background-position: center; min-height: 400px; display: flex; align-items: center; justify-content: center;">
    
    <!-- Manga Speed Lines Effect (CSS only) -->
    <div class="position-absolute w-100 h-100" style="background: repeating-linear-gradient(90deg, transparent 0, transparent 50px, rgba(255,255,255,0.05) 50px, rgba(255,255,255,0.05) 51px);"></div>

    <div class="position-relative z-1 container" data-aos="zoom-in">
        <span class="badge bg-danger mb-3 px-3 py-2 fs-6 rounded-pill text-uppercase tracking-wider">Limited Time Event</span>
        <h1 class="display-2 fw-bold text-uppercase mb-2" style="font-family: 'Black Ops One', cursive; letter-spacing: 2px;">{{ $flashSale->title }}</h1>
        
        <!-- Timer -->
        <div class="d-flex justify-content-center gap-3 mt-4" id="fullscreen-countdown" data-end-date="{{ $flashSale->end_time }}">
            <div class="timer-box bg-dark border border-danger p-3 rounded text-center" style="min-width: 100px;">
                <h2 class="m-0 text-danger fw-bold" id="fs-days">00</h2>
                <small class="text-uppercase text-secondary">Days</small>
            </div>
            <div class="timer-box bg-dark border border-danger p-3 rounded text-center" style="min-width: 100px;">
                <h2 class="m-0 text-danger fw-bold" id="fs-hours">00</h2>
                <small class="text-uppercase text-secondary">Hours</small>
            </div>
            <div class="timer-box bg-dark border border-danger p-3 rounded text-center" style="min-width: 100px;">
                <h2 class="m-0 text-danger fw-bold" id="fs-minutes">00</h2>
                <small class="text-uppercase text-secondary">Minutes</small>
            </div>
            <div class="timer-box bg-dark border border-danger p-3 rounded text-center" style="min-width: 100px;">
                <h2 class="m-0 text-danger fw-bold" id="fs-seconds">00</h2>
                <small class="text-uppercase text-secondary">Seconds</small>
            </div>
        </div>
    </div>
</div>

<!-- Products Grid -->
<div class="container py-5">
    <div class="row g-4">
        @forelse($flashSale->products as $product)
            <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up">
                @include('partials.product-card', ['product' => $product])
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h3 class="text-muted">No products selected for this sale yet.</h3>
            </div>
        @endforelse
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const timerEl = document.getElementById('fullscreen-countdown');
        if(timerEl) {
            const endDateStr = timerEl.dataset.endDate;
            const endDate = new Date(endDateStr.replace(/-/g, "/")).getTime();
            
            const timer = setInterval(() => {
                const now = new Date().getTime();
                const distance = endDate - now;
                
                if (distance < 0) {
                    clearInterval(timer);
                    timerEl.innerHTML = '<h2 class="text-danger">EVENT ENDED</h2>';
                    return;
                }
                
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
                document.getElementById('fs-days').innerText = days < 10 ? '0'+days : days;
                document.getElementById('fs-hours').innerText = hours < 10 ? '0'+hours : hours;
                document.getElementById('fs-minutes').innerText = minutes < 10 ? '0'+minutes : minutes;
                document.getElementById('fs-seconds').innerText = seconds < 10 ? '0'+seconds : seconds;
            }, 1000);
        }
    });
</script>
@endpush
@endsection

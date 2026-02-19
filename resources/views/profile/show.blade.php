@extends('layouts.frontend')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8" data-aos="fade-up">
            <div class="glass-card p-5" style="background: rgba(0,0,0,0.9); border: 2px solid crimson; position: relative; overflow: hidden;">
                <!-- Kanji Decoration -->
                <div style="position: absolute; top: -20px; right: -20px; font-size: 10rem; color: rgba(220, 20, 60, 0.05); font-weight: 900; pointer-events: none;">情</div>
                
                <div class="text-center mb-5">
                    <div class="profile-avatar-container mb-4 d-inline-block">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" style="width: 150px; height: 150px; border: 3px solid crimson; border-radius: 15px; object-fit: cover; box-shadow: 0 0 20px rgba(220, 20, 60, 0.3);">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-dark" style="width: 150px; height: 150px; border: 3px solid crimson; border-radius: 15px;">
                                <i class="bi bi-person text-crimson" style="font-size: 4rem;"></i>
                            </div>
                        @endif
                    </div>
                    <h1 class="display-5 fw-bold text-crimson" style="font-family: 'Kaushan Script', cursive;">{{ $user->name }}</h1>
                    <p class="text-white-50 x-small text-uppercase letter-spacing-2 mt-2">Warrior since {{ $user->created_at->format('F Y') }}</p>
                </div>

                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <div class="info-block p-3 border-start border-danger bg-black-50">
                            <label class="text-white-50 small text-uppercase fw-bold d-block mb-1">Email Ritual</label>
                            <div class="fs-5">{{ $user->email }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-block p-3 border-start border-danger bg-black-50">
                            <label class="text-white-50 small text-uppercase fw-bold d-block mb-1">Katana Hotline</label>
                            <div class="fs-5">{{ $user->phone ?? 'Not Bound' }}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="info-block p-3 border-start border-danger bg-black-50">
                            <label class="text-white-50 small text-uppercase fw-bold d-block mb-1">Village / City</label>
                            <div class="fs-5">{{ $user->city ?? 'Unknown Territory' }}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="info-block p-3 border-start border-danger bg-black-50">
                            <label class="text-white-50 small text-uppercase fw-bold d-block mb-1">Delivery Fortress (Address)</label>
                            <div class="fs-5">{{ $user->address ?? 'No Fortress Specified' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Security & Summary Sections -->
                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <div class="glass-card p-4 h-100" style="background: rgba(220, 20, 60, 0.1); border: 1px dashed crimson;">
                            <h5 class="fw-bold text-crimson mb-3"><i class="bi bi-shield-lock me-2"></i> SECURITY</h5>
                            <div class="mb-2">
                                <small class="text-white-50 text-uppercase d-block">Account Status</small>
                                <span class="badge bg-success">ACTIVE & SECURED</span>
                            </div>
                            <div class="mb-2">
                                <small class="text-white-50 text-uppercase d-block">Protection Layer</small>
                                <span>SSL Encrypted</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="glass-card p-4 h-100" style="background: rgba(255, 255, 255, 0.05); border: 1px dashed white;">
                            <h5 class="fw-bold text-white mb-3 text-uppercase"><i class="bi bi-graph-up me-2"></i> SUMMARY</h5>
                            <div class="mb-2">
                                <small class="text-white-50 text-uppercase d-block">Total Summons (Orders)</small>
                                <span class="fs-4 fw-bold text-crimson">{{ auth()->user()->orders()->count() }}</span>
                            </div>
                            <div class="mb-2">
                                <small class="text-white-50 text-uppercase d-block">Loyalty Rank</small>
                                <span class="text-white p-1" style="background: crimson; font-size: 0.7rem;">ELITE RONIN</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-danger px-5 py-3 fw-bold rounded-0" style="letter-spacing: 2px;">MODIFY IDENTITY (SETTINGS)</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .glass-card {
        box-shadow: 0 0 40px rgba(0,0,0,1);
    }
    .text-crimson { color: crimson; }
    .bg-black-50 { background: rgba(0, 0, 0, 0.5); }
    .letter-spacing-2 { letter-spacing: 2px; }
    .x-small { font-size: 0.75rem; }
</style>
@endsection

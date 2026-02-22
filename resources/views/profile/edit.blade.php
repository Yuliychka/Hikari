@extends('layouts.frontend')

@section('content')
<!-- System Background Overlay -->
<div class="system-bg-overlay"></div>

<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8" data-aos="zoom-in">
            <!-- Holographic System Menu (Edit Mode) -->
            <div class="sl-system-menu">
                <!-- System Header -->
                <div class="system-header d-flex justify-content-between align-items-end p-4">
                    <div class="player-info">
                        <div class="level-tag">PROCEDURE: IDENTITY_REFORGING</div>
                        <h1 class="player-name text-uppercase">UPDATE_DATA</h1>
                    </div>
                    <div class="system-title">DATA_SYNC_INTERFACE_V2.0</div>
                </div>

                <div class="main-interface p-4">
                    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="row g-4">
                        @csrf
                        @method('patch')

                        <!-- Avatar Reforging -->
                        <div class="col-12 text-center mb-4">
                            <div class="avatar-shrine">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="mb-3 avatar-img">
                                @else
                                    <div class="avatar-placeholder mb-3"><i class="fas fa-user-ninja"></i></div>
                                @endif
                                <div class="avatar-upload-input mt-2">
                                    <label class="sl-label">REPLACE_AVATAR_MODULE</label>
                                    <input type="file" name="avatar" class="sl-form-control">
                                    @error('avatar') <span class="text-danger small fw-bold mt-1 d-block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Data Fields -->
                        <div class="col-md-6">
                            <label class="sl-label">IDENTIFICATION_NAME</label>
                            <input type="text" name="name" class="sl-form-control" value="{{ old('name', $user->name) }}" required>
                            @error('name') <span class="text-danger small fw-bold mt-1 d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="sl-label">COMMUNICATION_LINK (EMAIL)</label>
                            <input type="email" name="email" class="sl-form-control" value="{{ old('email', $user->email) }}" required>
                            @error('email') <span class="text-danger small fw-bold mt-1 d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="sl-label">SIGNAL_ID (PHONE)</label>
                            <input type="text" name="phone" class="sl-form-control" value="{{ old('phone', $user->phone) }}" placeholder="UNDEFINED">
                        </div>

                        <div class="col-md-6">
                            <label class="sl-label">SECTOR_ID (CITY/VILLAGE)</label>
                            <input type="text" name="city" class="sl-form-control" value="{{ old('city', $user->city) }}" placeholder="UNKNOWN_DOMAIN">
                        </div>

                        <div class="col-md-6">
                            <label class="sl-label">POSTAL_CODE (ZIP)</label>
                            <input type="text" name="zip_code" class="sl-form-control" value="{{ old('zip_code', $user->zip_code) }}" placeholder="UNDEFINED">
                        </div>

                        <div class="col-md-6">
                            <label class="sl-label">REALM_ID (COUNTRY)</label>
                            <input type="text" name="country" class="sl-form-control" value="{{ old('country', $user->country) }}" placeholder="UNDEFINED">
                        </div>

                        <div class="col-12">
                            <label class="sl-label">FORTRESS_COORDINATES (FULL ADDRESS)</label>
                            <textarea name="address" rows="3" class="sl-form-control" placeholder="UNDEFINED">{{ old('address', $user->address) }}</textarea>
                        </div>

                        <!-- Action Button -->
                        <div class="col-12 mt-5">
                            <button type="submit" class="sl-system-btn w-100 py-3">
                                <span>INITIALIZE_IDENTITY_SYNC</span>
                                <div class="btn-scanner"></div>
                            </button>
                            <a href="{{ route('profile.show') }}" class="btn-abort mt-2">
                                ABORT_PROCEDURE
                            </a>
                        </div>
                    </form>
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
    :root {
        --system-crimson: #dc143c;
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
        border-radius: 4px;
        padding-bottom: 20px;
    }

    /* Brackets */
    .bracket { position: absolute; width: 15px; height: 15px; border: 2px solid var(--system-crimson); z-index: 5; }
    .bracket.tl { top: -2px; left: -2px; border-right: none; border-bottom: none; }
    .bracket.tr { top: -2px; right: -2px; border-left: none; border-bottom: none; }
    .bracket.bl { bottom: -2px; left: -2px; border-right: none; border-top: none; }
    .bracket.br { bottom: -2px; right: -2px; border-left: none; border-top: none; }

    /* Header */
    .system-header { border-bottom: 1px solid rgba(220, 20, 60, 0.2); background: rgba(220, 20, 60, 0.05); }
    .level-tag { color: var(--system-crimson); font-weight: 800; font-size: 0.9rem; letter-spacing: 1px; }
    .player-name { font-weight: 900; font-size: 2.2rem; text-shadow: 0 0 10px var(--system-crimson); margin: 0; }
    .system-title { color: rgba(255,255,255,0.1); font-size: 0.6rem; letter-spacing: 3px; font-weight: bold; }

    /* Forms */
    .sl-label { font-size: 0.7rem; color: #888; font-weight: 800; letter-spacing: 1px; display: block; margin-bottom: 5px; text-transform: uppercase; }
    .sl-form-control {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(220, 20, 60, 0.2);
        color: #fff;
        border-radius: 0;
        padding: 12px;
        width: 100%;
        font-weight: 600;
        box-shadow: inset 0 0 5px rgba(0,0,0,0.5);
    }
    .sl-form-control:focus {
        outline: none;
        border-color: var(--system-crimson);
        background: rgba(220, 20, 60, 0.05);
        box-shadow: 0 0 10px rgba(220, 20, 60, 0.2);
    }

    /* Avatar */
    .avatar-shrine { position: relative; }
    .avatar-img { 
        width: 150px; height: 150px; border-radius: 4px; border: 2px solid var(--system-crimson);
        box-shadow: 0 0 15px rgba(220, 20, 60, 0.3); object-fit: cover;
    }
    .avatar-placeholder {
        width: 150px; height: 150px; border-radius: 4px; border: 2px dashed rgba(255,255,255,0.1);
        display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #333;
        margin: 0 auto;
    }

    /* Button */
    .sl-system-btn {
        display: block; padding: 16px; background: rgba(220, 20, 60, 0.1);
        border: 1px solid var(--system-crimson); color: var(--system-crimson) !important;
        text-align: center; text-decoration: none !important; font-weight: 900;
        letter-spacing: 3px; position: relative; overflow: hidden; transition: all 0.4s;
        text-transform: uppercase;
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

    .btn-abort {
        display: block; text-align: center; color: #555 !important; font-weight: 800; font-size: 0.7rem;
        letter-spacing: 2px; text-decoration: none !important; transition: color 0.3s;
    }
    .btn-abort:hover { color: #888 !important; }

    @media (max-width: 768px) {
        .player-name { font-size: 1.8rem; }
    }
</style>
@endsection

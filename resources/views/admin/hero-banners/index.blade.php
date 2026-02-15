@extends('layouts.admin')

@section('title', 'Manage Hero Banners')

@section('content')

<!-- Unified Glass Card (Manga Theme) -->
<div class="glass-card">
    
    <!-- Header & Global Settings Form -->
    <div class="mb-5 border-bottom border-secondary pb-4">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h4 class="mb-0 fw-bold text-uppercase" style="font-family: 'Courier New', monospace;">Global Configuration</h4>
                <p class="text-secondary small mb-0">Manage carousel and visual effects</p>
            </div>
        </div>

        <form action="{{ route('admin.hero-banners.update-settings') }}" method="POST">
            @csrf
            <div class="row g-3 align-items-end">
                <!-- Carousel Toggle -->
                <div class="col-md-5">
                    <label class="fw-bold mb-2 text-uppercase small" for="hero_carousel">
                        <i class="fas fa-images me-2"></i> Carousel Mode
                    </label>
                    <select name="hero_carousel" class="form-select bg-white text-dark border-secondary rounded-0 font-monospace fw-bold">
                        <option value="1" {{ $carouselMode == '1' ? 'selected' : '' }}>ENABLED (AUTO-CYCLE)</option>
                        <option value="0" {{ $carouselMode == '0' ? 'selected' : '' }}>DISABLED (SINGLE)</option>
                    </select>
                </div>
                
                <div class="col-md-5">
                     <label class="form-label text-black fw-bold small text-uppercase" for="hero_effect">
                         <i class="fas fa-magic me-2"></i> Hero Effect
                     </label>
                     <select name="hero_effect" class="form-select bg-black text-white border-white rounded-0 font-monospace fw-bold">
                         <option value="none" {{ $heroEffect == 'none' ? 'selected' : '' }}>None</option>
                         <option value="sakura" {{ $heroEffect == 'sakura' ? 'selected' : '' }}>Sakura (Cherry Blossoms)</option>
                         <option value="lightning" {{ $heroEffect == 'lightning' ? 'selected' : '' }}>Lightning/Flash</option>
                     </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-100 rounded-0 border-2 border-dark fw-bold text-uppercase" style="background: #000; color: #fff;">
                        <i class="fas fa-save me-2"></i> SAVE
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Banners Table Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="mb-0 fw-bold text-uppercase" style="font-family: 'Courier New', monospace;">Banners List</h5>
        </div>
        <a href="{{ route('admin.hero-banners.create') }}" class="btn btn-premium rounded-0 text-uppercase fw-bold" style="background: #000; border: 2px solid #000; color: #fff;">
            <i class="fas fa-plus me-2"></i> Add Banner
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr class="text-uppercase small font-monospace text-black fw-bold border-bottom border-dark">
                    <th>Preview</th>
                    <th>Details</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($heroBanners as $banner)
                <tr>
                    <td style="width: 120px;">
                        <img src="{{ Str::startsWith($banner->image_path, 'http') ? $banner->image_path : asset('storage/' . $banner->image_path) }}" 
                             alt="{{ $banner->title }}" 
                             style="width: 100px; height: 60px; object-fit: cover; border: 1px solid #000; filter: grayscale(100%) contrast(1.2);">
                    </td>
                    <td>
                        <div class="fw-bold text-uppercase">{{ $banner->title }}</div>
                        @if($banner->btn_text)
                            <span class="badge bg-light text-dark border border-dark rounded-0 mt-1">{{ $banner->btn_text }}</span>
                        @endif
                    </td>
                    <td><span class="font-monospace">{{ $banner->order }}</span></td>
                    <td>
                        <form action="{{ route('admin.hero-banners.toggle', $banner->id) }}" method="POST" style="display:inline; cursor:pointer;">
                            @csrf
                            <button type="submit" class="border-0 bg-transparent p-0" title="Click to Toggle Status">
                                <span class="badge {{ $banner->is_active ? 'bg-dark' : 'bg-secondary' }} text-white rounded-0 text-uppercase start-0 border {{ $banner->is_active ? 'border-white' : 'border-dark' }}">
                                    {{ $banner->is_active ? 'ACTIVE' : 'HIDDEN' }} <i class="fas fa-sync-alt ms-1 small opacity-50"></i>
                                </span>
                            </button>
                        </form>
                    </td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.hero-banners.edit', $banner->id) }}" class="btn btn-sm btn-outline-dark rounded-0">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.hero-banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Delete this banner?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-0">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    /* Manga Theme Overrides specific to this page */
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        border: 2px solid #000;
        box-shadow: 8px 8px 0 rgba(0,0,0,0.1); 
        padding: 2rem;
    }
    .btn-premium:hover {
        background: #fff !important;
        color: #000 !important;
        box-shadow: 4px 4px 0 rgba(0,0,0,0.2) !important;
    }
</style>
@endsection

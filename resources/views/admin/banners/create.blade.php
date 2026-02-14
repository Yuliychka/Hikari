@extends('layouts.admin')

@section('title', isset($banner) ? 'Edit Banner' : 'Add New Banner/Intro')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="glass-card">
            <form action="{{ isset($banner) ? route('admin.banners.update', $banner->id) : route('admin.banners.store') }}" method="POST">
                @csrf
                @if(isset($banner)) @method('PUT') @endif

                <div class="mb-3">
                    <label class="form-label">Banner Title (Internal use)</label>
                    <input type="text" name="title" class="form-control bg-dark text-white border-secondary @error('title') is-invalid @enderror" value="{{ old('title', $banner->title ?? '') }}">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Image URL</label>
                    <input type="text" name="image_path" class="form-control bg-dark text-white border-secondary @error('image_path') is-invalid @enderror" value="{{ old('image_path', $banner->image_path ?? '') }}" required placeholder="https://...">
                    @error('image_path') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-secondary">Provide a direct link to the image</small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Banner Type</label>
                        <select name="type" class="form-select bg-dark text-white border-secondary" required>
                            <option value="hero" {{ old('type', $banner->type ?? '') == 'hero' ? 'selected' : '' }}>Hero Slider (Home Top)</option>
                            <option value="category" {{ old('type', $banner->type ?? '') == 'category' ? 'selected' : '' }}>Category Image</option>
                            <option value="promo" {{ old('type', $banner->type ?? '') == 'promo' ? 'selected' : '' }}>Promotion Banner</option>
                            <option value="intro" {{ old('type', $banner->type ?? '') == 'intro' ? 'selected' : '' }}>Manga Intro Panel (Manage Loading)</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Display Order</label>
                        <input type="number" name="order" class="form-control bg-dark text-white border-secondary" value="{{ old('order', $banner->order ?? 0) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Link/Redirect URL (Optional)</label>
                    <input type="text" name="link" class="form-control bg-dark text-white border-secondary" value="{{ old('link', $banner->link ?? '') }}" placeholder="/products/...">
                </div>

                <div class="mb-4">
                    <label class="form-label">Visibility Status</label>
                    <select name="is_active" class="form-select bg-dark text-white border-secondary">
                        <option value="1" {{ old('is_active', $banner->is_active ?? 1) == 1 ? 'selected' : '' }}>Active (Enabled)</option>
                        <option value="0" {{ old('is_active', $banner->is_active ?? 1) == 0 ? 'selected' : '' }}>Hidden (Disabled)</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-premium flex-grow-1">
                        {{ isset($banner) ? 'Update Banner' : 'Add Banner' }}
                    </button>
                    <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

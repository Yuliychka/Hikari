@extends('layouts.admin')

@section('title', isset($heroBanner) ? 'Edit Hero Banner' : 'Add Hero Banner')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="glass-card">
            <form action="{{ isset($heroBanner) ? route('admin.hero-banners.update', $heroBanner->id) : route('admin.hero-banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($heroBanner)) @method('PUT') @endif

                <div class="mb-3">
                    <label class="form-label">Banner Title (Internal use)</label>
                    <input type="text" name="title" class="form-control bg-dark text-white border-secondary @error('title') is-invalid @enderror" value="{{ old('title', $heroBanner->title ?? '') }}">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Image Link (URL)</label>
                    <input type="text" name="image_path" class="form-control bg-dark text-white border-secondary @error('image_path') is-invalid @enderror" value="{{ old('image_path', $heroBanner->image_path ?? '') }}" placeholder="https://...">
                    @error('image_path') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-secondary">Provide a direct link to the image</small>
                </div>

                <div class="mb-3">
                    <label class="form-label text-danger">OR Upload Image File</label>
                    <input type="file" name="image_file" class="form-control bg-dark text-white border-secondary @error('image_file') is-invalid @enderror">
                    @error('image_file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-secondary">Max size: 5MB | Recommended: 1920x1080px</small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Display Order</label>
                        <input type="number" name="order" class="form-control bg-dark text-white border-secondary" value="{{ old('order', $heroBanner->order ?? 0) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Visibility Status</label>
                        <select name="is_active" class="form-select bg-dark text-white border-secondary">
                            <option value="1" {{ old('is_active', $heroBanner->is_active ?? 1) == 1 ? 'selected' : '' }}>Active (Enabled)</option>
                            <option value="0" {{ old('is_active', $heroBanner->is_active ?? 1) == 0 ? 'selected' : '' }}>Hidden (Disabled)</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Link/Redirect URL (Optional)</label>
                    <input type="text" name="link" class="form-control bg-dark text-white border-secondary" value="{{ old('link', $heroBanner->link ?? '') }}" placeholder="/products/...">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-premium flex-grow-1">
                        {{ isset($heroBanner) ? 'Update Hero Banner' : 'Add Hero Banner' }}
                    </button>
                    <a href="{{ route('admin.hero-banners.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

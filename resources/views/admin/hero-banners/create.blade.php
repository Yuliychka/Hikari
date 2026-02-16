@extends('layouts.admin')

@section('title', isset($heroBanner) ? 'Edit Hero Banner' : 'Add Hero Banner')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="glass-card">
            <form action="{{ isset($heroBanner) ? route('admin.hero-banners.update', $heroBanner->id) : route('admin.hero-banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($heroBanner)) @method('PUT') @endif

                <div class="d-none"> {{-- Text fields moved to global settings --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Banner Title (Headline)</label>
                            <input type="text" name="title" class="form-control bg-dark text-white border-secondary" value="{{ old('title', $heroBanner->title ?? '') }}" placeholder="e.g. KATANA COLLECTION">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Subtitle</label>
                            <input type="text" name="subtitle" class="form-control bg-dark text-white border-secondary" value="{{ old('subtitle', $heroBanner->subtitle ?? '') }}" placeholder="e.g. Sharpness meets Art">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description (Main Text)</label>
                        <textarea name="description" class="form-control bg-dark text-white border-secondary" rows="3" placeholder="e.g. Discover our premium hand-forged katanas...">{{ old('description', $heroBanner->description ?? '') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Button Text</label>
                            <input type="text" name="btn_text" class="form-control bg-dark text-white border-secondary" value="{{ old('btn_text', $heroBanner->btn_text ?? '') }}" placeholder="e.g. SHOP NOW">
                        </div>
                    </div>
                </div>

                <div class="mb-3 border-top border-secondary pt-3">
                    <label class="form-label">Image Link (URL)</label>
                    <input type="text" name="image_path" id="imagePath" class="form-control bg-dark text-white border-secondary" value="{{ old('image_path', $heroBanner->image_path ?? '') }}" placeholder="https://..." oninput="toggleImageInputs()">
                    <small class="text-secondary d-block mt-1">Provide a direct link to the image</small>
                </div>

                <div class="mb-3">
                    <label class="form-label text-danger">OR Upload Image File</label>
                    <input type="file" name="image_file" id="imageFile" class="form-control bg-dark text-white border-secondary" onchange="toggleImageInputs()">
                    <small class="text-secondary">Max size: 20MB | Recommended: 1920x1080px</small>
                </div>

                <script>
                    function toggleImageInputs() {
                        const fileInput = document.getElementById('imageFile');
                        const urlInput = document.getElementById('imagePath');

                        // If file is selected
                        if (fileInput.files.length > 0) {
                            urlInput.disabled = true;
                            urlInput.style.opacity = '0.5';
                            urlInput.value = ''; // clear url if file selected
                        } else {
                            urlInput.disabled = false;
                            urlInput.style.opacity = '1';
                        }

                        // If url is typed
                        if (urlInput.value.length > 0) {
                            fileInput.disabled = true;
                            fileInput.style.opacity = '0.5';
                            fileInput.value = ''; // clear file if url typed
                        } else {
                            fileInput.disabled = false;
                            fileInput.style.opacity = '1';
                        }
                    }
                    
                    // Run on load to set initial state
                    document.addEventListener('DOMContentLoaded', toggleImageInputs);
                </script>

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

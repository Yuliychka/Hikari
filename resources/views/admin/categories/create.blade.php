@extends('layouts.admin')

@section('title', isset($category) ? 'Edit Category' : 'Create Category')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> BACK TO TABLE OF CONTENTS
    </a>
</div>

<div class="glass-card">
    <h2 class="h4 mb-4 text-uppercase fw-bold border-bottom pb-2">
        {{ isset($category) ? 'Edit Category: ' . $category->name : 'New Category Entry' }}
    </h2>

    <form action="{{ isset($category) ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($category))
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-md-8 mb-4">
                <label class="form-label fw-bold text-uppercase" style="font-size: 0.8rem;">Category Name</label>
                <input type="text" name="name" class="form-control border-dark border-2" value="{{ old('name', $category->name ?? '') }}" required placeholder="e.g. Weaponry, Katanas...">
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4 mb-4">
                <label class="form-label fw-bold text-uppercase" style="font-size: 0.8rem;">Parent Category</label>
                <select name="parent_id" class="form-select border-dark border-2">
                    <option value="">NONE (THIS IS A MAIN CATEGORY)</option>
                    @foreach($parentCategories as $parent)
                        <option value="{{ $parent->id }}" {{ (old('parent_id', $category->parent_id ?? $selectedParentId ?? '') == $parent->id) ? 'selected' : '' }}>
                            {{ $parent->name }}
                        </option>
                    @endforeach
                </select>
                <small class="text-secondary">Select a parent to make this a Subcategory.</small>
                @error('parent_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-12 mb-4">
                <label class="form-label fw-bold text-uppercase" style="font-size: 0.8rem;">Category Image / Banner</label>
                <div class="d-flex gap-3 align-items-center">
                    @if(isset($category) && $category->image_path)
                        <div class="mb-2">
                            <img src="{{ Str::startsWith($category->image_path, 'http') ? $category->image_path : asset('storage/' . $category->image_path) }}" 
                                 class="img-thumbnail" style="height: 100px; width: 100px; object-fit: cover;">
                        </div>
                    @endif
                    <div class="flex-grow-1">
                        <input type="file" name="image_file" class="form-control border-dark border-2">
                        <small class="text-secondary">Recommended: 1200x400 for banners.</small>
                    </div>
                </div>
                @error('image_file') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label fw-bold text-uppercase" style="font-size: 0.8rem;">Display Order</label>
                <input type="number" name="order" class="form-control border-dark border-2" value="{{ old('order', $category->order ?? 0) }}" required>
                @error('order') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label fw-bold text-uppercase" style="font-size: 0.8rem;">Visibility Status</label>
                <select name="is_active" class="form-select border-dark border-2">
                    <option value="1" {{ old('is_active', $category->is_active ?? 1) == 1 ? 'selected' : '' }}>ACTIVE (ENABLED)</option>
                    <option value="0" {{ old('is_active', $category->is_active ?? 1) == 0 ? 'selected' : '' }}>HIDDEN (DISABLED)</option>
                </select>
                @error('is_active') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-12 mb-4">
                <label class="form-label fw-bold text-uppercase" style="font-size: 0.8rem;">Description</label>
                <textarea name="description" class="form-control border-dark border-2" rows="4" placeholder="Brief description of this category...">{{ old('description', $category->description ?? '') }}</textarea>
                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Yu-Gi-Oh Card Details Section -->
            <div class="col-12 mt-4 mb-3">
                <h4 class="text-uppercase fw-bold border-bottom pb-2">Yu-Gi-Oh! Card Settings</h4>
                <div class="alert alert-info py-2" style="font-size: 0.8rem;">
                    <i class="fas fa-info-circle me-1"></i> Manage these assets in the <a href="{{ route('admin.card-assets.index') }}" class="fw-bold text-decoration-none">Card Assets</a> page.
                </div>
            </div>

            <!-- Card Frame -->
            <div class="col-md-6 mb-4">
                <label class="form-label fw-bold text-uppercase" style="font-size: 0.8rem;">Card Frame</label>
                <div class="d-flex align-items-center gap-3">
                    <div class="border p-1 rounded bg-light" style="width: 60px; height: 85px; display: flex; align-items: center; justify-content: center;">
                        <img id="preview-frame" src="{{ isset($category) && $category->cardFrame ? asset('storage/' . $category->cardFrame->image_path) : 'https://via.placeholder.com/60x85?text=Frame' }}" 
                             style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    </div>
                    <select name="card_frame_id" class="form-select border-dark border-2" onchange="updatePreview(this, 'preview-frame')">
                        <option value="" data-image="https://via.placeholder.com/60x85?text=None">DEFAULT (ORANGE)</option>
                        @foreach($cardFrames as $frame)
                            <option value="{{ $frame->id }}" 
                                    data-image="{{ asset('storage/' . $frame->image_path) }}"
                                    {{ (old('card_frame_id', $category->card_frame_id ?? '') == $frame->id) ? 'selected' : '' }}>
                                {{ $frame->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('card_frame_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Card Attribute -->
            <div class="col-md-6 mb-4">
                <label class="form-label fw-bold text-uppercase" style="font-size: 0.8rem;">Attribute</label>
                <div class="d-flex align-items-center gap-3">
                    <div class="border p-1 rounded bg-light" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                        <img id="preview-attribute" src="{{ isset($category) && $category->cardAttribute ? asset('storage/' . $category->cardAttribute->image_path) : 'https://via.placeholder.com/40x40?text=Attr' }}" 
                             style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    </div>
                    <select name="card_attribute_id" class="form-select border-dark border-2" onchange="updatePreview(this, 'preview-attribute')">
                        <option value="" data-image="https://via.placeholder.com/40x40?text=None">DEFAULT (DARK)</option>
                        @foreach($cardAttributes as $attribute)
                            <option value="{{ $attribute->id }}" 
                                    data-image="{{ asset('storage/' . $attribute->image_path) }}"
                                    {{ (old('card_attribute_id', $category->card_attribute_id ?? '') == $attribute->id) ? 'selected' : '' }}>
                                {{ $attribute->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('card_attribute_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>



            <!-- Stars -->
            <div class="col-md-3 mb-4">
                <label class="form-label fw-bold text-uppercase" style="font-size: 0.8rem;">Star Type</label>
                <div class="d-flex align-items-center gap-3">
                    <div class="border p-1 rounded bg-light" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                        <img id="preview-star" src="{{ isset($category) && $category->cardStar ? asset('storage/' . $category->cardStar->image_path) : 'https://via.placeholder.com/30?text=★' }}" 
                             style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    </div>
                    <select name="card_star_id" class="form-select border-dark border-2" onchange="updatePreview(this, 'preview-star')">
                        <option value="" data-image="https://via.placeholder.com/30?text=★">DEFAULT (Star)</option>
                        @foreach($cardStars as $star)
                            <option value="{{ $star->id }}" 
                                    data-image="{{ asset('storage/' . $star->image_path) }}"
                                    {{ (old('card_star_id', $category->card_star_id ?? '') == $star->id) ? 'selected' : '' }}>
                                {{ $star->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                 @error('card_star_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Level -->
            <div class="col-md-3 mb-4">
                <label class="form-label fw-bold text-uppercase" style="font-size: 0.8rem;">Level (Count)</label>
                <input type="number" name="card_level" class="form-control border-dark border-2" value="{{ old('card_level', $category->card_level ?? 4) }}" min="0" max="12">
                @error('card_level') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Stats -->
            <div class="col-md-5 mb-4">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label fw-bold text-uppercase" style="font-size: 0.8rem;">ATK</label>
                        <input type="text" name="card_atk" class="form-control border-dark border-2" value="{{ old('card_atk', $category->card_atk ?? '??') }}">
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-bold text-uppercase" style="font-size: 0.8rem;">DEF</label>
                        <input type="text" name="card_def" class="form-control border-dark border-2" value="{{ old('card_def', $category->card_def ?? '??') }}">
                    </div>
                </div>
            </div>

            <!-- Show Stats Toggle -->
            <div class="col-md-4 mb-4 d-flex align-items-end">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="show_card_stats" name="show_card_stats" value="1" 
                        {{ old('show_card_stats', $category->show_card_stats ?? 1) ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold small text-uppercase" for="show_card_stats">Show ATK/DEF on Card</label>
                </div>
            </div>

            <script>
                function updatePreview(select, previewId) {
                    const selectedOption = select.options[select.selectedIndex];
                    const imageUrl = selectedOption.getAttribute('data-image');
                    const previewImg = document.getElementById(previewId);
                    if (previewImg && imageUrl) {
                        previewImg.src = imageUrl;
                    }
                }
            </script>
        </div>

        <div class="d-flex justify-content-end align-items-center mt-4">
            <button type="submit" class="btn btn-premium">
                {{ isset($category) ? 'UPDATE CATEGORY' : 'SAVE CATEGORY' }}
            </button>
        </div>
    </form>
</div>
@endsection

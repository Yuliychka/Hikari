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
        </div>

        <div class="d-flex justify-content-end align-items-center mt-4">
            <button type="submit" class="btn btn-premium">
                {{ isset($category) ? 'UPDATE CATEGORY' : 'SAVE CATEGORY' }}
            </button>
        </div>
    </form>
</div>
@endsection

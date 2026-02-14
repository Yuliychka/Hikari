@extends('layouts.admin')

@section('title', isset($introPanel) ? 'Edit Intro Panel' : 'Add Intro Panel')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="glass-card">
            <form action="{{ isset($introPanel) ? route('admin.intro-panels.update', $introPanel->id) : route('admin.intro-panels.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($introPanel)) @method('PUT') @endif

                <div class="mb-3">
                    <label class="form-label">Panel Title (Internal use)</label>
                    <input type="text" name="title" class="form-control bg-dark text-white border-secondary @error('title') is-invalid @enderror" value="{{ old('title', $introPanel->title ?? '') }}" placeholder="e.g., Panel 1, Opening Scene">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Image Link (URL)</label>
                    <input type="text" name="image_path" class="form-control bg-dark text-white border-secondary @error('image_path') is-invalid @enderror" value="{{ old('image_path', $introPanel->image_path ?? '') }}" placeholder="https://...">
                    @error('image_path') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-secondary">Provide a direct link to the manga panel image</small>
                </div>

                <div class="mb-3">
                    <label class="form-label text-danger">OR Upload Image File</label>
                    <input type="file" name="image_file" class="form-control bg-dark text-white border-secondary @error('image_file') is-invalid @enderror">
                    @error('image_file') <div class="invalid-feedback">{{ $message }}</div> @enderror>
                    <small class="text-secondary">Max size: 5MB | Manga-style images work best</small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Display Order</label>
                        <input type="number" name="order" class="form-control bg-dark text-white border-secondary" value="{{ old('order', $introPanel->order ?? 0) }}" required>
                        <small class="text-secondary">Order in which panels appear</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Visibility Status</label>
                        <select name="is_active" class="form-select bg-dark text-white border-secondary">
                            <option value="1" {{ old('is_active', $introPanel->is_active ?? 1) == 1 ? 'selected' : '' }}>Active (Enabled)</option>
                            <option value="0" {{ old('is_active', $introPanel->is_active ?? 1) == 0 ? 'selected' : '' }}>Hidden (Disabled)</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-premium flex-grow-1">
                        {{ isset($introPanel) ? 'Update Intro Panel' : 'Add Intro Panel' }}
                    </button>
                    <a href="{{ route('admin.intro-panels.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

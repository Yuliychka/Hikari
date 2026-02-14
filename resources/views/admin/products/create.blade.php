@extends('layouts.admin')

@section('title', isset($product) ? 'Edit Product' : 'Add New Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="glass-card">
            <form action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($product)) @method('PUT') @endif

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control bg-dark text-white border-secondary" value="{{ old('name', $product->name ?? '') }}" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Price ($)</label>
                        <input type="number" step="0.01" name="price" class="form-control bg-dark text-white border-secondary" value="{{ old('price', $product->price ?? '') }}" required>
                        @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">SKU</label>
                        <input type="text" name="sku" class="form-control bg-dark text-white border-secondary" value="{{ old('sku', $product->sku ?? '') }}">
                        @error('sku') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control bg-dark text-white border-secondary" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Image</label>
                    @if(isset($product) && $product->image)
                        <div class="mb-2">
                            <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" class="rounded shadow-sm" style="height: 100px;">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control bg-dark text-white border-secondary">
                    <small class="text-secondary">Leave empty to keep current image</small>
                </div>

                <div class="mb-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select bg-dark text-white border-secondary">
                        <option value="1" {{ old('status', $product->status ?? 1) == 1 ? 'selected' : '' }}>Active (Visible)</option>
                        <option value="0" {{ old('status', $product->status ?? 1) == 0 ? 'selected' : '' }}>Inactive (Hidden)</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-premium flex-grow-1">
                        {{ isset($product) ? 'Update Product' : 'Create Product' }}
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

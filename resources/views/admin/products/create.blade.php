@extends('layouts.admin')

@section('title', isset($product) ? 'Edit Product' : 'Add New Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="glass-card">
            <form action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($product)) @method('PUT') @endif

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control bg-dark text-white border-secondary" value="{{ old('name', $product->name ?? '') }}" required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Main Category</label>
                        <select id="category_id" name="category_id" class="form-select bg-dark text-white border-secondary">
                            <option value="">Select Category</option>
                            @foreach($categories->whereNull('parent_id') as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Subcategory</label>
                        <select id="subcategory_id" name="subcategory_id" class="form-select bg-dark text-white border-secondary">
                            <option value="">Select Subcategory</option>
                            @foreach($categories->whereNotNull('parent_id') as $sub)
                                <option value="{{ $sub->id }}" 
                                        data-parent="{{ $sub->parent_id }}" 
                                        {{ old('subcategory_id', $product->subcategory_id ?? '') == $sub->id ? 'selected' : '' }}>
                                    {{ $sub->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subcategory_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Current Price ($)</label>
                        <input type="number" step="0.01" name="price" class="form-control bg-dark text-white border-secondary" value="{{ old('price', $product->price ?? '') }}" required>
                        @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Old Price ($) <small class="text-secondary">(For Discount)</small></label>
                        <input type="number" step="0.01" name="old_price" class="form-control bg-dark text-white border-secondary" value="{{ old('old_price', $product->old_price ?? '') }}">
                        @error('old_price') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">SKU</label>
                        <input type="text" name="sku" class="form-control bg-dark text-white border-secondary" value="{{ old('sku', $product->sku ?? '') }}">
                        @error('sku') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stock Quantity</label>
                        <input type="number" name="stock_quantity" class="form-control bg-dark text-white border-secondary" value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}" required>
                        @error('stock_quantity') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Discount Active</label>
                        <select name="discount_active" class="form-select bg-dark text-white border-secondary">
                            <option value="0" {{ old('discount_active', $product->discount_active ?? 0) == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('discount_active', $product->discount_active ?? 0) == 1 ? 'selected' : '' }}>Yes (Show Old Price)</option>
                        </select>
                        @error('discount_active') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control bg-dark text-white border-secondary" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Main Product Image</label>
                    @if(isset($product) && $product->image)
                        <div class="mb-2">
                            <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" class="rounded shadow-sm" style="height: 100px;">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control bg-dark text-white border-secondary">
                    <small class="text-secondary">Used as the primary thumbnail</small>
                </div>

                <hr class="border-secondary my-4">

                <div class="mb-3">
                    <label class="form-label">Additional Gallery Images (Max 5)</label>
                    <div class="row g-2 mb-2">
                        @if(isset($product) && $product->images)
                            @foreach($product->images as $galleryImg)
                                <div class="col-auto">
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/' . $galleryImg->image_path) }}" class="rounded" style="width: 80px; height: 80px; object-fit: cover;">
                                        <div class="form-check position-absolute top-0 end-0 bg-dark rounded-circle p-1" style="transform: translate(50%, -50%);">
                                            <input class="form-check-input m-0" type="checkbox" name="remove_images[]" value="{{ $galleryImg->id }}" title="Remove image">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <input type="file" name="gallery[]" class="form-control bg-dark text-white border-secondary mb-2" multiple accept="image/*">
                    <small class="text-secondary">Hold Ctrl/Cmd to select multiple. Max 5 images total in gallery.</small>
                    @error('gallery') <br><small class="text-danger">{{ $message }}</small> @enderror
                    @error('gallery.*') <br><small class="text-danger">{{ $message }}</small> @enderror
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
@section('scripts')
<script>
    function filterSubcategories() {
        const categoryId = document.getElementById('category_id').value;
        const subSelect = document.getElementById('subcategory_id');
        const selectedSubId = subSelect.getAttribute('data-selected');
        
        // Save current options if not already saved
        if (!window.subcategoryOptions) {
            window.subcategoryOptions = Array.from(subSelect.querySelectorAll('option'));
        }

        // Clear current options
        subSelect.innerHTML = '<option value="">Select Subcategory</option>';

        // Filter and add relative subcategories
        const filtered = window.subcategoryOptions.filter(opt => {
            if (!opt.value) return false;
            return opt.getAttribute('data-parent') == categoryId;
        });

        filtered.forEach(opt => {
            const newOpt = opt.cloneNode(true);
            if (newOpt.value == selectedSubId) {
                newOpt.selected = true;
            }
            subSelect.appendChild(newOpt);
        });

        // Show/Hide subcategory container based on whether there are options
        if (filtered.length === 0 && categoryId !== "") {
             // Optional: visual clue that no subcategories exist
        }
    }

    // Initial filter on load
    document.addEventListener('DOMContentLoaded', function() {
        const subSelect = document.getElementById('subcategory_id');
        // Set the selected value into a data attribute for the filter function
        subSelect.setAttribute('data-selected', "{{ old('subcategory_id', $product->subcategory_id ?? '') }}");
        filterSubcategories();
    });

    document.getElementById('category_id').addEventListener('change', function() {
        // Reset the selected attribute so it doesn't persist across parent changes
        document.getElementById('subcategory_id').setAttribute('data-selected', '');
        filterSubcategories();
    });
</script>
@endsection
@endsection

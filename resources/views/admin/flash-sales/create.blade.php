@extends('layouts.admin')

@section('title', isset($flashSale) ? 'Edit Flash Sale' : 'Create Flash Sale')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="glass-card">
            <form action="{{ isset($flashSale) ? route('admin.flash-sales.update', $flashSale->id) : route('admin.flash-sales.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($flashSale)) @method('PUT') @endif

                <div class="mb-3">
                    <label class="form-label">Flash Sale Title</label>
                    <input type="text" name="title" class="form-control bg-dark text-white border-secondary @error('title') is-invalid @enderror" value="{{ old('title', $flashSale->title ?? '') }}" placeholder="e.g., Weekend Flash Sale">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Short Description</label>
                    <textarea name="description" class="form-control bg-dark text-white border-secondary @error('description') is-invalid @enderror" rows="2" placeholder="e.g., Get up to 50% off on all figurines!">{{ old('description', $flashSale->description ?? '') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Banner Image (Optional)</label>
                    <input type="file" name="image_file" class="form-control bg-dark text-white border-secondary @error('image_file') is-invalid @enderror">
                    @error('image_file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    @if(isset($flashSale) && $flashSale->banner_image)
                        <div class="mt-2">
                            <img src="{{ Storage::url($flashSale->banner_image) }}" class="rounded" style="height: 100px;">
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Sale End Time</label>
                    <input type="datetime-local" name="end_time" class="form-control bg-dark text-white border-secondary @error('end_time') is-invalid @enderror" value="{{ old('end_time', isset($flashSale) ? $flashSale->end_time->format('Y-m-d\TH:i') : '') }}">
                    @error('end_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label d-flex justify-content-between align-items-center">
                        Select Products
                        <div class="d-flex gap-2">
                             <input type="text" id="productSearch" class="form-control form-control-sm bg-dark text-white border-secondary" style="width: 200px;" placeholder="Filter products...">
                        </div>
                    </label>

                    <!-- Bulk Apply Tool -->
                    <div class="bulk-tool p-2 mb-2 bg-dark rounded border border-crimson border-opacity-50 d-flex align-items-center justify-content-between">
                        <div class="small text-secondary text-uppercase fw-bold">Bulk Discount Tool</div>
                        <div class="d-flex align-items-center gap-2">
                            <input type="number" id="bulkDiscountValue" class="form-control form-control-sm bg-black text-white border-crimson text-center" style="width: 80px;" placeholder="0" min="0" max="100" step="0.01">
                            <span class="text-crimson fw-bold">%</span>
                            <button type="button" id="bulkApplyBtn" class="btn btn-sm btn-crimson text-uppercase fw-bold px-3" style="font-size: 0.7rem;">Apply to Checked</button>
                        </div>
                    </div>

                    <div class="product-selection-grid p-3 border border-secondary rounded" style="max-height: 500px; overflow-y: auto; background: rgba(0,0,0,0.3);">
                        <div class="d-flex justify-content-between align-items-center mb-3 px-2 border-bottom border-secondary pb-2">
                            <span class="text-secondary small fw-bold text-uppercase">Product Details</span>
                            <span class="text-crimson small fw-bold text-uppercase">Sale Discount (%)</span>
                        </div>
                        <div class="row g-2" id="productList">
                            @foreach($products as $product)
                                <div class="col-12 product-item-container" data-name="{{ strtolower($product->name) }}" data-category="{{ strtolower($product->category->name ?? '') }}">
                                        <div class="form-check d-flex align-items-center gap-3 p-2 bg-dark rounded border border-secondary border-opacity-25 hover-border-crimson flex-grow-1">
                                            <input class="form-check-input ms-0 product-checkbox" type="checkbox" name="products[]" value="{{ $product->id }}" id="prod-{{ $product->id }}"
                                                {{ (collect(old('products', isset($flashSale) ? $flashSale->products->pluck('id') : []))->contains($product->id)) ? 'checked' : '' }}>
                                            @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" class="rounded shadow-sm" style="width: 60px; height: 60px; object-fit: cover; border: 1px solid rgba(255,255,255,0.1);">
                                            @endif
                                            <label class="form-check-label text-white flex-grow-1" for="prod-{{ $product->id }}">
                                                <div class="fw-bold" style="font-size: 1rem;">{{ $product->name }}</div>
                                                <div class="text-secondary small">{{ $product->category->name ?? 'Uncategorized' }} | <span class="text-white-50">${{ number_format($product->price, 2) }}</span></div>
                                            </label>
                                            <div class="discount-input-group d-flex align-items-center gap-2 px-3" style="border-left: 1px solid rgba(255,255,255,0.1);">
                                                <small class="text-secondary text-uppercase fw-bold" style="font-size: 0.6rem;">OFF</small>
                                                <input type="number" name="discounts[{{ $product->id }}]" 
                                                       class="form-control bg-black text-white border-crimson text-center discount-input" 
                                                       placeholder="0" min="0" max="100" step="0.01"
                                                       style="width: 90px; height: 40px; font-size: 1.1rem; font-weight: bold;"
                                                       value="{{ old("discounts.{$product->id}", (isset($flashSale) && $flashSale->products->contains($product->id)) ? $flashSale->products->find($product->id)->pivot->discount_percentage : 0) }}">
                                                <span class="text-crimson fw-bold fs-5">%</span>
                                            </div>
                                        </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @error('products') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <style>
                    .border-crimson { border-color: crimson !important; }
                    .btn-crimson { background: crimson; color: white; border: none; }
                    .btn-crimson:hover { background: #a50e2d; }
                    .hover-border-crimson:hover {
                        border-color: crimson !important;
                        background: rgba(220, 20, 60, 0.05) !important;
                    }
                    .product-selection-grid::-webkit-scrollbar { width: 8px; }
                    .product-selection-grid::-webkit-scrollbar-thumb { background: crimson; border-radius: 4px; }
                    .discount-input:focus {
                        box-shadow: 0 0 10px rgba(220, 20, 60, 0.5);
                        outline: none;
                    }
                </style>

                <script>
                    // Search Logic
                    document.getElementById('productSearch').addEventListener('input', function(e) {
                        const term = e.target.value.toLowerCase();
                        document.querySelectorAll('.product-item-container').forEach(item => {
                            const name = item.dataset.name;
                            const cat = item.dataset.category;
                            if (name.includes(term) || cat.includes(term)) {
                                item.style.display = 'block';
                            } else {
                                item.style.display = 'none';
                            }
                        });
                    });

                    // Bulk Apply Logic
                    document.getElementById('bulkApplyBtn').addEventListener('click', function() {
                        const val = document.getElementById('bulkDiscountValue').value;
                        if (val === '' || val < 0 || val > 100) {
                            alert('Please enter a valid discount percentage (0-100)');
                            return;
                        }

                        let count = 0;
                        document.querySelectorAll('.product-checkbox:checked').forEach(cb => {
                            const container = cb.closest('.product-item-container');
                            const input = container.querySelector('.discount-input');
                            if (input) {
                                input.value = val;
                                count++;
                            }
                        });

                        if (count === 0) {
                            alert('Please select some products first by checking their boxes.');
                        } else {
                            // Flash success effect
                            this.innerText = 'Applied!';
                            this.classList.replace('btn-crimson', 'btn-success');
                            setTimeout(() => {
                                this.innerText = 'Apply to Checked';
                                this.classList.replace('btn-success', 'btn-crimson');
                            }, 1500);
                        }
                    });
                </script>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-select bg-dark text-white border-secondary">
                        <option value="1" {{ old('is_active', $flashSale->is_active ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active', $flashSale->is_active ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-premium flex-grow-1">
                        {{ isset($flashSale) ? 'Update Flash Sale' : 'Create Flash Sale' }}
                    </button>
                    <a href="{{ route('admin.flash-sales.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

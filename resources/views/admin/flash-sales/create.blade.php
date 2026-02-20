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
                    <label class="form-label">Select Products</label>
                    <select name="products[]" class="form-select bg-dark text-white border-secondary" multiple style="height: 200px;">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" 
                                {{ (collect(old('products', isset($flashSale) ? $flashSale->products->pluck('id') : []))->contains($product->id)) ? 'selected' : '' }}>
                                {{ $product->name }} ({{ $product->category->name ?? 'Uncategorized' }})
                            </option>
                        @endforeach
                    </select>
                    <small class="text-secondary">Hold Ctrl (Windows) or Cmd (Mac) to select multiple products.</small>
                    @error('products') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

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

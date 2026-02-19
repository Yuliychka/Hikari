@extends('layouts.admin')

@section('title', 'Edit Coupon')

@section('content')
<div class="glass-card">
    <h4 class="mb-4">Edit Discount Coupon: {{ $coupon->code }}</h4>
    
    <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">Coupon Code</label>
                <input type="text" name="code" class="form-control rounded-0" value="{{ $coupon->code }}" required>
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-bold">Discount Type</label>
                <select name="type" class="form-select rounded-0" required>
                    <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed Amount ($)</option>
                    <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>Percentage (%)</option>
                </select>
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-bold">Discount Value</label>
                <input type="number" name="value" step="0.01" class="form-control rounded-0" value="{{ $coupon->value }}" required>
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-bold">Expiry Date (Optional)</label>
                <input type="date" name="expires_at" class="form-control rounded-0" value="{{ $coupon->expires_at ? $coupon->expires_at->format('Y-m-d') : '' }}">
            </div>
            
            <div class="col-md-12">
                <div class="form-check form-switch">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ $coupon->is_active ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold" for="isActive">Active Status</label>
                </div>
            </div>
            
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-premium px-5">UPDATE COUPON</button>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-dark rounded-0 px-4 ms-2">CANCEL</a>
            </div>
        </div>
    </form>
</div>

<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        border: 2px solid #000;
        box-shadow: 8px 8px 0 rgba(0,0,0,0.1);
        padding: 2rem;
    }
    .btn-premium {
        background: #000 !important;
        border: 2px solid #000 !important;
        color: #fff !important;
        border-radius: 0 !important;
        font-weight: bold;
        text-transform: uppercase;
    }
</style>
@endsection

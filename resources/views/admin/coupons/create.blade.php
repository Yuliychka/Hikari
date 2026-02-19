@extends('layouts.admin')

@section('title', 'Create Coupon')

@section('content')
<div class="glass-card">
    <h4 class="mb-4">Create New Discount Coupon</h4>
    
    <form action="{{ route('admin.coupons.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">Coupon Code</label>
                <input type="text" name="code" class="form-control rounded-0" placeholder="e.g. SUMMER50" required>
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-bold">Discount Type</label>
                <select name="type" class="form-select rounded-0" required>
                    <option value="fixed">Fixed Amount ($)</option>
                    <option value="percent">Percentage (%)</option>
                </select>
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-bold">Discount Value</label>
                <input type="number" name="value" step="0.01" class="form-control rounded-0" placeholder="e.g. 10.00" required>
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-bold">Expiry Date (Optional)</label>
                <input type="date" name="expires_at" class="form-control rounded-0">
            </div>
            
            <div class="col-md-12">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" checked>
                    <label class="form-check-label fw-bold" for="isActive">Active Status</label>
                </div>
            </div>
            
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-premium px-5">CREATE COUPON</button>
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

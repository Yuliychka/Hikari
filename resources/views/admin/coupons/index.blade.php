@extends('layouts.admin')

@section('title', 'Manage Coupons')

@section('content')
<div class="glass-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Discount Coupons</h4>
        <a href="{{ route('admin.coupons.create') }}" class="btn btn-premium">
            <i class="fas fa-plus me-2"></i> Create New Coupon
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Expires At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coupons as $coupon)
                <tr>
                    <td><code>{{ $coupon->code }}</code></td>
                    <td><span class="badge bg-dark rounded-0">{{ strtoupper($coupon->type) }}</span></td>
                    <td>{{ $coupon->type == 'percent' ? $coupon->value . '%' : '$' . $coupon->value }}</td>
                    <td>{{ $coupon->expires_at ? \Carbon\Carbon::parse($coupon->expires_at)->format('M d, Y') : 'Never' }}</td>
                    <td>
                        <span class="badge {{ $coupon->is_active ? 'bg-success' : 'bg-danger' }} rounded-0">
                            {{ $coupon->is_active ? 'ACTIVE' : 'INACTIVE' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-outline-dark rounded-0">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('Delete this coupon?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $coupons->links() }}
    </div>
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

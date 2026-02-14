@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="glass-card text-center">
            <i class="fas fa-shopping-bag fa-3x mb-3 text-accent" style="color: crimson;"></i>
            <h3 class="display-6">{{ $stats['total_products'] }}</h3>
            <p class="text-secondary mb-0">Total Products</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card text-center">
            <i class="fas fa-image fa-3x mb-3 text-accent" style="color: crimson;"></i>
            <h3 class="display-6">{{ $stats['total_banners'] }}</h3>
            <p class="text-secondary mb-0">Total Banners</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card text-center">
            <i class="fas fa-shopping-cart fa-3x mb-3 text-accent" style="color: crimson;"></i>
            <h3 class="display-6">{{ $stats['total_orders'] }}</h3>
            <p class="text-secondary mb-0">Total Orders</p>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-12">
        <div class="glass-card">
            <h4 class="mb-4">Recent Orders</h4>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stats['recent_orders'] as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'Guest' }}</td>
                            <td><span class="status-badge status-active">{{ $order->status }}</span></td>
                            <td>${{ $order->total_price }}</td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                            <td><a href="#" class="btn btn-sm btn-outline-light">Details</a></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-secondary py-4">No recent orders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

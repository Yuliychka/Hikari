@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">My Orders</h2>
    
    @if($orders->count() > 0)
        <div class="table-responsive shadow-sm">
            <table class="table table-hover align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th scope="col" class="py-3 ps-3">Order ID</th>
                        <th scope="col" class="py-3">Date</th>
                        <th scope="col" class="py-3">Status</th>
                        <th scope="col" class="py-3">Total</th>
                        <th scope="col" class="py-3 pe-3 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="ps-3 fw-bold">#{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'warning') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>${{ $order->total_price }}</td>
                        <td class="text-end pe-3">
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">
            You haven't placed any orders yet.
        </div>
    @endif
</div>
@endsection

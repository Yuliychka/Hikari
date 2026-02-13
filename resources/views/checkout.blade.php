@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Billing Details</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('orders.store') }}" method="POST" id="checkout-form">
                        @csrf
                        <div class="mb-3">
                            <label for="address" class="form-label">Shipping Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                        
                        <h5 class="mb-3 mt-4">Payment Method</h5>
                        <div class="mb-3">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                                <label class="form-check-label" for="cod">
                                    Cash on Delivery
                                </label>
                            </div>
                            <!-- Placeholder for other methods -->
                            <div class="form-check disabled">
                                <input class="form-check-input" type="radio" name="payment_method" id="card" value="card" disabled>
                                <label class="form-check-label" for="card">
                                    Credit Card (Coming Soon)
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary d-none" id="submit-btn"></button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush mb-3">
                        @php $total = 0; @endphp
                        @foreach($cartItems as $item)
                        @php $total += $item->product->price * $item->quantity; @endphp
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">{{ $item->product->name }}</h6>
                                <small class="text-muted">x {{ $item->quantity }}</small>
                            </div>
                            <span class="text-muted">${{ number_format($item->product->price * $item->quantity, 2) }}</span>
                        </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong>${{ number_format($total, 2) }}</strong>
                        </li>
                    </ul>
                    <button class="btn btn-primary w-100 btn-lg" onclick="document.getElementById('checkout-form').submit()">Place Order</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

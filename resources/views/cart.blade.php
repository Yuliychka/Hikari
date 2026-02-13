@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Shopping Cart</h1>

    @if($cartItems->count() > 0)
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($cartItems as $item)
                                @php $subtotal = $item->product->price * $item->quantity; $total += $subtotal; @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                            <div>
                                                <h6 class="mb-0">{{ $item->product->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>${{ number_format($item->product->price, 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm" style="width: 70px;" onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td>${{ number_format($subtotal, 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 offset-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h4 class="fw-bold">Total</h4>
                            <h4 class="fw-bold">${{ number_format($total, 2) }}</h4>
                        </div>
                        <a href="#" class="btn btn-primary w-100 btn-lg">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info py-5 text-center">
            <h3>Your cart is empty</h3>
            <a href="/" class="btn btn-primary mt-3">Continue Shopping</a>
        </div>
    @endif
</div>
@endsection

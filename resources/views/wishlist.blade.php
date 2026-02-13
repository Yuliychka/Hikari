@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">My Wishlist</h1>

    @if($wishlistItems->count() > 0)
        <div class="row g-4">
            @foreach($wishlistItems as $item)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ $item->product->image }}" class="card-img-top" alt="{{ $item->product->name }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title text-truncate">{{ $item->product->name }}</h5>
                            <p class="card-text text-danger fw-bold">${{ $item->product->price }}</p>
                            <div class="d-grid gap-2">
                                <form action="{{ route('cart.add', $item->product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-100 mb-2">Move to Cart</button>
                                </form>
                                <form action="{{ route('wishlist.toggle', $item->product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-secondary w-100">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info py-5 text-center">
            <h3>Your wishlist is empty</h3>
            <a href="/" class="btn btn-primary mt-3">Discover Products</a>
        </div>
    @endif
</div>
@endsection

@extends('layouts.frontend')

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="glass-card p-4 mb-4" style="background: rgba(0,0,0,0.8); border: 2px solid crimson;">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom border-danger pb-3">
                    <h2 class="section-header text-start mb-0" style="font-size: 2.5rem;">ORDER #HKR-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h2>
                    <span class="badge bg-danger p-2 text-uppercase">{{ $order->status }}</span>
                </div>

                <h4 class="fw-bold mb-3 text-crimson">Summoned Items</h4>
                <div class="table-responsive">
                    <table class="table table-dark table-borderless align-middle">
                        <thead class="text-white-50 small text-uppercase letter-spacing-1 border-bottom border-secondary">
                            <tr>
                                <th>Spirit (Product)</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-end">Ritual Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $itemsSubtotal = 0; @endphp
                            @foreach($order->items as $item)
                            @php $itemsSubtotal += $item->price * $item->quantity; @endphp
                            <tr class="border-bottom border-dark">
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="product-img-mini me-3" style="width: 60px; height: 60px; border: 1px solid crimson;">
                                            <img src="{{ Str::startsWith($item->product->image, 'http') ? $item->product->image : asset('storage/' . $item->product->image) }}" alt="" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $item->product->name }}</div>
                                            <div class="text-white-50 small">${{ number_format($item->price, 2) }} each</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-end fw-bold">${{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row justify-content-end mt-4">
                    <div class="col-md-5">
                        <div class="p-4 bg-black border border-secondary shadow-lg">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-white-50">Items Subtotal</span>
                                <span>${{ number_format($itemsSubtotal, 2) }}</span>
                            </div>
                            
                            @if($order->discount_amount > 0)
                            <div class="d-flex justify-content-between mb-2 text-success">
                                <span class="fw-bold">Discount ({{ $order->coupon_code }})</span>
                                <span>-${{ number_format($order->discount_amount, 2) }}</span>
                            </div>
                            @endif

                            @php $shipping = $order->total_price - ($itemsSubtotal - $order->discount_amount); @endphp
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-white-50">Logistics (Shipping)</span>
                                <span>{{ $shipping <= 0 ? 'FREE' : '$' . number_format($shipping, 2) }}</span>
                            </div>
                            <hr class="border-secondary">
                            <div class="d-flex justify-content-between">
                                <h4 class="fw-bold text-uppercase mb-0">Total</h4>
                                <h4 class="fw-bold text-crimson mb-0">${{ number_format($order->total_price, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="glass-card p-4 mb-4" style="background: rgba(0,0,0,0.8); border: 2px solid crimson;">
                <h4 class="fw-bold mb-3 text-crimson">Logistics</h4>
                <div class="small text-white-50 text-uppercase fw-bold mb-1">Shipping Fortress</div>
                <p class="border-bottom border-secondary pb-2">{{ $order->shipping_address }}</p>
                
                <div class="small text-white-50 text-uppercase fw-bold mb-1">Payment Ritual</div>
                <p class="border-bottom border-secondary pb-2 text-uppercase">{{ $order->payment_method == 'cod' ? 'Cash on Delivery' : 'Credit Card' }}</p>

                <div class="small text-white-50 text-uppercase fw-bold mb-1">Time of Summon</div>
                <p>{{ $order->created_at->format('M d, Y H:i') }}</p>

                <hr class="border-danger">
                <div class="d-flex justify-content-between h4 fw-bold">
                    <span>TOTAL</span>
                    <span class="text-crimson">${{ number_format($order->total_price, 2) }}</span>
                </div>
            </div>
            
            <a href="{{ route('orders.index') }}" class="btn btn-outline-danger w-100 fw-bold py-2">BACK TO HISTORY</a>
        </div>
    </div>
</div>

<style>
    .text-crimson { color: crimson; }
</style>
@endsection

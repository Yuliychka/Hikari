@extends('layouts.frontend')

@section('content')
<div class="container py-5 mt-5">
    <div class="glass-card p-5" style="background: rgba(0,0,0,0.8); border: 2px solid crimson; color: white;">
        <h1 class="display-4 fw-bold mb-4" style="font-family: 'Kaushan Script', cursive; color: crimson;">Shipping Policy</h1>
        <div class="lead">
            <p>At Hikari Anime Store, we strive to deliver your legendary merchandise as fast as a shinobi. Below you'll find everything you need to know about our shipping procedures.</p>
            
            <h3 class="mt-4 text-crimson">Processing Time</h3>
            <p>All orders are processed within 2-3 business days. Orders are not shipped or delivered on weekends or holidays.</p>

            <h3 class="mt-4 text-crimson">Shipping Rates & Estimates</h3>
            <p>Shipping charges for your order will be calculated and displayed at checkout.</p>
            <ul>
                <li>Standard Shipping (5-7 business days): $15.00</li>
                <li>Express Shipping (2-3 business days): $30.00</li>
                <li>Free Standard Shipping on orders over $100!</li>
            </ul>

            <h3 class="mt-4 text-crimson">International Shipping</h3>
            <p>We ship worldwide! International orders usually arrive within 10-20 business days depending on your location and local customs processing.</p>
        </div>
    </div>
</div>

<style>
    .text-crimson { color: crimson; }
</style>
@endsection

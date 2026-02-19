@extends('layouts.frontend')

@section('content')
<div class="container py-5 mt-5">
    <div class="glass-card p-5" style="background: rgba(0,0,0,0.8); border: 2px solid crimson; color: white;">
        <h1 class="display-4 fw-bold mb-4" style="font-family: 'Kaushan Script', cursive; color: crimson;">Returns & Exchanges</h1>
        <div class="lead">
            <p>We want you to be completely satisfied with your purchase. If a product doesn't meet your expectations, we're here to help.</p>
            
            <h3 class="mt-4 text-crimson">30-Day Return Window</h3>
            <p>You have 30 calendar days to return an item from the date you received it. To be eligible for a return, your item must be unused and in the same condition that you received it.</p>

            <h3 class="mt-4 text-crimson">Refunds</h3>
            <p>Once we receive your item, we will inspect it and notify you that we have received your returned item. We will immediately notify you on the status of your refund after inspecting the item.</p>

            <h3 class="mt-4 text-crimson">Exchanges</h3>
            <p>If you need to exchange an item for a different size or character, contact our support team. The item must be in its original packaging and unused.</p>

            <h3 class="mt-4 text-crimson">Non-Returnable Items</h3>
            <p>Custom-made items, digital downloads, and opened mystery boxes are non-returnable.</p>
        </div>
    </div>
</div>

<style>
    .text-crimson { color: crimson; }
</style>
@endsection

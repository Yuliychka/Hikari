@extends('layouts.admin')

@section('title', 'Card Asset Management')

@section('content')
<div class="mb-5">
    <h2 class="h3 font-weight-bold text-dark text-uppercase mb-4">Card Asset Management</h2>
    
    <div class="glass-card p-4">
        <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fw-bold text-uppercase" id="pills-frame-tab" data-bs-toggle="pill" data-bs-target="#pills-frame" type="button" role="tab">Card Frames</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold text-uppercase" id="pills-attribute-tab" data-bs-toggle="pill" data-bs-target="#pills-attribute" type="button" role="tab">Attributes</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold text-uppercase" id="pills-star-tab" data-bs-toggle="pill" data-bs-target="#pills-star" type="button" role="tab">Stars / Levels</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold text-uppercase text-warning" id="pills-back-tab" data-bs-toggle="pill" data-bs-target="#pills-back" type="button" role="tab">Card Back</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <!-- Global Card Back Tab -->
            <div class="tab-pane fade" id="pills-back" role="tabpanel">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-warning text-dark fw-bold text-uppercase">
                        Global Card Back Image
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <form action="{{ route('admin.card-assets.storeBack') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label text-uppercase fw-bold" style="font-size: 0.8rem;">Upload Card Back Image</label>
                                        <input type="file" name="image_file" class="form-control border-dark" required>
                                        <div class="form-text">Recommended size: 300x440px or standard card ratio including borders.</div>
                                    </div>
                                    <button type="submit" class="btn btn-dark text-uppercase fw-bold w-100">Upload Back</button>
                                </form>
                            </div>
                            <div class="col-md-6 text-center">
                                <label class="form-label text-uppercase fw-bold d-block mb-2" style="font-size: 0.8rem;">Current Card Back Preview</label>
                                @if(isset($cardBack) && $cardBack)
                                    <div class="d-inline-block border border-dark rounded shadow-sm p-1 bg-white">
                                        <img src="{{ asset('storage/' . $cardBack) }}" alt="Card Back" class="img-fluid rounded" style="max-width: 150px; aspect-ratio: 0.68;">
                                    </div>
                                @else
                                    <div class="alert alert-secondary mb-0">No custom card back set.</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Frames Tab -->
            <div class="tab-pane fade show active" id="pills-frame" role="tabpanel">
                @include('admin.card-assets.partials.asset-section', ['type' => 'frame', 'assets' => $frames, 'title' => 'Card Frames', 'placeholder' => 'e.g. Effect Monster, Spell, Trap'])
            </div>

            <!-- Attributes Tab -->
            <div class="tab-pane fade" id="pills-attribute" role="tabpanel">
                @include('admin.card-assets.partials.asset-section', ['type' => 'attribute', 'assets' => $attributes, 'title' => 'Card Attributes', 'placeholder' => 'e.g. DARK, LIGHT, FIRE'])
            </div>



            <!-- Stars Tab -->
            <div class="tab-pane fade" id="pills-star" role="tabpanel">
                @include('admin.card-assets.partials.asset-section', ['type' => 'star', 'assets' => $stars, 'title' => 'Level Stars', 'placeholder' => 'e.g. Level Star, Rank Star'])
            </div>
        </div>
    </div>
</div>
@endsection

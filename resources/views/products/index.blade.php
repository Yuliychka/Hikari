@extends('layouts.frontend')

@php
    $title = 'Shop - Hikari Anime Store';
    $sloganTitle = \App\Models\Setting::get('store_slogan_title', 'Anime Collection');
    $sloganSubtitle = \App\Models\Setting::get('store_slogan_subtitle', 'Discover Your Next Obsession');
    $sloganImage = \App\Models\Setting::get('store_slogan_image', null);
@endphp

@push('styles')
    <style>
        .page-header {
            @if($sloganImage)
                background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('storage/' . $sloganImage) }}');
                background-size: cover;
                background-position: center;
            @else
                background: #050505; /* Sleek solid black fallback */
            @endif
            padding: 5rem 0;
            text-align: center;
            border-bottom: 4px solid crimson;
        }
        
        /* Filter Sidebar */
        .filter-sidebar {
            background: rgba(0, 0, 0, 0.95);
            border: 2px solid crimson;
            border-radius: 0;
            padding: 2rem;
            position: sticky;
            top: 100px;
            backdrop-filter: blur(10px);
            overflow-y: auto;
        }
        
        /* Invisible Scrollbar - Still scrollable */
        .filter-sidebar::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }
        
        /* Firefox - hide scrollbar */
        .filter-sidebar {
            scrollbar-width: none;
        }
        
        .filter-title {
            font-family: 'Kaushan Script', cursive;
            color: crimson;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            text-shadow: 0 0 10px rgba(220, 20, 60, 0.5);
        }
        
        .filter-section {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(220, 20, 60, 0.3);
        }
        
        .filter-section:last-child {
            border-bottom: none;
        }
        
        .filter-section h6 {
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }
        
        .filter-sidebar .form-control,
        .filter-sidebar .form-select {
            background: #000;
            color: #fff;
            border: 1px solid #333;
            border-radius: 0;
        }
        
        .filter-sidebar .form-control:focus,
        .filter-sidebar .form-select:focus {
            background: #000;
            color: #fff;
            border-color: crimson;
            box-shadow: 0 0 0 0.2rem rgba(220, 20, 60, 0.25);
        }
        
        .filter-sidebar .form-check-input {
            background-color: #000;
            border-color: #333;
            border-radius: 0;
        }
        
        .filter-sidebar .form-check-input:checked {
            background-color: crimson;
            border-color: crimson;
        }
        
        .filter-sidebar .form-check-label {
            color: #ddd;
            font-size: 0.9rem;
        }
        
        .btn-filter {
            background: crimson;
            color: #fff;
            border: none;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
            border-radius: 0;
        }
        
        .btn-filter:hover {
            background: #fff;
            color: crimson;
            box-shadow: 0 0 15px rgba(220, 20, 60, 0.5);
        }
        
        .btn-clear {
            background: transparent;
            color: #fff;
            border: 1px solid #333;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
            border-radius: 0;
        }
        
        .btn-clear:hover {
            border-color: crimson;
            color: crimson;
        }
        
        /* Mobile Filter Toggle */
        .mobile-filter-toggle {
            display: none;
        }
        
        @media (max-width: 991px) {
            .mobile-filter-toggle {
                display: block;
                margin-bottom: 1.5rem;
            }
            
            .filter-sidebar {
                position: fixed;
                top: 0;
                left: -100%;
                width: 300px;
                height: 100vh;
                z-index: 10000; /* Above navbar (9999) */
                overflow-y: auto;
                transition: left 0.3s ease;
            }
            
            .filter-sidebar.show {
                left: 0;
            }
            
            .filter-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.7);
                z-index: 9998; /* Below sidebar but above content */
            }
            
            .filter-overlay.show {
                display: block;
            }
        }
        
    </style>
@endpush

@section('content')
<header class="page-header">
    <h1 class="display-3 mt-5" style="font-family: 'Kaushan Script', cursive; color: crimson; text-shadow: 2px 2px 0 #fff;">{{ $sloganTitle }}</h1>
    <p class="lead text-white-50">{{ $sloganSubtitle }}</p>
</header>

<div class="container py-5">
    <!-- Mobile Filter Toggle -->
    <div class="mobile-filter-toggle">
        <button class="btn btn-danger w-100 rounded-0 fw-bold" onclick="toggleFilters()">
            <i class="bi bi-funnel"></i> FILTERS
        </button>
    </div>

    <div class="row">
        <!-- Filter Sidebar -->
        <div class="col-lg-3">
            <div class="filter-overlay" onclick="toggleFilters()"></div>
            <aside class="filter-sidebar" id="filterSidebar">
                <h2 class="filter-title">Filters</h2>
                
                <form action="{{ route('products.index') }}" method="GET" id="filterForm">
                    <!-- Search -->
                    <div class="filter-section">
                        <h6>Search</h6>
                        <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                    </div>

                    <!-- Category -->
                    <div class="filter-section">
                        <h6>Category</h6>
                        <select name="category_id" id="categorySelect" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }} data-subcategories='@json($category->children)'>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Subcategory (appears when category selected) -->
                    <div class="filter-section" id="subcategorySection" style="display: none;">
                        <h6>Subcategory</h6>
                        <select name="subcategory_id" id="subcategorySelect" class="form-select">
                            <option value="">All Subcategories</option>
                        </select>
                    </div>

                    <!-- Price Range -->
                    <div class="filter-section">
                        <h6>Price Range</h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="number" name="min_price" class="form-control" placeholder="Min" value="{{ request('min_price') }}" min="0" step="0.01">
                            </div>
                            <div class="col-6">
                                <input type="number" name="max_price" class="form-control" placeholder="Max" value="{{ request('max_price') }}" min="0" step="0.01">
                            </div>
                        </div>
                    </div>

                    <!-- Availability -->
                    <div class="filter-section">
                        <h6>Availability</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="in_stock" value="1" id="inStock" {{ request('in_stock') ? 'checked' : '' }}>
                            <label class="form-check-label" for="inStock">
                                In Stock Only
                            </label>
                        </div>
                    </div>

                    <!-- Sort By -->
                    <div class="filter-section">
                        <h6>Sort By</h6>
                        <select name="sort" class="form-select">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="most_sold" {{ request('sort') == 'most_sold' ? 'selected' : '' }}>Most Popular</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A-Z</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z-A</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-filter">APPLY FILTERS</button>
                        <a href="{{ route('products.index') }}" class="btn btn-clear">CLEAR ALL</a>
                    </div>
                </form>
            </aside>
        </div>

        <!-- Products Grid -->
        <div class="col-lg-9">
            <div class="row g-4">
                @forelse($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    @include('partials.product-card', [
                        'product'   => $product,
                        'delay'     => $loop->iteration * 50,
                        'cardClass' => 'manga-card',
                        'badge'     => $product->created_at->gt(now()->subDays(7)) ? 'NEW' : null
                    ])
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <h3 class="text-white-50">No products found.</h3>
                    <a href="{{ route('products.index') }}" class="btn btn-danger mt-3 rounded-0">CLEAR FILTERS</a>
                </div>
                @endforelse
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleFilters() {
        const sidebar = document.getElementById('filterSidebar');
        const overlay = document.querySelector('.filter-overlay');
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
    }

    // Cascading category/subcategory
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('categorySelect');
        const subcategorySection = document.getElementById('subcategorySection');
        const subcategorySelect = document.getElementById('subcategorySelect');

        // Check on page load if category is selected
        if (categorySelect.value) {
            updateSubcategories();
        }

        categorySelect.addEventListener('change', function() {
            updateSubcategories();
        });

        function updateSubcategories() {
            const selectedOption = categorySelect.options[categorySelect.selectedIndex];
            const subcategories = selectedOption.dataset.subcategories;

            if (categorySelect.value && subcategories) {
                const subCats = JSON.parse(subcategories);
                
                // Clear existing options
                subcategorySelect.innerHTML = '<option value="">All Subcategories</option>';
                
                // Add subcategories
                if (subCats && subCats.length > 0) {
                    subCats.forEach(function(subcat) {
                        const option = document.createElement('option');
                        option.value = subcat.id;
                        option.textContent = subcat.name;
                        // Check if this subcategory was previously selected
                        if ('{{ request("subcategory_id") }}' == subcat.id) {
                            option.selected = true;
                        }
                        subcategorySelect.appendChild(option);
                    });
                    subcategorySection.style.display = 'block';
                } else {
                    subcategorySection.style.display = 'none';
                }
            } else {
                subcategorySection.style.display = 'none';
                subcategorySelect.innerHTML = '<option value="">All Subcategories</option>';
            }
        }
    });
</script>
@endpush

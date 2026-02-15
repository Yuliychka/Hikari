<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Hikari Anime Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <style>
        body {
            background-color: #111;
            color: #fff;
            font-family: 'Poppins', sans-serif;
        }
        
        .page-header {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1578632738981-43c945b69f7a?q=80&w=1920&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            padding: 5rem 0;
            text-align: center;
            border-bottom: 4px solid crimson;
        }
        
        .manga-card {
            background: #fff;
            color: #000;
            border: 4px solid #000;
            box-shadow: 10px 10px 0 #000;
            transition: transform 0.3s;
            height: 100%;
        }
        
        .manga-card:hover {
            transform: translate(-5px, -5px);
            box-shadow: 15px 15px 0 #000;
        }
        
        .manga-card .card-img-top {
            height: 250px;
            object-fit: cover;
            border-bottom: 4px solid #000;
            filter: grayscale(100%);
            transition: filter 0.3s;
        }
        
        .manga-card:hover .card-img-top {
            filter: grayscale(0%);
        }
        
        .manga-card .card-body {
            background: repeating-linear-gradient(
                45deg,
                #fff,
                #fff 10px,
                #eee 10px,
                #eee 20px
            );
        }
        
        .pagination .page-link {
            background: #000;
            color: #fff;
            border: 1px solid #333;
        }
        
        .pagination .page-item.active .page-link {
            background: crimson;
            border-color: crimson;
        }
    </style>
</head>
<body>

    @include('additions.navbar')

    <header class="page-header">
        <h1 class="display-3" style="font-family: 'Kaushan Script', cursive; color: crimson; text-shadow: 2px 2px 0 #fff;">Game Store</h1>
        <p class="lead text-white-50">Collect them all!</p>
    </header>

    <div class="container py-5">
        <!-- Search & Filter (Optional placeholder) -->
        <div class="row mb-5">
            <div class="col-md-6 mx-auto">
                <form action="{{ route('products.index') }}" method="GET" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control rounded-0 border-2 border-danger" placeholder="Search for products..." value="{{ request('search') }}" style="background: #000; color: #fff;">
                    <button type="submit" class="btn btn-danger rounded-0 fw-bold">SEARCH</button>
                </form>
            </div>
        </div>

        <div class="row g-4">
            @forelse($products as $product)
            <div class="col-md-3" data-aos="fade-up">
                <div class="card manga-card">
                    <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-uppercase">{{ $product->name }}</h5>
                        <p class="card-text small text-truncate fw-bold text-secondary">{{ $product->description }}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fs-5 fw-bold" style="background: #000; color: #fff; padding: 2px 8px;">${{ $product->price }}</span>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-dark border-2 fw-bold rounded-0">VIEW</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <h3 class="text-white-50">No products found.</h3>
            </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <footer class="bg-black py-4 mt-auto text-center border-top border-danger">
        <p class="mb-0 text-secondary">&copy; {{ date('Y') }} Hikari Anime Store.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>

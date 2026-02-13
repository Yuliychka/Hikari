<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <style>
        .product-image {
            max-height: 400px;
            object-fit: cover;
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.3s ease;
        }

        .thumbnail:hover,
        .thumbnail.active {
            opacity: 1;
        }
    </style>
</head>

<body>




    <div class="container mt-5">
        <div class="row">
            <!-- Product Images -->
            <div class="col-md-6 mb-4 d-flex">
                <!-- Thumbnails column -->
                <div class="d-flex flex-column me-4 ">
                    <img src="{{ $item->image }}" alt="Thumbnail 1" class="thumbnail rounded mt-3 mb-3" onclick="changeImage(event, this.src)">
                    <img src="{{ $item->image }}" alt="Thumbnail 2" class="thumbnail rounded mb-3" onclick="changeImage(event, this.src)">
                    <img src="{{ $item->image }}" alt="Thumbnail 3" class="thumbnail rounded mb-3" onclick="changeImage(event, this.src)">
                    <img src="{{ $item->image }}" alt="Thumbnail 4" class="thumbnail rounded" onclick="changeImage(event, this.src)">
                </div>

                <!-- Main Image -->
                <img src="{{ $item->image }}" alt="Product" class="img-fluid rounded product-image" id="mainImage" style="max-height:400px; object-fit:cover;">
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <h2 class="mb-3">{{ $item->name }}</h2>
                <p class="text-muted mb-4">SKU: {{ $item->sku }}</p>
                <div class="mb-3">
                    <span class="h4 me-2">{{ $item->price }} $</span>
                    <span class="text-muted"><s>$399.99</s></span>
                </div>
                <div class="mb-3">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-half text-warning"></i>
                    <span class="ms-2">4.5 (120 reviews)</span>
                </div>
                <p class="mb-4"> {{ $item->description }}</p>

                <div class="mb-4">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="number" class="form-control" id="quantity" value="1" min="1" style="width: 80px;">
                </div>
                <button class="btn btn-primary btn-lg mb-3 me-2">
                    <i class="bi bi-cart-plus"></i> Add to Cart
                </button>
                <button class="btn btn-outline-secondary btn-lg mb-3">
                    <i class="bi bi-heart"></i> Add to Wishlist
                </button>

            </div>
        </div>
    </div>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function changeImage(event, src) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
            event.target.classList.add('active');
        }
    </script>
</body>

</html>
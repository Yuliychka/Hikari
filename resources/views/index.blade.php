<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <!-- CSS for theme -->
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <!-- For cards -->
    <style>
        .product-card {
            transition: all 0.3s ease;
            overflow: hidden;
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.89);
        }

        .product-image {
            transition: all 0.5s ease;
            height: 300px;
            object-fit: cover;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }
        
    </style>

</head>

<body class="bg-light ">

@include("additions.navbar")



    <!-- Spacer -->
    <div style="height: 120px;"></div>




    <!-- Cards -->
    <div class="container py-5">
        <div class="row g-4 justify-content-center">
            @foreach ( $products as $p)
            <div class="col-6 col-sm-6 col-md-4 col-lg-3 ">
                <div class="card border-3 shadow-sm h-100 product-card">
                    <img src="{{$p->image}}" class="card-img-top product-image" alt="product image" height="250px">
                    <div class="card-body">
                        <h5 class="card-title text-dark fw-bold">{{substr($p->name,0,36)}}</h5>
                        <p class="card-text text-muted">{{substr($p->description,0,55)}}...</p>
                        <h6 class="text mb-3 fw-bold" style="color: crimson; ">Price :{{$p->price}} $</h6>
                        <div class="d-flex gap-2">
                            <a href="/{{ $p->id }}" class="btn btn-outline-danger w-50">View more</a>
                            <a href="#" class="btn btn-outline-danger w-50">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>





















    <div class="d-flex justify-content-center">
        {{$products->links()}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
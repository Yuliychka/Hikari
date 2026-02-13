<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Hikari Anime Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #111;
            color: #fff;
        }
        .about-header {
            font-family: 'Kaushan Script', cursive;
            color: crimson;
            text-shadow: 2px 2px 4px #000;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(220, 20, 60, 0.3);
            border-radius: 15px;
            padding: 2rem;
        }
        .team-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid crimson;
            transition: transform 0.3s;
        }
        .team-img:hover {
            transform: scale(1.1) rotate(5deg);
        }
    </style>
</head>
<body class="mt-body">

    @include("additions.navbar")

    <div class="container py-5 mt-5">
        <div class="row align-items-center mb-5">
            <div class="col-md-6" data-aos="fade-right">
                <h1 class="display-3 about-header mb-4">Our Story</h1>
                <div class="glass-panel">
                    <p class="lead">Welcome to Hikari Anime Store, where passion meets quality.</p>
                    <p>Born from a deep love for Japanese animation and culture, we strive to bring you the finest collection of anime merchandise. From rare figures to stylish apparel, every item is curated for true otaku.</p>
                    <p>Our mission is simple: to help you express your fandom with pride and style.</p>
                </div>
            </div>
            <div class="col-md-6 text-center" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1578632767115-351597cf2477?q=80&w=1000&auto=format&fit=crop" alt="Anime Store" class="img-fluid rounded shadow-lg border border-danger" style="max-height: 400px;">
            </div>
        </div>

        <div class="row text-center mt-5">
            <h2 class="about-header mb-5" data-aos="fade-up">Arigato for visiting!</h2>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>

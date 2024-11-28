<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>McProducts Menu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #DA291C;
            --secondary-color: #FFC72C;
            --dark-color: #27251F;
            --light-color: #f2f2f2;
        }
        body {
            font-family: 'Arial', sans-serif;
            color: var(--dark-color);
            overflow-x: hidden;
        }
        .navbar {
            background-color: var(--primary-color);
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 30px;
        }
        h1 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .btn-custom {
            background-color: var(--secondary-color);
            color: var(--dark-color);
            font-weight: bold;
            border: none;
        }
        .btn-custom:hover {
            background-color: #e6b400;
            color: var(--dark-color);
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            transition: transform 0.3s;
            background-color: white;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .product-img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        footer {
            background-color: var(--dark-color);
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 30px;
        }
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        .content-wrapper {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>
    <video autoplay muted loop class="video-background">
        <source src="{{ asset('videos/mcdo.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    
    <div class="content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <i class="fas fa-hamburger me-2"></i>McProducts Menu
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user me-1"></i>Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart me-1"></i>View Cart
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('customer_orders') }}" method="GET" class="d-inline">
                                <button type="submit" class="btn btn-link nav-link">
                                    <i class="fas fa-receipt me-1"></i>View Orders
                                </button>
                            </form>
                        </li>   
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">
                                    <i class="fas fa-sign-out-alt me-1"></i>Logout
                                </button>
                            </form>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <h1>Our Menu</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('products.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Search menu items...">
                    <button type="submit" class="btn btn-custom">
                        <i class="fas fa-search me-1"></i>Search
                    </button>
                </div>
            </form>

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="product-card">
                            @if ($product->image)
                                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->product_name }}" class="product-img mb-3">
                            @endif
                            <h5>{{ $product->product_name }}</h5>
                            <p class="text-muted">{{ $product->description }}</p>
                            <p class="font-weight-bold">₱{{ number_format($product->price, 2) }}</p>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form">
                                @csrf
                                <input type="hidden" name="image" value="{{ $product->image }}">
                                <div class="input-group mb-2">
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-cart-plus me-1"></i>Add to Cart
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <footer>
            <p>&copy; 2024 McProducts Menu. All rights reserved.</p>
        </footer>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.add-to-cart-form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    alert(response.message);
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseJSON.message);
                }
            });
        });

        // Add this new script for staggered animation of product cards
        $('.product-card').each(function(index) {
            $(this).css('animation-delay', (index * 0.1) + 's');
        });
    });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Products List</title>
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
            display: flex;
        }
        .navbar {
            background-color: var(--primary-color);
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .sidebar {
            width: 180px;
            background-color: var(--light-color);
            border-right: 1px solid #ddd;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            padding: 10px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .sidebar h5 {
            color: var(--primary-color);
            margin-bottom: 15px;
        }
        .sidebar .list-group-item {
            border: none;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: background-color 0.3s;
        }
        .sidebar .list-group-item:hover {
            background-color: var(--secondary-color);
            color: white;
        }
        .container {
            margin-left: 215px; /* Adjusted for sidebar width */
            margin-right: 200px; /* Adjusted for sidebar width */
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 30px;
            height: calc(100vh - 60px); /* Fixed height to prevent resizing */
            overflow-y: auto; /* Allow scrolling if content overflows */
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
        .original-price {
            text-decoration: line-through;
            color: #999; /* Lighter color for strikethrough */
            font-size: 1.2em; /* Slightly larger font size */
            margin-right: 10px; /* Space between original and discounted price */
        }

        .discounted-price {
            color: green;
            font-weight: bold;
            animation: bounce 0.5s;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        /* Add this new animation class */
        .discount-animation {
            display: inline-block;
            animation: bounce 0.5s;
        }

        /* Enhanced styles for discount badge */
        .discount-badge {
            display: inline-block;
            background-color: #DA291C; /* McDonald's red */
            color: white;
            padding: 10px 20px;
            border-radius: 50%; /* Circular badge */
            font-weight: bold;
            font-size: 1.5em; /* Larger font size */
            margin-left: 10px;
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow effect */
            transition: transform 0.3s; /* Smooth scaling effect */
        }

        .discount-badge:hover {
            transform: scale(1.1); /* Scale up on hover */
        }

        .price-container {
            display: flex;
            align-items: center; /* Center align items */
        }

        @keyframes scale-up {
            0% {
                transform: scale(0.8);
            }
            100% {
                transform: scale(1);
            }
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
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-hamburger me-2"></i>Admin Products
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                            </a>
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

        <div class="sidebar">
            <h5>Catalogs</h5>
            <ul class="list-group">
                @foreach ($catalogs as $catalog)
                    <li class="list-group-item">
                        <a href="{{ route('admin.products.index', ['catalog' => $catalog->id]) }}">
                            {{ $catalog->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <button class="btn btn-secondary mt-3" onclick="window.location.href='{{ route('admin.products.index') }}';">Refresh</button>
        </div>

        <div class="container">
            <h1>Admin Products List</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('admin.products.create') }}" class="btn btn-custom">
                    <i class="fas fa-plus me-1"></i>Add Product
                </a>
                <form action="{{ route('admin.products.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" value="{{ request('search') }}" placeholder="Search products...">
                    <button type="submit" class="btn btn-custom">
                        <i class="fas fa-search me-1"></i>Search
                    </button>
                </form>
            </div>

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="product-card">
                            @if ($product->image)
                                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->product_name }}" class="product-img mb-3">
                            @endif
                            <h5>{{ $product->product_name }}</h5>
                            <p class="text-muted">{{ $product->description }}</p>
                            <p class="font-weight-bold price-container">
                                @if ($product->discount_percentage)
                                    <span class="original-price">₱{{ number_format($product->price, 2) }}</span>
                                    <span class="discount-badge">₱{{ number_format($product->price * (1 - $product->discount_percentage / 100), 2) }}</span>
                                @else
                                    ₱{{ number_format($product->price, 2) }}
                                @endif
                            </p>
                            <p>Stock: {{ $product->stock }}</p>
                            <p>Catalog: {{ $product->catalog ? $product->catalog->name : 'No catalog' }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt me-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                            <form action="{{ route('admin.products.addStock', $product->id) }}" method="POST" class="mt-2">
                                @csrf
                                <div class="input-group">
                                    <input type="number" name="stock" class="form-control" placeholder="Add stock" min="1" required>
                                    <button type="submit" class="btn btn-success">Add Stock</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <footer>
            <p>&copy; 2024 Admin Products. All rights reserved.</p>
        </footer>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
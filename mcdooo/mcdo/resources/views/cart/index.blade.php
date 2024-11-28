<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>McCart - Your Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            background-color: var(--light-color);
            color: var(--dark-color);
        }
        .navbar {
            background-color: var(--primary-color);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand, .nav-link {
            color: white !important;
            font-weight: bold;
        }
        .container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 30px;
        }
        h1 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 2.5rem;
        }
        .btn-custom {
            background-color: var(--secondary-color);
            color: var(--dark-color);
            font-weight: bold;
            border: none;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #e6b400;
            color: var(--dark-color);
            transform: translateY(-2px);
        }
        .card {
            border: none;
            border-radius: 15px;
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
        }
        .total {
            font-size: 1.5em;
            font-weight: bold;
            color: var(--primary-color);
        }
        .card-body {
            display: flex;
            align-items: center;
        }
        .product-details {
            flex-grow: 1;
            padding-left: 20px;
        }
        .quantity-control {
            display: flex;
            align-items: center;
        }
        .quantity-control input {
            width: 50px;
            text-align: center;
            margin: 0 10px;
        }
        .btn-remove {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .btn-remove:hover {
            background-color: #b22318;
        }
    </style>
</head>
<body>
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
        <h1><i class="fas fa-shopping-cart me-2"></i>Your Order</h1>
        
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                @if(isset($details['image']))
                                    <img src="{{ asset('images/' . $details['image']) }}" alt="{{ $details['name'] }}" class="product-image">
                                @else
                                 
                                @endif
                            </div>
                            <div class="product-details">
                                <h5 class="card-title">{{ $details['name'] }}</h5>
                                <p class="card-text">Price: ₱{{ number_format($details['price'], 2) }}</p>
                                <div class="quantity-control">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="quantity" value="{{ $details['quantity'] - 1 }}" class="btn btn-sm btn-outline-secondary">-</button>
                                        <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="form-control d-inline" style="width: 60px;">
                                        <button type="submit" name="quantity" value="{{ $details['quantity'] + 1 }}" class="btn btn-sm btn-outline-secondary">+</button>
                                    </form>
                                </div>
                            </div>
                            <div>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-remove">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
            <div class="text-end mt-4">
                <h3 class="total">Total: ₱{{ number_format($total, 2) }}</h3>
                <a href="{{ route('checkout') }}" class="btn btn-custom btn-lg mt-2">
                    <i class="fas fa-cash-register me-1"></i>Proceed to Checkout
                </a>
            </div>
        @else
            <div class="alert alert-info" role="alert">
                <i class="fas fa-info-circle me-2"></i>Your cart is empty.
            </div>
        @endif
        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Continue Shopping
            </a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
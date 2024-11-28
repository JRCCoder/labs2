<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>McDonald's - Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --mcdo-red: #DA291C;
            --mcdo-yellow: #FFC72C;
            --mcdo-black: #27251F;
        }
        body {
            font-family: 'Speedee', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica', 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: var(--mcdo-black);
        }
        .navbar {
            background-color: var(--mcdo-red);
        }
        .navbar-brand {
            color: white !important;
            font-weight: bold;
        }
        .container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 30px;
            margin-bottom: 30px;
        }
        h1, h2 {
            color: var(--mcdo-red);
        }
        .order-details, .shipping-details {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .item {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        .item:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .total {
            font-size: 1.2em;
            color: var(--mcdo-red);
            font-weight: bold;
        }
        .btn-mcdo {
            background-color: var(--mcdo-yellow);
            color: var(--mcdo-black);
            border: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-mcdo:hover {
            background-color: var(--mcdo-red);
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://www.mcdonalds.com/content/dam/sites/usa/nfl/logo/mcdonalds-logo-full-color-rgb.jpg" alt="McDonald's Logo" height="30" class="d-inline-block align-top me-2">
                Order Confirmation
            </a>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Thank You for Your Order!</h1>
        
        <div class="order-details">
            <h2><i class="fas fa-receipt me-2"></i>Order Details</h2>
            <p><strong>Order Number:</strong> #{{ $order->id }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('F d, Y h:i A') }}</p>
        </div>

        <div class="shipping-details">
            <h2><i class="fas fa-shipping-fast me-2"></i>Shipping Information</h2>
            <p><strong>Name:</strong> {{ $order->name }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
            <p><strong>City:</strong> {{ $order->city }}</p>
            <p><strong>Postal Code:</strong> {{ $order->postal_code }}</p>
        </div>

        <h2><i class="fas fa-hamburger me-2"></i>Order Items</h2>
        @foreach($order->items as $item)
            <div class="item">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5>{{ $item->product->product_name }}</h5>
                    </div>
                    <div class="col-md-2 text-md-end">
                        <p class="mb-0">Qty: {{ $item->quantity }}</p>
                    </div>
                    <div class="col-md-2 text-md-end">
                        <p class="mb-0">₱{{ number_format($item->price, 2) }}</p>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="total mt-4 text-end">
            @if($order->applied_voucher)
                <p>Subtotal: ₱{{ number_format($order->total_amount + $order->discount_amount, 2) }}</p>
                <p>Discount ({{ $order->applied_voucher }}): -₱{{ number_format($order->discount_amount, 2) }}</p>
            @endif
            <p><strong>Total: ₱{{ number_format($order->total_amount, 2) }}</strong></p>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-mcdo btn-lg">
                <i class="fas fa-utensils me-2"></i>Continue Shopping
            </a>
        </div>
    </div>

    <footer class="bg-light text-center text-lg-start mt-4">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2023 McDonald's. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
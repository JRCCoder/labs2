<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>McCheckout - Complete Your Order</title>
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
        h1, h2 {
            color: var(--primary-color);
            font-weight: bold;
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
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #ddd;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 199, 44, 0.25);
        }
        .payment-option {
            flex: 1;
            text-align: center;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .payment-option:hover {
            border-color: var(--secondary-color);
            background-color: #fff9e6;
        }
        .payment-option .form-check-input {
            display: none;
        }
        .payment-option .form-check-label {
            display: block;
            cursor: pointer;
        }
        .payment-option .form-check-input:checked + .form-check-label {
            color: var(--primary-color);
            font-weight: bold;
        }
        .payment-option .form-check-input:checked + .form-check-label i {
            color: var(--secondary-color);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('products.index') }}">
                <i class="fas fa-hamburger me-2"></i>McProducts
            </a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart me-1"></i>Cart
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1 class="mb-4 text-center"><i class="fas fa-cash-register me-2"></i>Checkout</h1>
        
        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-3">Order Summary</h2>
                @if(session()->has('cart') && count(session('cart')) > 0)
                    @foreach(session('cart') as $id => $details)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $details['name'] }}</h5>
                                <p class="card-text">Price: ₱{{ number_format($details['price'], 2) }}</p>
                                <p class="card-text">Quantity: {{ $details['quantity'] }}</p>
                            </div>
                        </div>
                    @endforeach
                    <h3 class="mt-4">Total: ₱{{ number_format($total, 2) }}</h3>
                @else
                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle me-2"></i>Your cart is empty.
                    </div>
                @endif
            </div>
            
            <div class="col-md-6">
                <h2 class="mb-3">Shipping Information</h2>
                <form action="{{ route('place.order') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Payment Method</label>
                        <div class="d-flex justify-content-between">
                            <div class="form-check payment-option">
                                <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal" required>
                                <label class="form-check-label" for="paypal">
                                    <i class="fab fa-paypal fa-2x me-2"></i>PayPal
                                </label>
                            </div>
                            <div class="form-check payment-option">
                                <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="credit_card" required>
                                <label class="form-check-label" for="credit_card">
                                    <i class="far fa-credit-card fa-2x me-2"></i>Credit Card
                                </label>
                            </div>
                            <div class="form-check payment-option">
                                <input class="form-check-input" type="radio" name="payment_method" id="cash_on_delivery" value="cash_on_delivery" required>
                                <label class="form-check-label" for="cash_on_delivery">
                                    <i class="fas fa-money-bill-wave fa-2x me-2"></i>Cash on Delivery
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="voucher" class="form-label">Voucher Code</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="voucher" name="voucher" placeholder="Enter voucher code">
                            <button class="btn btn-outline-secondary" type="button" id="apply-voucher">Apply</button>
                        </div>
                    </div>
                    
                    <!-- Display discount and total after discount -->
                    <div id="discount-info" style="display: none;">
                        <p>Discount: ₱<span id="discount-amount">0.00</span></p>
                        <h3>Total after discount: ₱<span id="total-after-discount">{{ number_format($total, 2) }}</span></h3>
                    </div>
                    <button type="submit" class="btn btn-custom w-100 mb-3">
                        <i class="fas fa-check-circle me-2"></i>Place Order
                    </button>
                </form>
                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="fas fa-arrow-left me-2"></i>Back to Cart
                </a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#apply-voucher').click(function() {
            var voucherCode = $('#voucher').val();
            var total = {{ $total }};

            $.ajax({
                url: '{{ route("validate.voucher") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    voucher: voucherCode,
                    total: total
                },
                success: function(response) {
                    if (response.valid) {
                        $('#discount-amount').text(response.discount.toFixed(2));
                        $('#total-after-discount').text(response.newTotal.toFixed(2));
                        $('#discount-info').show();
                        // Add a hidden input to send the applied voucher with the form
                        $('form').append('<input type="hidden" name="applied_voucher" value="' + voucherCode + '">');
                    } else {
                        alert('Invalid voucher code');
                    }
                },
                error: function() {
                    alert('Error applying voucher');
                }
            });
        });
    });
    </script>
</body>
</html>
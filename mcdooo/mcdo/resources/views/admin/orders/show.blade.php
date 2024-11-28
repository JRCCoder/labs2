<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        :root {
            --mcd-red: #DA291C;
            --mcd-yellow: #FFC72C;
            --mcd-black: #27251F;
        }
        body {
            font-family: 'Speedee', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica', 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: var(--mcd-red);
        }
        .navbar-brand {
            color: var(--mcd-yellow) !important;
            font-weight: bold;
            font-size: 1.5rem;
        }
        h1, h2 {
            color: var(--mcd-black);
        }
        .btn-primary {
            background-color: var(--mcd-red);
            border-color: var(--mcd-red);
        }
        .btn-primary:hover {
            background-color: #b5231b;
            border-color: #b5231b;
        }
        .card {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .table {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .table thead {
            background-color: var(--mcd-yellow);
        }
        .bounce-in {
            animation: bounceIn 0.5s;
        }
        @keyframes bounceIn {
            0% { transform: scale(0.8); opacity: 0; }
            60% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); }
        }
        .fade-in {
            animation: fadeIn 1s;
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">McAdmin</a>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="bounce-in">Order #{{ $order->id }}</h1>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Back to Order Management</a>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card fade-in">
                    <div class="card-body">
                        <h2 class="card-title">Order Details</h2>
                        <p><strong>Customer:</strong> {{ $order->name }}</p>
                        <p><strong>Email:</strong> {{ $order->email }}</p>
                        <p><strong>Address:</strong> {{ $order->address }}</p>
                        <p><strong>City:</strong> {{ $order->city }}</p>
                        <p><strong>Postal Code:</strong> {{ $order->postal_code }}</p>
                        <p><strong>Total:</strong> ₱{{ number_format($order->total_amount, 2) }}</p>
                        <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
                        <p><strong>Shipping Status:</strong> {{ $order->shipping_status }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card fade-in">
                    <div class="card-body">
                        <h2 class="card-title">Order Items</h2>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>₱{{ number_format($item->price, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card fade-in mb-4">
            <div class="card-body">
                <h2 class="card-title">Update Order Status</h2>
                <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="payment_status" class="form-label">Payment Status</label>
                        <select name="payment_status" id="payment_status" class="form-select">
                            <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="shipping_status" class="form-label">Shipping Status</label>
                        <select name="shipping_status" id="shipping_status" class="form-select">
                            <option value="pending" {{ $order->shipping_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="shipped" {{ $order->shipping_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->shipping_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
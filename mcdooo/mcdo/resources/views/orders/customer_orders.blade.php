<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        h1 {
            color: var(--mcd-black);
        }
        .table {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .table thead {
            background-color: var(--mcd-yellow);
        }
        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
            100% { transform: translateX(0); }
        }
        .status-icon {
            display: inline-block;
            margin-right: 5px;
        }
        @keyframes move {
            0% { transform: translateX(0); }
            50% { transform: translateX(10px); }
            100% { transform: translateX(0); }
        }
        .status-icon.delivered { color: #28a745; }
        .mcdelivery-bike {
            width: 30px;
            height: 30px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('products.index') }}">McProducts</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>My Orders</h1>

        @if($orders->isEmpty())
            <div class="alert alert-info">You have no orders yet.</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('F d, Y') }}</td>
                                <td>₱{{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    @if($order->shipping_status == 'pending')
                                        <span class="status-icon" style="color: #ffc107;"><i class="fas fa-clock"></i> Pending</span>
                                    @elseif($order->shipping_status == 'shipped')
                                        <span class="status-icon shipped" style="color: #DA291C;">
                                            <svg class="mcdelivery-bike" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="animation: move 1s linear infinite;">
                                                <path d="M20,80 Q30,80 40,70 L60,70 Q70,80 80,80" stroke="#000" fill="none" stroke-width="4"/>
                                                <circle cx="30" cy="80" r="15" fill="#DA291C"/>
                                                <circle cx="70" cy="80" r="15" fill="#DA291C"/>
                                                <path d="M40,30 L70,30 L60,60 L30,60 Z" fill="#DA291C"/>
                                                <text x="50" y="50" font-family="Arial" font-size="20" fill="#FFC72C" text-anchor="middle">M</text>
                                            </svg> Shipped
                                        </span>
                                    @elseif($order->shipping_status == 'delivered')
                                        <span class="status-icon" style="color: #28a745;"><i class="fas fa-check-circle"></i> Delivered</span>
                                    @endif
                                </td>
                                <td>
                                    @if($order->shipping_status == 'delivered')
                                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#feedbackModal{{ $order->id }}">Feedback</button>
                                    @endif
                                </td>
                            </tr>

                            <!-- Feedback Modal -->
                            <div class="modal fade" id="feedbackModal{{ $order->id }}" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="feedbackModalLabel">Feedback for Order #{{ $order->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('orders.feedback', $order) }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="feedback" class="form-label">Your Feedback</label>
                                                    <textarea class="form-control" id="feedback" name="feedback" rows="3" required></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit Feedback</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

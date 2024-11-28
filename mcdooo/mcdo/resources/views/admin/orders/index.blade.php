<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
        .btn-primary {
            background-color: var(--mcd-red);
            border-color: var(--mcd-red);
        }
        .btn-primary:hover {
            background-color: #b5231b;
            border-color: #b5231b;
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
        @keyframes drive {
            0% { transform: translateX(-20px) rotateY(0deg); }
            49% { transform: translateX(20px) rotateY(0deg); }
            50% { transform: translateX(20px) rotateY(180deg); }
            100% { transform: translateX(-20px) rotateY(180deg); }
        }
        .status-icon {
            display: inline-block;
            margin-right: 5px;
        }
        .status-icon.pending { color: #ffc107; }
        .status-icon.shipped { 
            animation: drive 4s infinite linear;
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
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">McAdmin</a>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="bounce-in">Order Management</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
        </div>

        <form action="{{ route('admin.orders.index') }}" method="GET" class="mb-4">
            <select name="status" onchange="this.form.submit()" class="form-select">
                <option value="">All Orders</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
            </select>
        </form>

        <div class="table-responsive fade-in">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
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
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>₱{{ number_format($order->total_amount, 2) }}</td>
                        <td>
                            @if($order->shipping_status == 'pending')
                                <span class="status-icon pending"><i class="fas fa-clock"></i></span>
                            @elseif($order->shipping_status == 'shipped')
                                <span class="status-icon shipped">
                                    <svg class="mcdelivery-bike" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20,80 Q30,80 40,70 L60,70 Q70,80 80,80" stroke="#000" fill="none" stroke-width="4"/>
                                        <circle cx="30" cy="80" r="15" fill="#DA291C"/>
                                        <circle cx="70" cy="80" r="15" fill="#DA291C"/>
                                        <path d="M40,30 L70,30 L60,60 L30,60 Z" fill="#DA291C"/>
                                        <text x="50" y="50" font-family="Arial" font-size="20" fill="#FFC72C" text-anchor="middle">M</text>
                                    </svg>
                                </span>
                            @elseif($order->shipping_status == 'delivered')
                                <span class="status-icon delivered"><i class="fas fa-check-circle"></i></span>
                            @endif
                            {{ ucfirst($order->shipping_status) }}
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-primary">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $orders->links() }}

        <a href="{{ route('admin.orders.report') }}" class="btn btn-primary mt-3">Generate Sales Report</a>
    </div>
</body>
</html>
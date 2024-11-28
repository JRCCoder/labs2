<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --mcdo-red: #DA291C;
            --mcdo-yellow: #FFC72C;
            --mcdo-dark: #27251F;
            --mcdo-light: #F2F2F2;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--mcdo-light);
        }
        .sidebar {
            background-color: var(--mcdo-red);
            color: white;
            min-height: 100vh;
            transition: all 0.3s;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
        }
        .sidebar .nav-link {
            color: white;
            padding: 15px 20px;
            margin: 10px 0;
            border-radius: 30px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: var(--mcdo-yellow);
            color: var(--mcdo-dark);
        }
        .main-content {
            margin-left: 16.66667%; /* Corresponds to col-md-2 */
            padding: 30px;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-home me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products.index') }}">
                                <i class="fas fa-box me-2"></i> Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.orders.index') }}">
                                <i class="fas fa-shopping-cart me-2"></i> Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.vouchers.index') }}">
                                <i class="fas fa-ticket-alt me-2"></i> Voucher Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.payments.index') }}">
                                <i class="fas fa-money-bill-wave me-2"></i> Payment Status
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 col-lg-10 ms-sm-auto px-md-4 main-content">
                <h1 class="h2">Staff Dashboard</h1>
                <p>Welcome to the staff dashboard!</p>
                <!-- Additional content can be added here -->
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

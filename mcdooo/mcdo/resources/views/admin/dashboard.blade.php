<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JRTARAKTARAK FOOD HUB Admin Dashboard</title>
    <!-- External CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <!-- Custom CSS -->
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
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
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
            transform: translateX(10px) scale(1.05);
        }
        .main-content {
            padding: 30px;
            background-color: white;
            border-radius: 20px;
            margin: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-left: 16.66667%; /* Corresponds to col-md-2 */
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }
        .card-header {
            background-color: var(--mcdo-yellow);
            color: var(--mcdo-dark);
            font-weight: bold;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            padding: 20px;
        }
        .btn-custom {
            background-color: var(--mcdo-red);
            color: white;
            border: none;
            transition: all 0.3s;
            border-radius: 30px;
            padding: 10px 20px;
        }
        .btn-custom:hover {
            background-color: var(--mcdo-dark);
            color: var(--mcdo-yellow);
            transform: scale(1.05);
        }
        .dashboard-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--mcdo-red);
        }
        .card-title {
            font-size: 3rem;
            font-weight: bold;
            color: var(--mcdo-dark);
        }
        .list-group-item {
            border: none;
            padding: 20px;
            margin-bottom: 10px;
            background-color: var(--mcdo-light);
            border-radius: 15px;
            transition: all 0.3s;
        }
        .list-group-item:hover {
            background-color: var(--mcdo-yellow);
            transform: translateX(10px) scale(1.02);
        }
        .badge {
            padding: 10px 15px;
            font-size: 1rem;
            border-radius: 20px;
        }
        .logout-link {
            position: absolute;
            bottom: 30px;
            left: 30px;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
            background-color: var(--mcdo-dark);
            padding: 10px 20px;
            border-radius: 30px;
        }
        .logout-link:hover {
            color: var(--mcdo-yellow);
            transform: translateX(5px) scale(1.05);
        }
        /* New animations */
        .fade-in-up {
            animation: fadeInUp 0.5s ease-out;
        }
        .fade-in-left {
            animation: fadeInLeft 0.5s ease-out;
        }
        .fade-in-right {
            animation: fadeInRight 0.5s ease-out;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @media (min-width: 992px) {
            .main-content {
                margin-left: 16.66667%; /* Corresponds to col-lg-2 */
            }
        }
        .sidebar .nav {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .sidebar .nav-item.mt-auto {
            margin-top: auto;
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
                            <a class="nav-link active animate__animated animate__fadeInLeft" href="#">
                                <i class="fas fa-home me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link animate__animated animate__fadeInLeft" href="{{ route('admin.products.index') }}">
                                <i class="fas fa-box me-2"></i> Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link animate__animated animate__fadeInLeft" href="{{ route('admin.orders.index') }}">
                                <i class="fas fa-shopping-cart me-2"></i> Orders
                            </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link animate__animated animate__fadeInLeft" href="{{ route('admin.users.index') }}">
                        <i class="fas fa-users me-2"></i> UserManagement
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link animate__animated animate__fadeInLeft" href="#">
                                <i class="fas fa-chart-bar me-2"></i> Analytics
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.vouchers.index') }}">
                                <i class="fas fa-ticket-alt me-2"></i>Voucher Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link animate__animated animate__fadeInLeft" href="{{ route('admin.payments.index') }}">
                                <i class="fas fa-money-bill-wave me-2"></i> Payment Status
                            </a>
                        </li>
                                      <!-- New nav-item for logout -->
            <li class="nav-item mt-auto">
                <a href="{{ route('logout') }}" class="nav-link animate__animated animate__fadeInLeft" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                <!-- Dashboard Header -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 animate__animated animate__fadeInDown">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary animate__animated animate__fadeInRight">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary animate__animated animate__fadeInRight">Export</button>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Overview -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="card fade-in-up">
                            <div class="card-body">
                                <h5 class="card-title">Overview</h5>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <i class="fas fa-box dashboard-icon"></i>
                                        <h3>{{ $totalProducts }}</h3>
                                        <p>Total Products</p>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <i class="fas fa-shopping-cart dashboard-icon"></i>
                                        <h3>{{ $pendingOrders }}</h3>
                                        <p>Pending Orders</p>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <i class="fas fa-dollar-sign dashboard-icon"></i>
                                        <h3>₱{{ number_format($monthlyRevenue, 2) }}</h3>
                                        <p>Monthly Revenue</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="card fade-in-up">
                            <div class="card-body">
                                <h5 class="card-title">Quick Actions</h5>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <a href="{{ route('admin.products.index') }}" class="btn btn-custom btn-lg btn-block">
                                            <i class="fas fa-box me-2"></i> Manage Products
                                        </a>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <a href="{{ route('admin.orders.index') }}" class="btn btn-custom btn-lg btn-block">
                                            <i class="fas fa-shopping-cart me-2"></i> View Orders
                                        </a>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <a href="#" class="btn btn-custom btn-lg btn-block">
                                            <i class="fas fa-chart-bar me-2"></i> View Report
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders and Top Selling Products -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card fade-in-left">
                            <div class="card-header">
                                Recent Orders
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Order #12345
                                        <span class="badge bg-primary rounded-pill">New</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Order #12344
                                        <span class="badge bg-warning rounded-pill">Processing</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Order #12343
                                        <span class="badge bg-success rounded-pill">Shipped</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card fade-in-right">
                            <div class="card-header">
                                Top Selling Products
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Product A
                                        <span class="badge bg-info rounded-pill">150 sold</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Product B
                                        <span class="badge bg-info rounded-pill">120 sold</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Product C
                                        <span class="badge bg-info rounded-pill">90 sold</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

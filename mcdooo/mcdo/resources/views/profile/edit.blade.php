<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Profile') }} - McDonald's Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --mcdonalds-red: #DA291C;
            --mcdonalds-yellow: #FFC72C;
            --mcdonalds-dark: #27251F;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }
        .navbar {
            background-color: var(--mcdonalds-red);
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 30px;
        }
        h2 {
            color: var(--mcdonalds-red);
            font-weight: bold;
        }
        .btn-primary {
            background-color: var(--mcdonalds-yellow);
            border-color: var(--mcdonalds-yellow);
            color: var(--mcdonalds-dark);
        }
        .btn-primary:hover {
            background-color: #e6b400;
            border-color: #e6b400;
            color: var(--mcdonalds-dark);
        }
        .btn-danger {
            background-color: var(--mcdonalds-red);
            border-color: var(--mcdonalds-red);
        }
        .btn-danger:hover {
            background-color: #b22318;
            border-color: #b22318;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-user-circle me-2"></i>{{ __('Profile') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">
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
        <div class="row">
            <div class="col-md-12 mb-4">
                <h2>{{ __('Profile Information') }}</h2>
                @include('profile.partials.update-profile-information-form')
            </div>
            <div class="col-md-12 mb-4">
                <h2>{{ __('Update Password') }}</h2>
                @include('profile.partials.update-password-form')
            </div>
            <div class="col-md-12">
                <h2>{{ __('Delete Account') }}</h2>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
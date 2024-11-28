<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>McRegister</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --mcd-red: #DA291C;
            --mcd-yellow: #FFC72C;
        }
        body {
            background-color: var(--mcd-red);
            font-family: Arial, sans-serif;
        }
        .register-container {
            max-width: 400px;
            margin-top: 50px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .card-body {
            padding: 2rem;
        }
        .btn-primary {
            background-color: var(--mcd-red);
            border-color: var(--mcd-red);
            border-radius: 20px;
            padding: 12px 20px;
            font-weight: bold;
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: #b22318;
            border-color: #b22318;
        }
        .form-control:focus {
            border-color: var(--mcd-yellow);
            box-shadow: 0 0 0 0.25rem rgba(255, 199, 44, 0.25);
        }
        .mcd-logo {
            width: 60px;
            height: 60px;
            background-color: var(--mcd-red);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: var(--mcd-yellow);
            margin: 0 auto 1rem;
        }
        .tooltip-inner {
            background-color: var(--mcd-red);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 register-container">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="mcd-logo">M</div>
                        <h2 class="text-center mb-4">McRegister</h2>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger mb-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Full Name" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter your full name">
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required placeholder="Email address" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter your email address">
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" required placeholder="Password" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter your password">
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Confirm Password" data-bs-toggle="tooltip" data-bs-placement="top" title="Confirm your password">
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>

                        <hr>

                        <div class="text-center">
                            <p class="mb-2">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none" style="color: var(--mcd-red);">Login here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>
</html>
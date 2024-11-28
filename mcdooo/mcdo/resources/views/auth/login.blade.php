<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>McLogin</title>
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
        .login-container {
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
        .modal-header {
            background-color: var(--mcd-red);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 login-container">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="mcd-logo">M</div>
                        <h2 class="text-center mb-4">McLogin</h2>
                        
                        @if (session('status'))
                            <div class="alert alert-success mb-3" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger mb-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Email address" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter your email address">
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" required placeholder="Password" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter your password">
                                </div>
                            </div>

                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">I'm lovin' it</button>
                            </div>
                        </form>

                        <div class="mt-3 text-center">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none text-muted">Forgot your password?</a>
                            @endif
                        </div>

                        <hr>

                        <div class="text-center">
                            <p class="mb-2">New to McLogin? <a href="{{ route('register') }}" class="text-decoration-none" style="color: var(--mcd-red);">Register here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="loginHelpModal" tabindex="-1" aria-labelledby="loginHelpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginHelpModalLabel">Login Help</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    If you are having trouble logging in, please contact support at support@mclogin.com.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
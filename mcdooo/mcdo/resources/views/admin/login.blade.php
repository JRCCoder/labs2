<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>McDonald's Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFC72C;
        }
        .card {
            border: none;
            border-radius: 15px;
        }
        .card-body {
            padding: 2rem;
        }
        .btn-primary {
            background-color: #DA291C;
            border-color: #DA291C;
        }
        .btn-primary:hover {
            background-color: #B71C1C;
            border-color: #B71C1C;
        }
        .form-control:focus {
            border-color: #FFC72C;
            box-shadow: 0 0 0 0.2rem rgba(255, 199, 44, 0.25);
        }
        .card-title {
            color: #DA291C;
            font-weight: bold;
        }
        .mcdo-logo {
            max-width: 100px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/36/McDonald%27s_Golden_Arches.svg/1200px-McDonald%27s_Golden_Arches.svg.png" alt="McDonald's Logo" class="mcdo-logo">
                        </div>
                        <h2 class="card-title text-center mb-4">Admin Login</h2>

                        @if (session('status'))
                            <div class="alert alert-info mb-4">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                <label class="form-check-label" for="remember_me">Remember me</label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center"> 
                                <button type="submit" class="btn btn-primary">Log in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
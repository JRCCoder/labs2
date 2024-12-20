<!DOCTYPE html>
<html>
<head>
    <title>Choose Action - E-Commerce Site</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Press Start 2P', cursive;
            background-color: #5C4A3C ;
            color: #fff;
            margin: 0;
            padding: 150px;
            text-align: center;
            background: url('/images/yayy.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .container {
            margin-top: 50px;
            padding: 50px;
            background-size: cover;
        }
        h1 {
            font-size: 3rem;
            color: #ffd700;
            margin-bottom: 30px;
            background-color: rgba(100, 99, 90, 0.8); /* Semi-transparent background */
            border: 3px solid #333;
            border-radius: 20px;
            box-shadow: 10px 10px 0 rgba(0, 0, 0, 0.2);
            text-shadow: 2px 2px #8b4513;
        }
        .btn {
            font-family: 'Press Start 2P', cursive;
            font-size: 14px;
            padding: 15px 30px;
            border: 3px solid;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
            box-shadow: 2px 2px #ccc;
        }
        .btn-primary {
            background-color: #4e3a2a;
            border-color: #4e3a2a;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #3b2a1c;
            border-color: #3b2a1c;
            color: #f5f5f5;
            box-shadow: 4px 4px 8px #2c1e14;
            transform: scale(1.05);
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: #fff;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
            color: #f5f5f5;
            box-shadow: 4px 4px 8px #4e555b;
            transform: scale(1.05);
        }
        .btn-admin {
            background-color: #8B0000;
            border-color: #8B0000;
            color: #fff;
        }
        .btn-admin:hover {
            background-color: #6B0000;
            border-color: #6B0000;
            color: #f5f5f5;
            box-shadow: 4px 4px 8px #4B0000;
            transform: scale(1.05);
        }
        .d-flex {
            display: flex;
        }
        .justify-content-around {
            justify-content: space-around;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Choose Your Path</h1>
        @guest
            <p>Please login or register to continue shopping.</p>
            <div class="d-flex justify-content-around">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                <a href="{{ route('admin.login') }}" class="btn btn-admin">Admin Login</a>
            </div>
        @else
            <p>Welcome back, {{ Auth::user()->name }}!</p>
            <div class="d-flex justify-content-around">
                <a href="{{ route('products.index') }}" class="btn btn-primary">Continue Shopping</a>
                <a href="{{ route('admin.login') }}" class="btn btn-admin">Admin Login</a>
            </div>
        @endguest
    </div>
</body>
</html>

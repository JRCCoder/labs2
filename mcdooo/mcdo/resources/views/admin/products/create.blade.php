<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product - McDonald's Admin</title>
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #DA291C;
            --secondary-color: #FFC72C;
            --dark-color: #27251F;
            --light-color: #f2f2f2;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--light-color);
            color: var(--dark-color);
        }
        .navbar {
            background-color: var(--primary-color);
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
        h1 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover {
            background-color: #b5231b;
            border-color: #b5231b;
        }
        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: var(--dark-color);
        }
        .btn-secondary:hover {
            background-color: #e6b400;
            border-color: #e6b400;
            color: var(--dark-color);
        }
        .original-price {
            text-decoration: line-through;
            color: red;
            transition: all 0.3s ease;
        }

        .discounted-price {
            color: green;
            font-weight: bold;
            animation: bounce 0.5s;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-hamburger me-2"></i>McDonald's Admin</a>
        </div>
    </nav>

    <div class="container">
        <h1>Create New Product</h1>

        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name:</label>
                <input type="text" id="product_name" name="product_name" class="form-control" value="{{ old('product_name') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="number" id="price" name="price" class="form-control" step="0.01" value="{{ old('price') }}" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock:</label>
                <input type="number" id="stock" name="stock" class="form-control" value="{{ old('stock') }}" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Product Image:</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <div class="mb-3">
                <label for="catalog_id" class="form-label">Catalog:</label>
                <select id="catalog_id" name="catalog_id" class="form-select" required>
                    <option value="">Select a Catalog</option>
                    @foreach($catalogs as $catalog)
                        <option value="{{ $catalog->id }}">{{ $catalog->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="discount_percentage" class="form-label">Discount Percentage:</label>
                <input type="number" id="discount_percentage" name="discount_percentage" class="form-control" step="0.01" value="{{ old('discount_percentage') }}">
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Product</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary ms-2"><i class="fas fa-arrow-left me-2"></i>Back to Products</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap 5.3.3 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

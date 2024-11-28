<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Voucher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">McAdmin</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="mb-4">Create New Voucher</h1>

        <form action="{{ route('admin.vouchers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="code" class="form-label">Voucher Code</label>
                <input type="text" class="form-control" id="code" name="code" required>
            </div>
            <div class="mb-3">
                <label for="discount_amount" class="form-label">Discount Amount</label>
                <input type="number" class="form-control" id="discount_amount" name="discount_amount" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="discount_type" class="form-label">Discount Type</label>
                <select class="form-select" id="discount_type" name="discount_type" required>
                    <option value="fixed">Fixed</option>
                    <option value="percentage">Percentage</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="discount_percentage" class="form-label">Discount Percentage</label>
                <input type="number" class="form-control" id="discount_percentage" name="discount_percentage" step="0.01" min="0" max="100">
            </div>
            <div class="mb-3">
                <label for="valid_from" class="form-label">Valid From</label>
                <input type="date" class="form-control" id="valid_from" name="valid_from" required>
            </div>
            <div class="mb-3">
                <label for="valid_until" class="form-label">Valid Until</label>
                <input type="date" class="form-control" id="valid_until" name="valid_until" required>
            </div>
            <div class="mb-3">
                <label for="usage_limit" class="form-label">Usage Limit</label>
                <input type="number" class="form-control" id="usage_limit" name="usage_limit">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
                <label class="form-check-label" for="is_active">Is Active</label>
            </div>
            <button type="submit" class="btn btn-primary">Create Voucher</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
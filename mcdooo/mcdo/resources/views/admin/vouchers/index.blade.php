<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">McAdmin</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="mb-4">Voucher Management</h1>
        <a href="{{ route('admin.vouchers.create') }}" class="btn btn-primary mb-3">Create New Voucher</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Discount</th>
                    <th>Valid From</th>
                    <th>Valid Until</th>
                    <th>Usage</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vouchers as $voucher)
                <tr>
                    <td>{{ $voucher->code }}</td>
                    <td>{{ $voucher->discount_amount }} {{ $voucher->discount_type === 'percentage' ? '%' : '$' }}</td>
                    <td>{{ $voucher->valid_from->format('Y-m-d') }}</td>
                    <td>{{ $voucher->valid_until->format('Y-m-d') }}</td>
                    <td>{{ $voucher->times_used }} / {{ $voucher->usage_limit ?: 'Unlimited' }}</td>
                    <td>{{ $voucher->is_active ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a href="{{ route('admin.vouchers.edit', $voucher) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.vouchers.destroy', $voucher) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
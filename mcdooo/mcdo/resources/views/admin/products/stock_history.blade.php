<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock History - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Stock History for {{ $product->product_name }}</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Quantity</th>
                    <th>Action</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product->stockHistories as $history)
                    <tr>
                        <td>{{ $history->quantity }}</td>
                        <td>{{ $history->action }}</td>
                        <td>{{ $history->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back to Products</a>
    </div>
</body>
</html>

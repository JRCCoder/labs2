<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Edit Catalog</h1>
        <form action="{{ route('admin.catalogs.update', $catalog->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $catalog->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control">{{ $catalog->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="catalog_id" class="form-label">Catalog:</label>
                <select id="catalog_id" name="catalog_id" class="form-select" required>
                    <option value="">Select a Catalog</option>
                    @foreach($catalogs as $catalog)
                        <option value="{{ $catalog->id }}" {{ $catalog->id == $product->catalog_id ? 'selected' : '' }}>{{ $catalog->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Catalog</button>
        </form>
    </div>
</body>
</html>

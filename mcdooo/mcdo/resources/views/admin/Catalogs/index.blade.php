<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogs - McDonald's Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Catalogs</h1>
        <a href="{{ route('admin.catalogs.create') }}" class="btn btn-primary mb-3">Add New Catalog</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($catalogs as $catalog)
                    <tr>
                        <td>{{ $catalog->name }}</td>
                        <td>{{ $catalog->description }}</td>
                        <td>
                            <a href="{{ route('admin.catalogs.edit', $catalog->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.catalogs.destroy', $catalog->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

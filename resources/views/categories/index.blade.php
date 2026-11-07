<!DOCTYPE html>
<html>
<head>
    <title>Manage Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Categories</h2>

        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            Add Category
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.categories.show', $category->id) }}"
                           class="btn btn-info btn-sm">View</a>

                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                           class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('admin.categories.destroy', $category->id) }}"
                              method="POST" class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this category?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $categories->links() }}

</div>

</body>
</html>
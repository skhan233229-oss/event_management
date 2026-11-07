<!DOCTYPE html>
<html>
<head>
    <title>Category Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4">Category Details</h2>

    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mb-3">
        Back
    </a>

    <div class="card mb-4">
        <div class="card-body">
            <h4>{{ $category->name }}</h4>
            <p>{{ $category->description ?? 'No description available.' }}</p>
        </div>
    </div>

    <h4>Related Events</h4>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Event Name</th>
                <th>Venue</th>
                <th>Event Date</th>
            </tr>
        </thead>

        <tbody>
            @forelse($category->events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->venue }}</td>
                    <td>{{ $event->event_date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">
                        No events assigned to this category.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

</body>
</html>
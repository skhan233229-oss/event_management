<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Events</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6fb;
            font-family: Arial, sans-serif;
        }

        .main-card {
            border: none;
            border-radius: 12px;
        }

        .table th {
            background: #1e293b;
            color: white;
            white-space: nowrap;
        }

        .table td {
            vertical-align: middle;
        }

        .page-title {
            color: #1e293b;
            font-weight: bold;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
            Mini Event Management
        </a>

        <span class="text-white">
            Admin: {{ auth()->user()->name }}
        </span>
    </div>
</nav>

<div class="container py-5">

    <div class="card main-card shadow-sm">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                <div>
                    <h2 class="page-title mb-1">Manage Events</h2>
                    <p class="text-muted mb-0">Add, edit and manage all events.</p>
                </div>

                <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                    + Add New Event
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div id="ajaxMessage" class="alert" style="display:none;"></div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Event Title</th>
                            <th>Category</th>
                            <th>Venue</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Capacity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($events as $event)
                            <tr id="event-row-{{ $event->id }}">

                                <td>{{ $event->id }}</td>

                                <td class="fw-semibold">
                                    {{ $event->title }}
                                </td>

                                <td>
                                    {{ $event->category->name ?? 'No Category' }}
                                </td>

                                <td>{{ $event->venue }}</td>

                                <td>{{ $event->event_date }}</td>

                                <td>{{ $event->event_time }}</td>

                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $event->capacity }}
                                    </span>
                                </td>

                                <td>
                                    <div class="d-flex gap-2">

                                        <a href="{{ route('admin.events.edit', $event->id) }}"
                                           class="btn btn-sm btn-warning">
                                            Edit
                                        </a>

                                        <form class="ajax-delete"
                                              action="{{ route('admin.events.destroy', $event->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Delete
                                            </button>

                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    No events found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <div class="mt-3">
                {{ $events->links() }}
            </div>

            <a href="{{ route('admin.dashboard') }}" class="btn btn-dark mt-3">
                ← Back to Admin Dashboard
            </a>

        </div>
    </div>

    <div class="text-center text-muted mt-4">
        Mini Event Management System © 2026
    </div>

</div>

<script>
    document.querySelectorAll('.ajax-delete').forEach(form => {

        form.addEventListener('submit', function(e) {

            e.preventDefault();

            if (!confirm('Are you sure you want to delete this event?')) {
                return;
            }

            const row = form.closest('tr');
            const message = document.getElementById('ajaxMessage');

            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Unable to delete event.');
                }

                return response.json();
            })
            .then(data => {

                if (data.success) {
                    row.remove();

                    message.style.display = 'block';
                    message.className = 'alert alert-success';
                    message.textContent = data.message;

                } else {
                    throw new Error(data.message || 'Delete failed.');
                }

            })
            .catch(error => {
                message.style.display = 'block';
                message.className = 'alert alert-danger';
                message.textContent = error.message;
            });

        });

    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
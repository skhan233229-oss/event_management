<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Manage Registrations</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6fb;
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

<!-- Navbar -->
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

            <h2 class="page-title mb-2">
                Manage Registrations
            </h2>

            <p class="text-muted">
                View and search all event registrations.
            </p>


            <!-- Search Form -->
            <form action="{{ route('admin.registrations.index') }}"
                  method="GET"
                  class="row g-2 mb-4">

                <div class="col-md-5">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search user or event..."
                        value="{{ request('search') }}"
                    >

                </div>

                <div class="col-auto">

                    <button type="submit" class="btn btn-primary">
                        Search
                    </button>

                </div>

                <div class="col-auto">

                    <a href="{{ route('admin.registrations.index') }}"
                       class="btn btn-secondary">
                        Clear
                    </a>

                </div>

            </form>


            <!-- Registration Table -->
            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Event Name</th>
                            <th>Venue</th>
                            <th>Event Date</th>
                            <th>Status</th>
                            <th>Registration Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($registrations as $registration)

                            <tr>

                                <td>{{ $registration->id }}</td>

                                <td class="fw-semibold">
                                    {{ $registration->user->name ?? 'User deleted' }}
                                </td>

                                <td>
                                    {{ $registration->user->email ?? '-' }}
                                </td>

                                <td class="fw-semibold">
                                    {{ $registration->event->title ?? 'Event deleted' }}
                                </td>

                                <td>
                                    {{ $registration->event->venue ?? '-' }}
                                </td>

                                <td>
                                    {{ $registration->event->event_date ?? '-' }}
                                </td>

                                <td>

                                    @if($registration->status === 'registered')

                                        <span class="badge bg-success">
                                            Registered
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            {{ ucfirst($registration->status) }}
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    {{ $registration->created_at->format('d-m-Y') }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8"
                                    class="text-center text-muted py-4">
                                    No registrations found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <!-- Pagination -->
            <div class="mt-3">
                {{ $registrations->links() }}
            </div>


            <a href="{{ route('admin.dashboard') }}"
               class="btn btn-dark mt-3">
                ← Back to Admin Dashboard
            </a>

        </div>

    </div>


    <div class="text-center text-muted mt-4">
        Mini Event Management System © 2026
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
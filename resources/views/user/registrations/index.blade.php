<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>My Registrations - Mini Event Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('events.index') }}">
            Mini Event Management
        </a>

        <div class="d-flex align-items-center gap-3">
            <span class="text-white">
                Hi, {{ auth()->user()->name }}
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container py-5">

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

                <div>
                    <h2 class="fw-bold mb-1">My Registrations</h2>
                    <p class="text-muted mb-0">
                        View and manage your registered events.
                    </p>
                </div>

                <a href="{{ route('events.index') }}" class="btn btn-primary">
                    Browse Events
                </a>

            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}

                    <button type="button" class="btn-close"
                            data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Error Message -->
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}

                    <button type="button" class="btn-close"
                            data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Registrations Table -->
            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>Event Name</th>
                            <th>Venue</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($registrations as $registration)

                            <tr>
                                <td class="fw-semibold">
                                    {{ $registration->event->title }}
                                </td>

                                <td>
                                    {{ $registration->event->venue }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($registration->event->event_date)->format('d-m-Y') }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($registration->event->event_time)->format('h:i A') }}
                                </td>

                                <td>
                                    <span class="badge bg-success">
                                        {{ ucfirst($registration->status) }}
                                    </span>
                                </td>

                                <td>
                                    <form action="{{ route('registrations.cancel', $registration->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to cancel this registration?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Cancel
                                        </button>

                                    </form>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    You have not registered for any events.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $registrations->links() }}
            </div>

            <a href="{{ route('events.index') }}" class="btn btn-outline-secondary mt-3">
                ← Back to Events
            </a>

        </div>
    </div>

</div>

<footer class="text-center text-muted py-4">
    © 2026 Mini Event Management System
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
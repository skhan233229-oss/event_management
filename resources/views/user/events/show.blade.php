<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Event Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6fb;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #1e293b;
        }

        .event-card {
            border: none;
            border-radius: 14px;
        }

        .event-title {
            color: #2563eb;
            font-weight: bold;
        }

        .event-info {
            padding: 12px;
            background: #f8fafc;
            border-radius: 8px;
            margin-bottom: 12px;
        }

        .seat-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 18px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('events.index') }}">
            Mini Event Management
        </a>

        <div class="d-flex align-items-center gap-2">

            @auth
                <span class="text-white">
                    Hi, {{ auth()->user()->name }}
                </span>

                <a href="{{ route('my.registrations') }}"
                   class="btn btn-outline-light btn-sm">
                    My Registrations
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
                    Login
                </a>
            @endauth

        </div>
    </div>
</nav>

<div class="container py-5">

    <div class="card event-card shadow-sm">

        <div class="card-body p-4 p-md-5">

            <h1 class="event-title mb-3">
                {{ $event->title }}
            </h1>

            <p class="text-muted mb-4">
                {{ $event->description }}
            </p>

            <hr>

            <h5 class="fw-bold mb-3">Event Information</h5>

            <div class="row">

                <div class="col-md-6">
                    <div class="event-info">
                        <strong>Venue:</strong>
                        {{ $event->venue }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="event-info">
                        <strong>Date:</strong>
                        {{ $event->event_date }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="event-info">
                        <strong>Time:</strong>
                        {{ $event->event_time }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="event-info">
                        <strong>Total Capacity:</strong>
                        {{ $event->capacity }}
                    </div>
                </div>

            </div>

            @php
                $registeredCount = $event->registrations()
                    ->where('status', 'registered')
                    ->count();

                $availableSeats = max(0, $event->capacity - $registeredCount);

                $alreadyRegistered = auth()->check()
                    ? $event->registrations()
                        ->where('user_id', auth()->id())
                        ->where('status', 'registered')
                        ->exists()
                    : false;
            @endphp

            <div class="seat-box mt-3 mb-4">

                <h5 class="fw-bold mb-2">Seat Availability</h5>

                <h3 class="text-primary mb-0">
                    {{ $availableSeats }}
                    <small class="fs-6 text-muted">Seats Available</small>
                </h3>

            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @auth

                @if($alreadyRegistered)

                    <div class="alert alert-success fw-semibold">
                        ✓ Already Registered
                    </div>

                @elseif($availableSeats <= 0)

                    <div class="alert alert-danger fw-semibold">
                        Event Full
                    </div>

                @else

                    <form action="{{ route('events.register', $event->id) }}"
                          method="POST">

                        @csrf

                        <button type="submit" class="btn btn-success btn-lg">
                            Register for Event
                        </button>

                    </form>

                @endif

            @else

                @if($availableSeats <= 0)

                    <div class="alert alert-danger fw-semibold">
                        Event Full
                    </div>

                @else

                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                        Login to Register
                    </a>

                @endif

            @endauth

            <hr class="my-4">

            <a href="{{ route('events.index') }}" class="btn btn-dark">
                ← Back to Events
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
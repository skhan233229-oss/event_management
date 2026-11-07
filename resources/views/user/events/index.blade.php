<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Upcoming Events</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6fb;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #1e293b;
        }

        .hero-section {
            background: linear-gradient(120deg, #2563eb, #4f46e5);
            color: white;
            padding: 35px;
            border-radius: 12px;
            margin-top: 30px;
        }

        .event-card {
            border: none;
            border-radius: 12px;
            height: 100%;
            transition: 0.3s;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }

        .event-title {
            color: #2563eb;
            font-weight: bold;
        }

        .search-box {
            max-width: 500px;
        }

        .event-info {
            color: #555;
            margin-bottom: 8px;
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

                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                    Register
                </a>
            @endauth

        </div>
    </div>
</nav>

<div class="container">

    <div class="hero-section">
        <h1 class="fw-bold">Upcoming Events</h1>
        <p class="mb-0">
            Discover events, explore details and register for your favourite events.
        </p>
    </div>

    <div class="mt-4 mb-4">

        <input
            type="text"
            id="search"
            class="form-control form-control-lg search-box shadow-sm"
            placeholder="Search events by title, venue..."
            autocomplete="off"
        >

    </div>

    <div id="eventResults" class="row g-4">

        @forelse($events as $event)

            <div class="col-md-6 col-lg-4">

                <div class="card event-card shadow-sm">

                    <div class="card-body p-4">

                        <h4 class="event-title">
                            {{ $event->title }}
                        </h4>

                        <p class="text-muted">
                            {{ $event->description }}
                        </p>

                        <hr>

                        <p class="event-info">
                            <strong>Venue:</strong> {{ $event->venue }}
                        </p>

                        <p class="event-info">
                            <strong>Date:</strong> {{ $event->event_date }}
                        </p>

                        <p class="event-info">
                            <strong>Time:</strong> {{ $event->event_time }}
                        </p>

                        <p class="event-info">
                            <strong>Capacity:</strong> {{ $event->capacity }}
                        </p>

                        <a href="{{ route('events.show', $event->id) }}"
                           class="btn btn-primary w-100 mt-2">
                            View Details →
                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">
                <div class="alert alert-info">
                    No upcoming events available.
                </div>
            </div>

        @endforelse

    </div>

    <div id="pagination" class="mt-4">
        {{ $events->links() }}
    </div>

    <div class="text-center text-muted mt-5 mb-4">
        Mini Event Management System © 2026
    </div>

</div>

<script>
    const searchInput = document.getElementById('search');
    const eventResults = document.getElementById('eventResults');
    const pagination = document.getElementById('pagination');

    let searchTimer;

    searchInput.addEventListener('input', function () {

        clearTimeout(searchTimer);

        const search = this.value.trim();

        searchTimer = setTimeout(function () {

            fetch("{{ route('events.search') }}?search=" + encodeURIComponent(search))
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Search request failed');
                    }

                    return response.json();
                })
                .then(events => {

                    eventResults.innerHTML = '';
                    pagination.style.display = 'none';

                    if (events.length === 0) {
                        const message = document.createElement('div');
                        message.className = 'col-12 alert alert-info';
                        message.textContent = 'No events found.';
                        eventResults.appendChild(message);
                        return;
                    }

                    events.forEach(event => {

                        const column = document.createElement('div');
                        column.className = 'col-md-6 col-lg-4';

                        const card = document.createElement('div');
                        card.className = 'card event-card shadow-sm';

                        const body = document.createElement('div');
                        body.className = 'card-body p-4';

                        const title = document.createElement('h4');
                        title.className = 'event-title';
                        title.textContent = event.title;

                        const description = document.createElement('p');
                        description.className = 'text-muted';
                        description.textContent = event.description || '';

                        const hr = document.createElement('hr');

                        const venue = document.createElement('p');
                        venue.className = 'event-info';
                        venue.textContent = 'Venue: ' + (event.venue || '');

                        const date = document.createElement('p');
                        date.className = 'event-info';
                        date.textContent = 'Date: ' + (event.event_date || '');

                        const time = document.createElement('p');
                        time.className = 'event-info';
                        time.textContent = 'Time: ' + (event.event_time || '');

                        const capacity = document.createElement('p');
                        capacity.className = 'event-info';
                        capacity.textContent = 'Capacity: ' + event.capacity;

                        const link = document.createElement('a');
                        link.href = '/events/' + event.id;
                        link.className = 'btn btn-primary w-100 mt-2';
                        link.textContent = 'View Details →';

                        body.append(
                            title,
                            description,
                            hr,
                            venue,
                            date,
                            time,
                            capacity,
                            link
                        );

                        card.appendChild(body);
                        column.appendChild(card);
                        eventResults.appendChild(column);

                    });

                })
                .catch(error => {

                    eventResults.innerHTML = '';

                    const message = document.createElement('div');
                    message.className = 'col-12 alert alert-danger';
                    message.textContent = 'Something went wrong. Please try again.';

                    eventResults.appendChild(message);

                    console.error(error);
                });

        }, 300);

    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
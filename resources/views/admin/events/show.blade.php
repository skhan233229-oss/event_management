<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">

<div class="container py-5">

    <h2 class="mb-4">Event Details</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <h4>{{ $event->title }}</h4>
            <p><strong>Category:</strong> {{ $event->category->name ?? 'No Category' }}</p>
            <p><strong>Venue:</strong> {{ $event->venue }}</p>
            <p><strong>Date:</strong> {{ $event->event_date }}</p>
            <p><strong>Time:</strong> {{ $event->event_time }}</p>
            <p><strong>Capacity:</strong> {{ $event->capacity }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">

            <h4 class="mb-3">Add Ticket</h4>

            <form action="{{ route('admin.events.tickets.store', $event->id) }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Ticket Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" min="0" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control" min="1" required>
                </div>

                <button type="submit" class="btn btn-primary">Add Ticket</button>

            </form>

        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <h4 class="mb-3">Available Tickets (Vue.js)</h4>

            <div
                id="ticket-list"
                data-tickets="{{ $event->tickets->values()->toJson() }}">
            </div>

        </div>
    </div>

    <a href="{{ route('admin.events.index') }}" class="btn btn-dark mt-3">
        Back to Events
    </a>

</div>

</body>
</html>
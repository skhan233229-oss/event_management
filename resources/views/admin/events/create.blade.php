<!DOCTYPE html>
<html>
<head>
    <title>Add New Event</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
        }

        h1 {
            color: #333;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin-top: 20px;
            padding: 12px 20px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        .back {
            display: inline-block;
            margin-top: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Add New Event</h1>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p class="error">{{ $error }}</p>
        @endforeach
    @endif

    <form action="{{ route('admin.events.store') }}" method="POST">

        @csrf

        <label>Event Title</label>
        <input type="text" name="title" value="{{ old('title') }}" required>

        <label>Description</label>
        <textarea name="description" rows="4" required>{{ old('description') }}</textarea>

        <label>Venue</label>
        <input type="text" name="venue" value="{{ old('venue') }}" required>

        <label>Event Date</label>
        <input type="date" name="event_date" value="{{ old('event_date') }}" required>

        <label>Event Time</label>
        <input type="time" name="event_time" value="{{ old('event_time') }}" required>

        <label>Capacity</label>
        <input type="number" name="capacity" min="1" value="{{ old('capacity') }}" required>

        <label>Category</label>
        <select name="category_id">
            <option value="">Select Category</option>

            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button type="submit">Save Event</button>

    </form>

    <a href="{{ route('admin.events.index') }}" class="back">← Back to Events</a>

</div>

</body>
</html>
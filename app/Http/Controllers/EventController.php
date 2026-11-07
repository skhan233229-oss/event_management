<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('category')->latest()->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'venue' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'capacity' => 'required|integer|min:1',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $validated['created_by'] = auth()->id();

        Event::create($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully!');
    }

    public function show(Event $event)
    {
        $event->load('category', 'tickets');

        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'venue' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'capacity' => 'required|integer|min:1',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $event->update($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully!');
    }

    // AJAX + Normal Event Delete
    public function destroy(Event $event)
    {
        $event->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Event deleted successfully!'
            ]);
        }

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully!');
    }
}
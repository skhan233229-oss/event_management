<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class UserEventController extends Controller
{
    // Show all upcoming events
    public function index()
    {
        $events = Event::whereDate('event_date', '>=', today())
            ->orderBy('event_date', 'asc')
            ->paginate(10);

        return view('user.events.index', compact('events'));
    }

    // Show single event details
    public function show(Event $event)
    {
        return view('user.events.show', compact('event'));
    }

    // AJAX Event Search
    public function search(Request $request)
    {
        $search = $request->search;

        $events = Event::whereDate('event_date', '>=', today())
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('venue', 'like', "%{$search}%");
            })
            ->orderBy('event_date', 'asc')
            ->get();

        return response()->json($events);
    }
}
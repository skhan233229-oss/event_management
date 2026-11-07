<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        $validated['event_id'] = $event->id;

        Ticket::create($validated);

        return redirect()
            ->route('admin.events.show', $event->id)
            ->with('success', 'Ticket added successfully!');
    }
}
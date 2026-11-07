<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    // Register user for an event
    public function register(Event $event)
    {
        $alreadyRegistered = Registration::where('user_id', auth()->id())
            ->where('event_id', $event->id)
            ->exists();

        if ($alreadyRegistered) {
            return back()->with('error', 'You are already registered for this event.');
        }

        $result = DB::transaction(function () use ($event) {

            $lockedEvent = Event::where('id', $event->id)
                ->lockForUpdate()
                ->firstOrFail();

            $registeredCount = Registration::where('event_id', $lockedEvent->id)
                ->where('status', 'registered')
                ->count();

            if ($registeredCount >= $lockedEvent->capacity) {
                return false;
            }

            Registration::create([
                'user_id' => auth()->id(),
                'event_id' => $lockedEvent->id,
                'status' => 'registered',
            ]);

            return true;
        });

        if (!$result) {
            return back()->with('error', 'Sorry, this event is full.');
        }

        return back()->with('success', 'Event registration successful!');
    }

    // Show user's registrations
    public function myRegistrations()
    {
        $registrations = Registration::with('event')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.registrations.index', compact('registrations'));
    }

    // Cancel registration
    public function cancel(Registration $registration)
    {
        abort_unless($registration->user_id === auth()->id(), 403);

        $registration->delete();

        return redirect()->route('my.registrations')
            ->with('success', 'Registration cancelled successfully!');
    }
}
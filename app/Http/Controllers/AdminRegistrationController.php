<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class AdminRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = Registration::with(['user', 'event'])->latest();

        // Search by user name or event title
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })->orWhereHas('event', function ($eventQuery) use ($search) {
                    $eventQuery->where('title', 'like', "%{$search}%");
                });
            });
        }

        $registrations = $query->paginate(10)->withQueryString();

        return view('admin.registrations.index', compact('registrations'));
    }
}
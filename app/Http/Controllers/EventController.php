<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // Show all events
    public function index()
    {
        $events = Event::with('cafe')->get();
        return view('events.index', compact('events'));
    }

    // Show form to create a new event for a specific cafe
    public function create(Cafe $cafe)
    {
        return view('events.create', compact('cafe'));
    }

    // Store a new event in the database
    public function store(Request $request, Cafe $cafe)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_description' => 'required|string',
            'event_date' => 'required|date',
        ]);

        $event = new Event();
        $event->cafe_id = $cafe->cafe_id; // Use cafe from model binding
        $event->event_name = $request->event_name;
        $event->event_description = $request->event_description;
        $event->event_date = $request->event_date;
        $event->save();

        return redirect()->route('events.manage', $cafe->cafe_id)->with('success', 'Event created successfully.');
    }

    // Show form to edit an existing event
    public function edit(Cafe $cafe, Event $event)
    {
        return view('events.edit', compact('cafe', 'event'));
    }

    // Update an existing event
    public function update(Request $request, Cafe $cafe, Event $event)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_description' => 'required|string',
            'event_date' => 'required|date',
        ]);

        $event->update([
            'event_name' => $request->event_name,
            'event_description' => $request->event_description,
            'event_date' => $request->event_date,
        ]);

        return redirect()->route('events.manage', $cafe->cafe_id)->with('success', 'Event updated successfully.');
    }

    // Delete an event
    public function destroy(Cafe $cafe, Event $event)
    {
        $event->delete();

        return redirect()->route('events.manage', $cafe->cafe_id)->with('success', 'Event deleted successfully.');
    }

    // Show a specific event
    public function show(Cafe $cafe, Event $event)
    {
        return view('events.show', compact('cafe', 'event'));
    }

    // Manage events for a specific cafe
    public function manage(Cafe $cafe)
    {
        $events = Event::where('cafe_id', $cafe->cafe_id)->get();
        return view('events.manage', compact('cafe', 'events'));
    }
}

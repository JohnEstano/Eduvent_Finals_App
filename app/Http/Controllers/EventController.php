<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('event.showEvent');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('event.createEvent');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'status' => 'required|string',
            'description' => 'required|string|max:500',
        ]);


        $event = Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
            'requirement' => $request->requirement,
            'created_by' => auth()->id(),
        ]);

        $events = Event::all();


        return view('event.showEvent', compact('events'));
    }
    /**
     * Display the specified resource.
     */
    public function show()
    {
        // Fetch all events
        $events = Event::all();



        // Return the data to the view
        return view('event.showEvent', compact('events'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $event = Event::findOrFail($id);


        return view('event.editEvent', compact('event'));
    }
    /**
     * Update the specified resource in storage.
     */

    public function showeventsToday()
    {
        $today = Carbon::today();

       
        $events = Event::whereDate('date', $today)
            ->where('status', 'Open')
            ->get();
         
        
        return view('layouts.contents.onlyevents-today', compact('events'));
    }

    public function update(Request $request, string $id)
    {
        // Validate the input data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'status' => 'required|string',
            'description' => 'required|string|max:500',
            'requirement' => 'nullable|string|max:500', // Assuming 'requirement' can be nullable
        ]);

        // Retrieve the event
        $event = Event::findOrFail($id); // Correctly find the event by ID

        // Update the event using the validated data
        $event->update($data); // Use the validated data to update the event

        // Redirect after update
        return redirect()->route('events.show')->with('success', 'Event updated successfully!');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $event = Event::findOrFail($id);


        $event->delete();

        return redirect()->route('events.show')->with('success', 'Event deleted successfully.');
    }
}

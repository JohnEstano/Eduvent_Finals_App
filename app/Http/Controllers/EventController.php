<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Attendance;

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
            'requirement' => 'nullable|string|max:500', // Optional validation for 'requirement'
        ]);
    
        // Create the event
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
    
        // Fetch data for the view
        $allEvents = Event::all();
        $userEvents = Event::where('created_by', auth()->id())->get();
    
        // Return the view with the necessary data
        return view('event.showEvent', compact('allEvents', 'userEvents'));
    }
    /**
     * Display the specified resource.
     */
    public function show()
{
    // Fetch all events
    $allEvents = Event::all();

    // Fetch events created by the authenticated user
    $userEvents = Event::where('created_by', auth()->id())->get();

    // Return the data to the view
    return view('event.showEvent', compact('allEvents', 'userEvents'));
}

public function welcome()
{
    // Fetch events where the date is in the future
    $upcomingEvents = Event::where('date', '>=', now())
        ->orderBy('date', 'asc')
        ->take(5) // Limit to 5 events
        ->get();

    // Pass the data to the welcome view
    return view('welcome', compact('upcomingEvents'));
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

    public function showUserEvents()
    {
        $user = Auth::user(); // Get the authenticated user
        $today = Carbon::today(); // Get today's date
    
        // Exclude upcoming events (tomorrow, next day, etc.)
        $events = Event::whereDate('date', '<', $today)
            ->where('status', 'Open') // Optional: filter by events with 'Open' status
            ->get();
    
        // Check attendance for each event
        $eventsWithStatus = $events->map(function ($event) use ($user) {
            // Check if the user has attended the event
            $attendance = Attendance::where('event_name', $event->name)
                ->where('user_id', $user->id)
                ->whereDate('timein', '<=', Carbon::today())
                ->first();
    
            // Mark as attended if record exists, otherwise missed
            $event->status = $attendance ? 'attended' : 'missed';
    
            return $event;
        });
    
        // Pass the correct variable to the view
        return view('layouts.contents.showuserevents', compact('eventsWithStatus'));
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

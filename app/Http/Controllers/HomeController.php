<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\carbon;
use App\Models\Event;

use App\Models\Attendance;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Get the authenticated user
        $today = Carbon::today(); // Get today's date
        $now = Carbon::now(); // Current time to check if event is ongoing or ended
    
        // Past events: Events before today, ordered by date (most recent first)
        $pastEvents = Event::whereDate('date', '<', $today)
            ->where('status', 'Open')
            ->orderBy('date', 'desc')
            ->get();
    
        // Upcoming events: Events after today, ordered by date (most recent first)
        $upcomingEvents = Event::whereDate('date', '>=', $today)
            ->where('status', 'Open')
            ->orderBy('date', 'asc')
            ->get();
    
        // Check if there's any event happening today
        $ongoingEvent = Event::whereDate('date', '=', $today)
            ->where('status', 'Open')
            ->first(); // Get the first event that matches today
    
        // Check if the ongoing event has ended
        $endedEvent = null;
        if ($ongoingEvent && Carbon::parse($ongoingEvent->end_time)->lt($now)) {
            $endedEvent = $ongoingEvent;
        }
    
        // Check attendance for each past event
        $pastEventsWithStatus = $pastEvents->map(function ($event) use ($user) {
            $attendance = Attendance::where('event_name', $event->name)
                ->where('user_id', $user->id)
                ->whereDate('time_in', '<=', Carbon::today())
                ->first();
    
            // Mark as attended or missed
            $event->status = $attendance ? 'attended' : 'missed';
    
            return $event;
        });
    
        // Count attended and missed events
        $attendedCount = $pastEventsWithStatus->where('status', 'attended')->count();
        $missedCount = $pastEventsWithStatus->where('status', 'missed')->count();
    
        // Pass the ongoing event status to the view
        if ($user->role == 'student') {
            return view('homepage.student', compact('pastEventsWithStatus', 'upcomingEvents', 'attendedCount', 'missedCount', 'ongoingEvent', 'endedEvent'));
        } else {
            return view('homepage.admin' , compact('pastEventsWithStatus', 'upcomingEvents', 'attendedCount', 'missedCount', 'ongoingEvent', 'endedEvent'));
        }
    }
    


}


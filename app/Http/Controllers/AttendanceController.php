<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\carbon;
use App\Models\Event;
use App\Processors\TimeInProcessor;
use App\Processors\TimeOutProcessor;



class AttendanceController extends Controller
{
   

    public function index(Request $request)
    {
        // Fetch all events created by the authenticated user
        $userEvents = Event::where('created_by', auth()->id())->get();
        
        // If an event is selected, filter attendance records for that event
        $attendances = collect(); // Initialize as an empty collection
        if ($request->has('event_name') && $request->event_name) {
            // Get attendance records for the selected event by event_name
            $attendances = Attendance::where('event_name', $request->event_name)->paginate(10);
            
            // Convert time_in and time_out to 12-hour format
            foreach ($attendances as $attendance) {
                $attendance->time_in = Carbon::parse($attendance->time_in)->format('g:i A'); // 12-hour format with AM/PM
                $attendance->time_out = Carbon::parse($attendance->time_out)->format('g:i A');
            }
        }
    
        // Return the data to the view
        return view('attendance.showAttendance', compact('userEvents', 'attendances'));
    }
    
    
    

    public function today()
    {
        // Set today's date and current time in the correct timezone
        $today = Carbon::today('Asia/Manila');
        $currentTime = Carbon::now('Asia/Manila');
    
        // Fetch events for today with an "Open" status
        $events = Event::whereDate('date', $today)
            ->where('status', 'Open')
            ->get();
    
        // Add status and attendance info to each event
        $events = $events->map(function ($event) use ($currentTime) {
            $startTime = Carbon::parse($event->start_time, 'Asia/Manila');
            $endTime = Carbon::parse($event->end_time, 'Asia/Manila');
    
            // Determine event status
            if ($currentTime->between($startTime, $endTime)) {
                $event->status = 'Ongoing';
            } elseif ($currentTime->lt($startTime)) {
                $event->status = 'Starting Soon';
            } elseif ($currentTime->gt($endTime)) {
                $event->status = 'Event Ended';
            } else {
                $event->status = 'Unknown';
            }
    
            // Check if the authenticated user has a time_in and time_out record for this event
            $event->user_has_time_in = Attendance::where('event_name', $event->name)
                ->where('user_id', auth()->id())
                ->whereNotNull('time_in')
                ->exists();
    
            $event->user_has_time_out = Attendance::where('event_name', $event->name)
                ->where('user_id', auth()->id())
                ->whereNotNull('time_out')
                ->exists();
    
            return $event;
        });
    
        return view('attendance.today', compact('events'));
    }

    public function create()
    {
        $users = User::all();
        return view('attendance.recordAttendance', compact('users'));
    }

    
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'event_name' => 'required|exists:events,name',
            'user_id' => 'required|exists:users,id',
            'location' => 'required|string',
            'timein_photo' => 'nullable|string',
            'timeout_photo' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);
    
        $attendance = Attendance::where('event_name', $validated['event_name'])
                                 ->where('user_id', $validated['user_id'])
                                 ->whereNull('time_out')
                                 ->first();
    
        if ($attendance) {
            // Use TimeOutProcessor
            $processor = new TimeOutProcessor();
            $processor->process($attendance, $request);
    
            return redirect()->route('attendanceToday')->with('success', 'Recorded Successfully!');
        } else {
            // Use TimeInProcessor
            $attendance = new Attendance($validated);
            $processor = new TimeInProcessor();
            $processor->process($attendance, $request);
    
            return redirect()->route('attendanceToday')->with('success', 'Recorded Successfully!');
        }
    }
    
    
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\carbon;
use App\Models\Event;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::paginate(10);
        return view('attendance.showAttendance', compact('attendances'));
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

            // Check if the authenticated user has a time_in record for this event
            $event->user_has_time_in = Attendance::where('event_name', $event->name)
                ->where('user_id', auth()->id())
                ->whereNotNull('time_in')
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
            'timein_photo' => 'nullable|image',
            'time_in' => 'required|date_format:H:i',  // Ensure proper time format
            'remarks' => 'nullable|string',
            'status' => 'required|in:Present,Absent,Late,Excused',
        ]);
        
        // Save the data into the database
        $attendance = new Attendance();
        $attendance->event_name = $validated['event_name'];
        $attendance->user_id = $validated['user_id'];
        $attendance->location = $validated['location'];
        
        // Format time_in as HH:MM:SS to match the MySQL TIME format
        $attendance->time_in = date('H:i:s', strtotime($validated['time_in']));  // Append seconds
        
        $attendance->remarks = $validated['remarks'] ?? null;
        $attendance->status = $validated['status'];
        
        // Handle the photo upload (if applicable)
        if ($request->hasFile('timein_photo')) {
            $path = $request->file('timein_photo')->store('public/photos');
            $attendance->timein_photo = $path;
        }
        
        // Save the attendance record
        $attendance->save();
        
        // Redirect or return a success response
        return redirect()->route('attendanceToday')->with('success', 'Attendance recorded successfully!');
    }
    
    
    
    
}

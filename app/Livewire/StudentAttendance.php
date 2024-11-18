<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Event; 

class StudentAttendance extends Component
{
    public $events;

    public function mount()
    {
        
        $today = Carbon::today();

        
        $this->events = Event::whereDate('event_date', $today)
                             ->where('status', 'open')
                             ->get();
    }

    public function render()
    {
        return view('livewire.student-attendance');
    }

    public function markAttendance($eventId)
{
    $user = auth()->user(); 
    $event = Event::find($eventId); 

    

    
    $attendance = $user->attendances()->create([
        'event_id' => $event->id,
        'time_in' => now(),
        'status' => 'on time',
        'location' => $user->location, 
        'time_in_photo' => 'path_to_photo', 
    ]);

  
    
    session()->flash('message', 'Attendance marked successfully!');
}
}

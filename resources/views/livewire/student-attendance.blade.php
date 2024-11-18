<div>
    <h2>Today's Events</h2>

    @if($events->isEmpty())
        <p>No events available today.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->name }}</td>
                        <td>
                            <button wire:click="markAttendance({{ $event->id }})" class="btn btn-primary">
                                Mark Attendance
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
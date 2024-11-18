<table class="table">
    <thead>
        <tr>
            <th>User</th>
            <th>Event</th>
            <th>Time In</th>
            <th>Time Out</th>
            <th>Status</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($attendances as $attendance)
            <tr>
                <td>{{ $attendance->user->name }}</td>
                <td>{{ $attendance->event_name }}</td>
                <td>{{ $attendance->time_in }}</td>
                <td>{{ $attendance->time_out }}</td>
                <td>{{ $attendance->status }}</td>
                <td>{{ $attendance->location }}</td>
                <td>
                 
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $attendances->links() }}

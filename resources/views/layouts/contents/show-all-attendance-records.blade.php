<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<div class="">
    <!-- Dropdown to select event -->
    <form method="GET" action="{{ route('attendances.index') }}">
        <div class="mb-4">
            <label for="event_name" class="block text-sm font-medium text-gray-700">Select Event</label>
            <select id="event_name" name="event_name"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#FF2D20] focus:border-[#FF2D20] sm:text-sm">
                <option value="">Select an Event</option>
                @foreach ($userEvents as $event)
                    <option value="{{ $event->name }}" {{ request('event_name') == $event->name ? 'selected' : '' }}>
                        {{ $event->name }} ({{ $event->date }})
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="px-4 py-2 text-white bg-dark rounded-md">Show Submissions</button>
    </form>

    <!-- Attendance Count -->
    @if ($attendances && $attendances->isNotEmpty())
    <p class="mt-4 text-lg font-medium">Total Users Attended: {{ $attendances->count() }}</p>

    <!-- Attendance Records Table -->
    <table class="table mt-6">
        <thead>
            <tr>
                <th>User</th>
                <th>Event</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Status</th>
                <th>Location</th>
                <th>Time In Photo</th>
                <th>Time Out Photo</th>
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
                        @if ($attendance->timein_photo)
                            <img src="{{ $attendance->timein_photo }}" alt="Time In Photo"
                                class="w-20 h-20 object-cover cursor-pointer" onclick="openModal(this)">
                        @else
                            No Photo
                        @endif
                    </td>
                    <td>
                        @if ($attendance->timeout_photo)
                            <img src="{{ $attendance->timeout_photo }}" alt="Time Out Photo"
                                class="w-20 h-20 object-cover cursor-pointer" onclick="openModal(this)">
                        @else
                            No Photo
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $attendances->links() }}
@else
    <p class="mt-4 text-gray-500">No attendance records available. Please select an event.</p>
@endif
</div>

<div class="text-center">
    <button id="printButton" class="btn btn-dark mt-4 mb-5">Print to PDF</button>
</div>


<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <!-- Close Button -->
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Image in the Modal -->
          <img id="modalImage" class="w-100" alt="Full Screen Image">
        </div>
      </div>
    </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script>
    // Function to open the modal with the clicked image
    function openModal(imgElement) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imgElement.src; // Set modal image source to the clicked image
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show(); // Show the modal
    }
</script>

<script>
    // Function to generate PDF with styled content
    document.getElementById("printButton").addEventListener("click", function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        
        // Add a title to the PDF
        doc.setFontSize(18);
        doc.text("Attendance Records", 10, 10);
        
        // Add some spacing after the title
        let startY = 20;
        
        // Set font for the table content
        doc.setFontSize(12);
        
        // Loop through the attendance data and add it to the PDF
        let rowHeight = 10;

        @foreach ($attendances as $attendance)
            // Add the event name and date (only once for each event)
            if (startY == 20) {
                doc.setFontSize(14);
                doc.text("Event: {{ $attendance->event_name }}", 10, startY);
                doc.text("Date: {{ $attendance->event_date }}", 10, startY + 5);
                startY += 15; // Move down to start the table content
            }
        
            // Create a table header (only once for the first event, in case of multiple events)
            doc.text("User", 10, startY);
            doc.text("Event", 50, startY);
            doc.text("Time In", 100, startY);
            doc.text("Time Out", 140, startY);
            doc.text("Status", 180, startY);
        
            // Add some spacing after the header
            startY += 10;

            // Add attendance data for the current event
            doc.setFontSize(12);
            doc.text("{{ $attendance->user->name }}", 10, startY);
            doc.text("{{ $attendance->event_name }}", 50, startY);
            doc.text("{{ $attendance->time_in }}", 100, startY);
            doc.text("{{ $attendance->time_out }}", 140, startY);
            doc.text("{{ $attendance->status }}", 180, startY);
            startY += rowHeight;
        @endforeach
        
        // Save the generated PDF
        doc.save("attendance_records.pdf");
    });
</script>

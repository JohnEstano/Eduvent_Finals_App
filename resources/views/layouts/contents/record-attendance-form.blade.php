<form action="{{ route('attendances.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="user_id">User</label>
        <select name="user_id" id="user_id" class="form-control">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label for="event_name">Event Name</label>
        <input type="text" name="event_name" id="event_name" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="time_in">Time In</label>
        <input type="datetime-local" name="time_in" id="time_in" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="timein_photo">Time In Photo</label>
        <input type="file" name="timein_photo" id="timein_photo" class="form-control" accept="image/*">
    </div>

    <div class="form-group">
        <label for="time_out">Time Out</label>
        <input type="datetime-local" name="time_out" id="time_out" class="form-control">
    </div>

    <div class="form-group">
        <label for="timeout_photo">Time Out Photo</label>
        <input type="file" name="timeout_photo" id="timeout_photo" class="form-control" accept="image/*">
    </div>

    <div class="form-group">
        <label for="remarks">Remarks</label>
        <textarea name="remarks" id="remarks" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="on_time">On Time</option>
            <option value="late">Late</option>
        </select>
    </div>

    <div class="form-group">
        <label for="location">Location</label>
        <input type="text" name="location" id="location" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

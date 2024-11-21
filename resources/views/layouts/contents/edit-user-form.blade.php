<form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-3">
        <div class="row g-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <!-- User Name -->
            <div class="col-sm-12 mb-2">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" required
                    class="form-control">
            </div>

            <!-- Student ID -->
            <div class="col-sm-12 mb-2">
                <label for="student_id" class="form-label">Student ID</label>
                <input type="text" name="student_id" id="student_id" value="{{ $user->student_id }}" required
                    class="form-control">
            </div>

            <!-- Email -->
            <div class="col-sm-12 mb-2">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" required
                    class="form-control">
            </div>

            <!-- Password -->



            <!-- Role -->
            <div class="col-sm-12 mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" class="form-control">

                    <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <!-- Profile Photo -->
            <div class="col-sm-12 mb-3">
                <label for="profile_photo_path" class="form-label">Profile Photo</label>
                <input type="file" name="profile_photo_path" id="profile_photo_path" class="form-control"
                    accept="image/*">
                <small class="text-muted">Optional: Upload a profile photo.</small>
            </div>

            <!-- Submit Button -->
            <div class="col-sm-12 mb-3 mt-2">
                <button class="btn btn-dark w-100" type="submit">Save Changes</button>
            </div>
        </div>
</form>

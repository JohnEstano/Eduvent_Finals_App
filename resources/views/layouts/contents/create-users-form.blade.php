

<form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
    @csrf
    @method('post')
    
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
            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="form-control">
        </div>

        <!-- Student ID -->
        <div class="col-sm-12 mb-2">
            <label for="student_id" class="form-label">Student ID</label>
            <input type="text" name="student_id" id="student_id" value="{{ old('student_id') }}" required class="form-control">
        </div>

        <!-- Email -->
        <div class="col-sm-12 mb-2">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required class="form-control">
        </div>

        <!-- Password -->
        <div class="col-sm-12 mb-2">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" value="12345678" required class="form-control">
            <small class="text-muted">Default password: 12345678</small>
        </div>

        <!-- Role -->
        <div class="col-sm-12 mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" class="form-control">
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <!-- Profile Photo -->
        <div class="col-sm-12 mb-3">
            <label for="profile_photo_path" class="form-label">Profile Photo</label>
            <input type="file" name="profile_photo_path" id="profile_photo_path" class="form-control" accept="image/*">
            <small class="text-muted">Optional: Upload a profile photo.</small>
        </div>

        <!-- Submit Button -->
        <div class="col-sm-12 mb-3 mt-2">
            <button class="btn btn-dark w-100" type="submit">Create User</button>
        </div>
    </div>
</form>

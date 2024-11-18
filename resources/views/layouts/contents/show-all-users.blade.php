<head>
    <style>
        .dropdown-toggle:focus,
        .dropdown-toggle:active {
            outline: none;
            /* Removes the blue outline when clicked */
            box-shadow: none;
            /* Removes any box shadow */
            background-color: transparent;
            /* Keeps the background transparent */
        }

        /* Optional: Change the text color when clicked to gray or white */
        .dropdown-toggle:active,
        .dropdown-toggle:focus {
            /* You can change this to any color (gray) */
        }

        /* Change the color of the dropdown menu items when clicked or hovered */
        .dropdown-item:active,
        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: black;
            /* Light gray background on hover or active */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;

        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        .profile-photo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .dropdown {
            position: relative;
        }

        .btn-link {
            background: none;
            border: none;
        }
    </style>
</head>

<div class="container">


    <table style=" border-collapse: collapse; width: 100%; margin: 20px 0; ">
        <thead>
            <tr>
                <th>Profile</th>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="profile-photo">
                    </td>
                    <td>{{ $user->student_id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td class="dropdown">
                        <button class="btn btn-link text-dark" type="button" id="dropdownMenuButton{{ $user->id }}"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $user->id }}">
                            <li><a class="dropdown-item" href="{{ route('users.edit', $user->id) }}">Edit</a></li>
                            <li>
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">
                                    Delete
                                </a>
                                <form id="delete-form-{{ $user->id }}"
                                    action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end ms-2 me-2 mt-3">
        {{ $users->links() }}
    </div>
</div>

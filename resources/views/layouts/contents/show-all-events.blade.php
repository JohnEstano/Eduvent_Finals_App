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
    </style>
</head>

@foreach ($events as $event)
<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
    <div class="col p-4 d-flex flex-column position-static">
        <div class="text-body-secondary">
            {{ \Carbon\Carbon::parse($event->date)->format('l, j') }}
            &nbsp;<strong class="d-inline-block mb-2 text-primary-emphasis">{{ $event->requirement }} &nbsp;{{ $event->status }}</strong>
        </div>

        <h3 class="mb-0">{{ $event->name }}</h3>
        <p class="card-text mb-auto ">
          
            <span class="d-flex align-items-center fw-bold">  By
                {{ $event->user->name }} 
                <img src="{{ $event->user->profile_photo_url }}" alt="{{ $event->user->name }}'s Profile Photo" class="rounded-circle ms-2" width="20" height="20">
            </span>
        </p>

        <p class="card-text mb-auto text-muted">{{ $event->description }}</p>
    </div>
    <div class="col-auto d-none d-lg-block position-relative" style="height: 150px;">
        <div class="dropdown position-absolute" style="top: 0; right: 0;">
            <button class="btn btn-link text-dark" type="button" id="dropdownMenuButton"
                data-bs-toggle="dropdown" aria-expanded="false"
                style="font-size: 20px; background: none; border: none;">
                <i class="bi bi-three-dots"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="{{ route('events.edit', $event->id) }}">Edit</a></li>
                <li>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $event->id }}').submit();">
                        Delete
                    </a>
                    <form id="delete-form-{{ $event->id }}" action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </li>
            </ul>
        </div>

        <a href="#"
            class="icon-link gap-1 stretched-link text-decoration-none text-dark position-absolute me-4"
            style="bottom: 0; right: 0; transition: color 0.2s ease;"
            onmouseover="this.classList.remove('text-dark'); this.classList.add('text-warning');"
            onmouseout="this.classList.remove('text-warning'); this.classList.add('text-dark');">
            <span class="mt-1 me-1">Manage</span>
            <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</div>

@endforeach

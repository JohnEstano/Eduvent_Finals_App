<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .gray-button {
            display: flex;
            align-items: center;
            color: black;
            transition: background-color 0.3s ease;
        }

        .gray-button:hover {
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            color: #1a1b1b !important;
        }
    </style>
</head>


<nav class="navbar fixed-top bg-white" style="font-size: 0.85rem;">



    @auth
    @endauth
    
        @auth()
        <div class="container-fluid d-flex justify-content-between align-items-center h-25">

        <i class="bi bi-app-indicator h4 ms-2"></i><h5>Edv</h5>
        <div class="d-flex justify-content-end flex-grow-1">
            <ul class="nav nav-underline">
                <li class="nav-item">
                    <a class="gray-button text-decoration-none rounded-2 text-muted" aria-current="page"
                        href="{{ route('home') }}">
                        <i class="bi bi-house-door-fill h6 mx-1 my-2 ms-2 me-1 rounded"></i> Home &nbsp;
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('attendanceToday') }}"
                        class="gray-button text-decoration-none rounded-2 text-muted">
                        <i class="bi bi-clipboard-check-fill h6 mx-1 my-2 ms-2 me-1 rounded"></i> Attendance&nbsp;&nbsp;
                    </a>
                </li>

                <li class="nav-item">
                    <a class="gray-button text-decoration-none rounded-2 text-muted" href="{{ route('events.show') }}">
                        <i class="bi bi-grid-fill h6 mx-1 my-2 ms-2 me-1 rounded"></i> Manage &nbsp;
                    </a>
                </li>
            </ul>

        </div>
            @include('layouts.house.header-right-auth')
        @endauth

    </div>



</nav>




</header>

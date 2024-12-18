<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 230px;
            height: 100%;
            background-color: #ffffff;
         
            padding-top: 20px;
        }
        .sidebar .nav-link {
            padding: 10px 20px;
            font-size: 17px;
        }
    </style>
</head>

<body>
    <div class="sidebar ms-3 mt-10">
        <div class="navbar-nav">
            @if(Auth::check() && Auth::user()->student_id === '000')
                <a href="{{ route('users') }}" class="nav-link text-dark hover:text-warning">Users</a>
            @endif
            <a href="{{ route('events.show') }}" class="nav-link text-dark hover:text-warning">Events</a>
            <a href="{{ route('attendances.index') }}" class="nav-link text-dark hover:text-warning">Records</a>
        </div>
    </div>
    

  

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
</body>

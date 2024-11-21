<head>
    <style>
        * {
            font-weight: bold;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 70%;
            display: flex;
            gap: 20px;
            padding: 20px;
            position: relative;
        }

        .sections {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: white;
            position: relative;
            margin-top: -100px; /* Bring the profile section closer to the banner */
        }

        .profile-section {
            width: 100%;
            height: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 0; /* Remove padding to avoid extra space */
            background-color: white;
        }

        .profile-section img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-top: -60px; /* Bring the profile photo closer to the banner */
            margin-bottom: 15px;
        }

        .date-time-section {
            flex: 2 1 0;
            text-align: center;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        h1 {
            font-size: calc(1.4rem + 1vw);
            font-weight: bolder;
            color: #FFAA33;
            margin-bottom: 0;
        }

        .date-time-section i {
            font-size: 4rem;
            color: #FFAA33;
        }

        .date-time-section h3 {
            margin-top: 10px;
        }

        .stats .stat {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    
    <img src="{{ asset('images/banner.png') }}" alt="Banner Image" class="ms-2 mt-4" style="width: 100%; box-shadow: 0 8px 9px rgba(0, 0, 0, 0.1); border-radius: 20px;">

    <div class="container">
        <div class="profile-section sections">
         
            <img src="{{ Auth::user()->profile_photo_url }}" alt="Profile Photo" class="profile-photo">
            <h1>#{{ Auth::user()->student_id }}</h1>
            <h3><strong>Hello, {{ Auth::user()->firstname }} {{ Auth::user()->name }}</strong></h3>
            <h6>{{ Auth::user()->role }} &nbsp; {{ Auth::user()->population }}</h6>

            <!-- Stats section -->
            <div class="stats d-flex mt-4">
                <div class="stat me-3">
                    <h5>Attended &nbsp;<span class="text-success">{{ $attendedCount }}</span> </h5>
                </div>
                <div class="stat">
                    <h5>Missed &nbsp;<span class="text-danger"> {{ $missedCount }}</span></h5>
                </div>
            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>

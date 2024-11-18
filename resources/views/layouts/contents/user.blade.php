


<head>
    <style>
        * {
            font-weight: bold;

        }

        .container {
            width: 70%;
            display: flex;
            gap: 20px;
            padding: 20px;
        }

        .sections {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: white;
        }

        .profile-section {
            flex: 3 1 0;
            display: flex;
            align-items: center;
            border-radius: 20px;
        }

        .profile-section img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 15px;
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
    </style>
</head>

<body>
    <div class="container mt-20">

      

        <div class="profile-section sections d-flex justify-center">
            <img src="{{ Auth::user()->profile_photo_url }}" alt="Profile Photo">
            <div>
                <h1>#{{ Auth::user()->student_id }}</h1>
                <h3><strong>Hello, {{ Auth::user()->firstname }} {{ Auth::user()->name }}</strong></h3>
                <h6>{{ Auth::user()->role }} &nbsp; {{ Auth::user()->population }}</h6>
            </div>
        </div>

      
    </div>



    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>

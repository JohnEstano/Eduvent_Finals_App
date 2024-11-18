<head>
    <style>
        .arrow-button {
            display: inline-flex; /* Use inline-flex to allow content to fit naturally */
            align-items: center;
            color: black;
            padding: 5px 10px; /* Optional: adjust padding to control button size */
            transition: background-color 0.3s ease;
            border-radius: 5px; /* Add border radius to match hover effect */
        }

        .arrow-button:hover {
            background-color: rgba(0, 0, 0, 0.1);
            color: #1a1b1b !important;
        }

        .arrow-button i {
            font-size: 1.5rem; /* Optional: adjust the icon size */
        }
        .header-container {
            display: flex;
            align-items: center;
            gap: 10px; /* Optional: space between the arrow and the title */
        }
    </style>
</head>
<body>

<div class="container" style="margin-top: 60px">

    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div>
                      
        
              
                <div class="header-container">
                    <a href="{{ route('events.show') }}" class="arrow-button text-black fs-4 me-2">
                        <i class="bi bi-arrow-left ms-2 me-2 "></i>
                    </a>
                    <h1>Editing <span style="color: #FFBF00">{{$event->name}}</span></h1>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"
                                class="text-decoration-none text-warning">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('events.show') }}"
                                class="text-decoration-none text-warning">Events</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>

          @include('layouts.contents.edit-event-form')
        </div>
    </div>
</div>

</body>

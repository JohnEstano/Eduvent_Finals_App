<head>
    <style>
        .arrow-button {
            display: inline-flex;
            /* Use inline-flex to allow content to fit naturally */
            align-items: center;
            color: black;
            padding: 5px 10px;
            /* Optional: adjust padding to control button size */
            transition: background-color 0.3s ease;
            border-radius: 5px;
            /* Add border radius to match hover effect */
        }

        .arrow-button:hover {
            background-color: rgba(0, 0, 0, 0.1);
            color: #1a1b1b !important;
        }

        .arrow-button i {
            font-size: 1.2rem;
            /* Optional: adjust the icon size */
        }

        .header-container {
            display: flex;
            align-items: center;
            gap: 10px;

        }
    </style>

</head>


<body>
    <div class="container" style="margin-top: 80px">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div>
                    <div class="header-container d-flex justify-content-between align-items-center">
                        <h1>Users</h1>
                
                        
                        <a href="{{ route('users.create') }}" class="arrow-button text-black fs-4 text-decoration-none d-flex align-items-center">
                            <i class="bi bi-plus-lg me-2 mt-1"></i>
                            <h5 class="mt-1 fw-bold mt-2">Add User</h5>
                        </a>
                    </div>
                
                   
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" class="text-decoration-none text-warning">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
                        </ol>
                    </nav>
                </div>
                

                @include('layouts.contents.show-all-users')
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

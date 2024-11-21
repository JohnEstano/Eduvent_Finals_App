
<div class="container" style="margin-top: 80px">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div>
                <div class="header-container d-flex justify-content-between align-items-center">
                    <h1>Attendance Records</h1>
            
                    
                  
                </div>
            
               
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-decoration-none text-warning">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Records</li>
                    </ol>
                </nav>
            </div>
            

            @include('layouts.contents.show-all-attendance-records')
        </div>
    </div>

</div>


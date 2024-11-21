<!-- resources/views/event/userEvents.blade.php -->





<div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link link-dark active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Past Events</button>
    <button class="nav-link link-dark" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Upcoming Events</button>
</div>

<div class="tab-content" id="nav-tabContent">
    <!-- Past Events Tab -->
    <div class="tab-pane fade show active mt-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
        @foreach ($pastEventsWithStatus as $event)
        <div class="event">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <div class="text-body-secondary">
                        {{ \Carbon\Carbon::parse($event->date)->format('l, j') }}
                        <strong class="d-inline-block mb-2 text-primary-emphasis">
                            {{ $event->requirement }} &nbsp;
                            <span class="{{ $event->status == 'attended' ? 'text-success' : 'text-danger' }}">
                                {{ $event->status }}
                            </span>
                        </strong>
                    </div>
                    <h3 class="mb-0">{{ $event->name }}</h3>
                    <p class="card-text mb-auto ">
                        <span class="d-flex align-items-center fw-bold">  By
                            {{ $event->user->name }} 
                            <img src="{{ $event->user->profile_photo_url }}" alt="{{ $event->user->name }}'s Profile Photo" class="rounded-circle ms-2" width="20" height="20">
                        </span>
                    </p>
                    <p class="card-text mb-auto text-muted description" id="eventDescription">{{ Str::limit($event->description, 100) }} <span class="read-more" onclick="toggleDescription()"></span></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Upcoming Events Tab -->
    <div class="tab-pane fade mt-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
        @if($upcomingEvents->isEmpty())
        <div class="d-flex justify-content-center">
            <p>No Upcoming Events.</p>
        </div>
            
        @else
            @foreach ($upcomingEvents as $event)
            <div class="event">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <div class="text-body-secondary">
                            {{ \Carbon\Carbon::parse($event->date)->format('l, j') }}
                            <strong class="d-inline-block mb-2 text-primary-emphasis">
                                {{ $event->requirement }}
                            </strong>
                        </div>
                        <h3 class="mb-0">{{ $event->name }}</h3>
                        <p class="card-text mb-auto ">
                            <span class="d-flex align-items-center fw-bold">  By
                                {{ $event->user->name }} 
                                <img src="{{ $event->user->profile_photo_url }}" alt="{{ $event->user->name }}'s Profile Photo" class="rounded-circle ms-2" width="20" height="20">
                            </span>
                        </p>
                        <p class="card-text mb-auto text-muted description" id="eventDescription">{{ Str::limit($event->description, 100) }} <span class="read-more" onclick="toggleDescription()"></span></p>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>

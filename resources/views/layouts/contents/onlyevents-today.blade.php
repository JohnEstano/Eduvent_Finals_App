<head>
    <style>
        * {
            font-weight: bold;

        }


        #camera-container,
        #captured-image {
            display: none;
        }

        #camera-container {
            position: relative;
            width: 420px;
            height: 340px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        #video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
        }

        #camera-container button {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
            background-color: rgba(255, 255, 255, 0.7);
            border: none;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        #captured-image {
            display: none;
            border-radius: 20px;
        }

        .container {
            width: 90%;
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
            font-size: calc(1.5rem + 1vw);
            font-weight: bolder;
            color: #FFAA33;
            margin-bottom: 0;
        }



        .date-time-section h3 {
            margin-top: 10px;
        }

        .arrow-button {

            display: block;
            /* Makes the <a> a block element */
            width: 100%;
            /* Ensures it occupies full width */
            text-align: center;
            /* Centers the text horizontally */
            line-height: 40px;
            /* Centers the text vertically if a fixed height is set */
            height: 40px;
            transition: background-color 0.3s ease;
            /* Set a fixed height for vertical centering */
            margin: 0 auto;
            /* Centers the element horizontally in its parent */

        }
    </style>
</head>
<div class="container d-flex justify-content-center align-items-center flex-column">
    @forelse($events as $event)
        <div class="col p-4 d-flex flex-column position-static">
            <h3
                class="
            @if ($event->status === 'Ongoing') text-success
            @elseif($event->status === 'Starting Soon') text-secondary
            @elseif($event->status === 'Event Ended') text-danger
            @else text-muted @endif
        ">
                {{ $event->status ?? 'Unknown' }}
            </h3>

            <div class="text-body-secondary text-center">
                {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}
                &nbsp;
                <strong class="d-inline-block mb-2 text-primary-emphasis">
                    {{ $event->requirement }} &nbsp;<i class="bi bi-geo-alt me-1"></i>{{ $event->location }}
                </strong>
            </div>

            <!-- Event Name -->
            <h3 class="mb-0 text-center" id="eventNameinthecard">{{ $event->name }}</h3>

            <!-- Event Host and Profile -->
            <p class="card-text mb-auto text-center">
                <span class="d-flex align-items-center justify-content-center fw-bold">
                    By {{ $event->user->name }}
                    <img src="{{ $event->user->profile_photo_url }}" alt="{{ $event->user->name }}'s Profile Photo"
                        class="rounded-circle ms-2" width="20" height="20">
                </span>
            </p>

            <!-- Event Description -->
            <p class="card-text mb-auto text-center mt-1 text-muted">{{ $event->description }}</p>

            <!-- Time In/ Time out Button -->
            <button type="button"
                class="bg-dark text-decoration-none text-white arrow-button mt-4 rounded 
                {{ in_array($event->status, ['Event Ended', 'Starting Soon']) ? 'd-none' : '' }}"
                id="{{ $event->user_has_time_in ? 'timeOutButton' : 'timeInButton' }}"
                onclick="handleTimeInOutClick({{ $event->id }}, {{ $event->user_has_time_in ? 'false' : 'true' }}, '{{ $event->name }}')">
                {{ $event->user_has_time_in ? 'Time Out' : 'Time In' }}
            </button>
        </div>
    @empty
        <p class="text-center">No events available for today.</p>
    @endforelse
</div>


<!--Modal-->
<div class="modal fade" id="attendanceModal" tabindex="-1" aria-labelledby="attendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="attendanceModalLabel">Time In/Out</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="attendanceForm" method="POST" enctype="multipart/form-data"
                    action="{{ route('attendances.store') }}">
                    @csrf
                    <div class="row g-3">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- Step 1: User and Event Information -->
                        <div id="step1" class="form-step">
                            <h4>Step 1: User and Event Information</h4>
                            <input type="hidden" id="event_name" name="event_name">

                            <input type="hidden" id="user_id" name="user_id">
                            <p style="font-size: 20px; font-weight: bold; color:#05083f">Event: <span
                                    id="event_namez"></span></p>
                            <div style="display: flex; justify-content: center; align-items: center;">
                                <img id="user_photo" src="" alt="User Photo"
                                    style="width: 70px; height: 70px; border-radius: 50%;">
                            </div>
                            <p class="mt-4">You are logged in as <span id="user_name"></span></p>
                            <p>Student ID: <strong style="color: #FFBF00">#<span id="student_id"></span></strong></p>
                        </div>

                        <!-- Step 2: User Location -->
                        <div id="step2" class="form-step d-none">
                            <h4>Step 2: <i class="bi bi-geo-alt-fill"></i> Your Location</h4>
                            <p class="text-muted small">Your location is needed to help the officials verify your
                                presence during the event.</p>
                            <button type="button" class="btn btn-white" onclick="findMyState()">Get My
                                Location</button>
                            <input type="text" class="status" id="location" name="location" readonly required>
                        </div>

                        <!-- Step 3: Take Selfie -->
                        <div id="step3" class="form-step d-none">
                            <h4>Step 3: Take a Selfie</h4>
                            <p class="text-muted small">Take a photo proof to help the officials verify your presence
                                during the event.</p>
                            <div id="camera-container">
                                <video id="video" autoplay></video>
                                <button type="button" onclick="takePicture()">Take Selfie</button>
                            </div>
                            <input type="file" id="photoInput" name="timein_photo" class="d-none">
                            <input type="time" id="time_in" name="time_in">
                        </div>

                        <!-- Remarks and Status -->
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea id="remarks" name="remarks" class="form-control" placeholder="Enter remarks"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control">
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                                <option value="Late">Late</option>
                                <option value="Excused">Excused</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="nextStepButton" class="btn btn-dark">Next Step</button>
                            <button type="submit" id="submitButton" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>


<script>

document.getElementById('attendanceForm').addEventListener('submit', function(e) {
        var timeInput = document.getElementById('time_in');
        var timeValue = timeInput.value;

        // Check if time is in correct H:i format
        if (timeValue && timeValue.length === 5) {
            // Ensure it doesn't add seconds (keep as HH:MM)
            timeInput.value = timeValue; // just in case, ensure it's in H:i format
        }
    });
    let currentStep = 1;
    const maxSteps = 3;
    let isTimeIn = false;
    let eventId;
    document.addEventListener("DOMContentLoaded", function() {
        const timeInButton = document.getElementById("timeInButton");
        const timeOutButton = document.getElementById("timeOutButton");

        // Get the event name dynamically from the Blade view
        const eventName = document.getElementById("eventNameinthecard").innerText;
        const eventId = 1; // You can dynamically pass the actual event ID as needed

        if (timeInButton) {
            timeInButton.addEventListener("click", function() {
                isTimeIn = true;
                const authUser = @json(Auth::user()); // Get the authenticated user
                showModal(eventId, eventName, authUser);
            });
        }

        if (timeOutButton) {
            timeOutButton.addEventListener("click", function() {
                isTimeIn = false;
                const authUser = @json(Auth::user()); // Get the authenticated user
                showModal(eventId, eventName, authUser);
            });
        }

        // Event listener for modal close action
        const modal = document.getElementById('attendanceModal');
        if (modal) {
            const closeButton = modal.querySelector('[data-bs-dismiss="modal"]');

            // Close modal and stop camera on close button click
            if (closeButton) {
                closeButton.addEventListener('click', function() {
                    stopCamera(); // Stop the camera when the modal is closed
                });
            }

            // Also stop the camera when clicking outside the modal (if modal has backdrop)
            modal.addEventListener('hidden.bs.modal', function() {
                stopCamera(); // Stop the camera when the modal is closed
            });
        }
    });

    if (nextStepButton) {
        nextStepButton.addEventListener("click", function() {
            if (currentStep === 1) {
                // When moving to Step 2, trigger the location retrieval
                findMyState();
            } else if (currentStep === 2) {
                startCamera(); // Start the camera when on step 2
            }

            // Move to the next step
            currentStep++;
            if (currentStep > maxSteps) {
                submitForm(); // Submit the form if max steps are reached
            } else {
                showStep(currentStep);
            }

            // Stop the camera if we leave step 3
            if (currentStep !== 3) {
                stopCamera();
            }
        });
    }

    let actionType = '';

    // Function to start the camera
    function startCamera() {
        const cameraContainer = document.getElementById('camera-container');
        const video = document.getElementById('video');

        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then((stream) => {
                video.srcObject = stream;
                cameraContainer.style.display = 'block';
            })
            .catch((err) => console.error("Camera access denied: ", err));
    }

    // Function to stop the camera
    function stopCamera() {
        const video = document.getElementById('video');
        const stream = video.srcObject;
        const tracks = stream ? stream.getTracks() : [];

        tracks.forEach(track => track.stop()); // Stop each track in the stream
        video.srcObject = null; // Remove the video stream from the video element
    }

    function showStep(stepNumber) {
        // Hide all steps first
        const steps = document.querySelectorAll('.step');
        steps.forEach((step) => {
            step.style.display = 'none';
        });

        // Show the selected step
        const currentStep = document.getElementById(`step-${stepNumber}`);
        currentStep.style.display = 'block';

        // Stop the camera if we're not on step 3
        if (stepNumber !== 3) {
            stopCamera();
        } else {
            startCamera();
        }
    }

    // Function to take a picture
    function takePicture() {
        const video = document.getElementById('video');
        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        const selfieDataUrl = canvas.toDataURL('image/png');
        const selfieInput = document.getElementById('photoInput');
        selfieInput.files = createFileFromDataUrl(selfieDataUrl);

        stopCamera(); // Stop the camera after taking the picture
        showStep(4); // Move to the next step
    }

    // Helper function to create a File object from a data URL
    function createFileFromDataUrl(dataUrl) {
        const binary = atob(dataUrl.split(',')[1]);
        const array = [];
        for (let i = 0; i < binary.length; i++) {
            array.push(binary.charCodeAt(i));
        }
        return new File([new Blob([new Uint8Array(array)])], 'selfie.png', {
            type: 'image/png'
        });
    }






    const modal = document.getElementById('modal'); // Adjust with your modal's ID
    const modalContent = document.getElementById('modal-content'); // Adjust to the actual content div of your modal

    // Function to stop the camera
    function stopCamera() {
        const video = document.getElementById('video');
        const stream = video.srcObject;
        const tracks = stream ? stream.getTracks() : [];

        tracks.forEach(track => track.stop()); // Stop each track in the stream
        video.srcObject = null; // Remove the video stream from the video element
    }
    // Check if the modal exists and add listeners
    if (modal) {
        // Check if modal has a close or hide method (if you're using a library/modal framework)
        if (typeof modal.close === 'function') {
            modal.addEventListener('close', function() {
                stopCamera(); // Stop the camera when modal is closed
            });
        }

        // Add an event listener to close the modal when clicking outside of it
        document.addEventListener('click', function(event) {
            // Check if the click is outside the modal content
            if (modal && !modalContent.contains(event.target)) {
                modal.close(); // Close the modal
                stopCamera(); // Stop the camera when clicking outside
            }
        });

        // If you're using a close button, listen for that as well
        const closeButton = document.getElementById('close-modal'); // Adjust with the close button's ID
        if (closeButton) {
            closeButton.addEventListener('click', function() {
                modal.close(); // Close the modal
                stopCamera(); // Stop the camera when clicking the close button
            });
        }
    }



    function findMyState() {
        const status = document.querySelector('.status');

        const success = (position) => {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            const geoApiUrl =
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&addressdetails=1`;

            fetch(geoApiUrl)
                .then(res => {
                    if (!res.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return res.json();
                })
                .then(data => {
                    console.log(data);
                    if (data.address) {
                        const building = data.address.building || '';
                        const road = data.address.road || '';
                        const city = data.address.city || data.address.town || data.address.village || '';
                        const specificLocation = `${building}, ${road}, ${city}`;
                        status.textContent = specificLocation.trim() || 'No specific location found';
                        document.getElementById("location").value = specificLocation.trim();
                    } else {
                        status.textContent = 'Unable to retrieve location details';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    status.textContent = 'Unable to retrieve location details';
                });
        };

        const error = () => {
            status.textContent = 'Unable to retrieve your location';
        };

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, error);
        } else {
            status.textContent = 'Geolocation is not supported by this browser.';
        }
    }

    function showModal(eventId, eventName, authUser, isTimeIn) {
    // Set the event name in the hidden input
    document.getElementById("event_name").value = eventName;  // Update to event_name instead of event_id

    // Set user-specific data
    document.getElementById("user_id").value = authUser.id;
    document.getElementById("student_id").innerText = authUser.student_id;
    document.getElementById("user_name").innerText = authUser.name;
    document.getElementById("event_namez").innerText = eventName;  // Display event name

    // Update the user's profile photo
    const userPhoto = document.getElementById("user_photo");
    userPhoto.src = authUser.profile_photo_url || 'default-photo.jpg';

    // Update modal title and configure inputs for Time In/Out
    const modalTitle = document.getElementById("attendanceModalLabel");
    const nextButton = document.getElementById("nextStepButton");

    if (isTimeIn) {
        modalTitle.innerText = "Time In";
        nextButton.innerText = "Start Attendance";

        // Get the current time in HH:mm format
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const currentTime = `${hours}:${minutes}`;

        // Set the current time as the value of the time_in input
        document.getElementById("time_in").value = currentTime;

        // Dynamically set photo input name for time_in
        document.getElementById("photoInput").name = "timein_photo";
    } else {
        modalTitle.innerText = "Time Out";
        nextButton.innerText = "Next";

        // Clear time_in and dynamically set the photo input name for time_out
        document.getElementById("time_in").value = "";
        document.getElementById("photoInput").name = "timeout_photo";
    }

    // Ensure the location field is ready for input
    document.getElementById("location").value = ""; // Can dynamically set based on geolocation

    // Reset and show the first step
    currentStep = 1;
    showStep(currentStep);

    // Show the modal
    var modalElement = document.getElementById('attendanceModal');
    var modal = new bootstrap.Modal(modalElement);

    modal.show();

    // Add cleanup logic on modal close
    modalElement.addEventListener('hidden.bs.modal', function() {
        document.getElementById("attendanceForm").reset();
        document.getElementById("step1").classList.remove('d-none');
        document.getElementById("step2").classList.add('d-none');
        document.getElementById("step3").classList.add('d-none');
    });
}

    function showStep(step) {
        for (let i = 1; i <= maxSteps; i++) {
            document.getElementById(`step${i}`).classList.add('d-none');
        }

        document.getElementById(`step${step}`).classList.remove('d-none');
        document.getElementById("nextStepButton").classList.toggle('d-none', step === maxSteps);
        document.getElementById("submitButton").classList.toggle('d-none', step !== maxSteps);
    }
</script>

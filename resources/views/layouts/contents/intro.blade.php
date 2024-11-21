<head>
    <style>
        * {
            font-weight: bold;
            
        }

        .container {
            width: 103%;
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
    <div class="container" style="margin-top: 130px !important;">


       
        <div class="date-time-section sections">
            <i id="time-icon" class="bi bi-sun"></i>
            <div id="datetime">
                <h3><strong>Today:</strong> <span id="current-date"></span></h3>
                <p id="current-time"></p>
            </div>
         
        </div>
    </div>

    <script>
        function updateDateTime() {
            const now = new Date();

            
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const currentDate = now.toLocaleDateString('en-US', options);
            document.getElementById('current-date').innerText = currentDate;

            let hours = now.getHours();
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0'); 
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12 || 12; 
            document.getElementById('current-time').innerText = `${hours}:${minutes}:${seconds} ${ampm}`;

     
            const timeIcon = document.getElementById('time-icon');
            if ((hours >= 6 && ampm === 'AM') || (hours < 6 && ampm === 'PM')) {
                timeIcon.className = 'bi bi-sun';
                timeIcon.style.color = '#FFAA33'; 
            } else {
                timeIcon.className = 'bi bi-moon-fill'; 
                timeIcon.style.color = '#5555FF'; 
            }
        }

      
        setInterval(updateDateTime, 1000);

        
        updateDateTime();
    </script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>

<head>
    <style>
        .arrow-button {
            display: flex;
            align-items: center;
            color: black;
            transition: background-color 0.3s ease;
        }

        .arrow-button:hover {
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            color: #1a1b1b !important;
        }
    </style>
</head>

<div class="w-full min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg flex flex-col">
        <a href="/" class="arrow-button text-black text-2xl mt-auto self-start mb-4 me-2 rounded p-2 no-underline">
            &nbsp;<i class="bi bi-arrow-left"></i>&nbsp;
        </a>
        
        

        <div class="flex-grow">
            {{ $slot }}
        </div>

    </div>
</div>

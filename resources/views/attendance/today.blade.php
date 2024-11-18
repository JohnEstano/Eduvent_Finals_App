

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

   
     
    
        <div class="date-time-section sections" style="margin-top: 60px">
            
            @include('layouts.contents.onlyevents-today')
          
         
        </div>
     
  

</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


<div>
    
    @include('layouts.contents.user')
  

</div>
   
    


    <div class="d-flex flex-column">
        <div>

            @include('layouts.contents.intro')
         

        </div>
        <div>
            @if ($endedEvent)
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Event Ended!</strong> The event "{{ $endedEvent->name }}" has ended today.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
            @if ($ongoingEvent)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Ongoing Event!</strong> The event "{{ $ongoingEvent->name }}" is happening today.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        
          
        
            @include('layouts.contents.showuserevents')
        </div>
        
    </div>


    </div>








</x-app-layout>

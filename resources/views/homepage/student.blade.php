

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

 
            

    
        @include('layouts.contents.user')
        

        <div class="d-flex">
            @include('layouts.contents.intro')
        </div>




      
</x-app-layout>

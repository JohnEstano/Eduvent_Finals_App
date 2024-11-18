
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

 
            

        @include('layouts.contents.manage-bar')
        <div>

            
        </div>

        @include('layouts.contents.show-events')







      
</x-app-layout>

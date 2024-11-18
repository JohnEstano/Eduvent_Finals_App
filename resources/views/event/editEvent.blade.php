
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

 
            

    @include('layouts.contents.manage-bar')
    <div class="mt-3 ms-5" style="margin-top: 20px; margin-left: 230px;">
        @include('layouts.contents.edit-event')
    </div>
   






      
</x-app-layout>

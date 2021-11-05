<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gezondheidsformulieren') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @can ('viewGezForm', Auth::user())
                <x-gezforms-list :users="$users" :errors="$errors" :speltak="$speltak" :name="$name" class="bg-white overflow-hidden shadow-sm sm:rounded-lg" />
            @endcan
        </div>
        @can ('viewGezForm', Auth::user())
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        @endcan
        @cannot ('viewGezForm', Auth::user())
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @endcannot
            <x-gezforms-list-own :gezforms="$gezforms" :errors="$errors" class="bg-white overflow-hidden shadow-sm sm:rounded-lg" />
        </div>
    </div>
</x-app-layout>

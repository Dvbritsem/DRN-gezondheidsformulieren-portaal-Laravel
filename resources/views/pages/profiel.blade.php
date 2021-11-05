<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profiel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mx-auto container max-w-2xl md:w-3/4 shadow-md">
                <div class="bg-blue-50 p-4 border-t-2 border-blue-400 rounded-t">
                    <div class="max-w-sm mx-auto md:w-full md:mx-0">
                        <div class="inline-flex items-center space-x-4">
                            <h1 class="text-gray-600 text-xl">Gegevens</h1>
                        </div>
                    </div>
                </div>
                <div class="bg-white space-y-6">
                    <!-- Validation Errors -->
                    <x-auth-validation-errorsv2 class="pb-0" :errors="$errors" />

                    <div class="md:inline-flex space-y-4 md:space-y-0  w-full p-4 text-gray-500 items-center">
                        <h2 class="md:w-1/3 mx-auto max-w-sm">Account</h2>
                        <div class="md:w-2/3 mx-auto max-w-sm space-y-5">
                            <form method="POST" action="/profiel/savedData">
                                @csrf
                                <!-- Naam -->
                                <div>
                                    <x-label for="name" :value="__('Naam')" />
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required value="{{$user->name}}" />
                                </div>
                                <!-- Email -->
                                <div class="mt-4">
                                    <x-label for="email" :value="__('Email')" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required value="{{$user->email}}"/>
                                </div>
        
                                <div class="flex items-center justify-end mt-4">
                                    @if (session()->has('newuserdata'))
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="green" width="30px">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    @endif
                                    <x-button class="ml-3 bg-blue-400 hover:bg-blue-700 active:bg-blue-900">
                                        {{ __('Save') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <hr />

                    <div class="md:inline-flex space-y-4 md:space-y-0  w-full p-4 text-gray-500 items-center">
                        <h2 class="md:w-1/3 mx-auto max-w-sm">Wachtwoord</h2>
                        <div class="md:w-2/3 mx-auto max-w-sm space-y-5">
                            <form method="POST" action="/profiel/savedPassword">
                                @csrf
                                <!-- Old password -->
                                <div>
                                    <x-label for="oldpassword" :value="__('Huidige wachtwoord')" />
                                    <x-input id="oldpassword" class="block mt-1 w-full" type="password" name="oldpassword" :value="old('password')" required />
                                </div>
                                <!-- New password -->
                                <div class="mt-4">
                                    <x-label for="newpassword" :value="__('Nieuwe wachtwoord')" />
                                    <x-input id="newpassword" class="block mt-1 w-full" type="password" name="newpassword" required />
                                </div>
        
                                <div class="flex items-center justify-end mt-4">
                                    @if (session()->has('newpassword'))
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="green" width="30px">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    @endif
                                    <x-button class="ml-3 bg-blue-400 hover:bg-blue-700 active:bg-blue-900">
                                        {{ __('Save') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <hr />

                    <div class="w-full p-4 pb-8 text-right text-gray-500">
                        <a onclick="return confirm('Zeker weten?')" href="{{route('profiel.delete')}}" class="ml-3 bg-red-400 hover:bg-red-700 active:bg-red-900 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Verwijder account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
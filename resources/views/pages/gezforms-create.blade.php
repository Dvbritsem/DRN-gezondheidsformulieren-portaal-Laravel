<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nieuwe gezondheidsformulier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-blue-100 sm:rounded-t">
                <div class="mx-auto md:w-full md:mx-0">
                    <div class="inline-flex w-full">
                        <h1 class="text-gray-600 text-lg py-2 px-4 border-r-2 float-left">Onderdelen</h1>
                        <div class="inline-flex w-full flex-wrap">
                            @if(session()->has('AlgemeenDone'))
                                <x-nav-link :active="$category=='algemeen'" class="flex-1 items-center justify-center bg-green-100">
                                    {{ __('Algemeen') }}
                                </x-nav-link>
                            @endif
                            @if(!session()->has('AlgemeenDone'))
                                <x-nav-link :active="$category=='algemeen'" class="flex-1 items-center justify-center">
                                    {{ __('Algemeen') }}
                                </x-nav-link>
                            @endif
                            @if(session()->has('AdressenDone'))
                                <x-nav-link :active="$category=='adressen'" class="flex-1 items-center justify-center bg-green-100">
                                    {{ __('Adressen') }}
                                </x-nav-link>
                            @endif
                            @if(!session()->has('AdressenDone'))
                                <x-nav-link :active="$category=='adressen'" class="flex-1 items-center justify-center">
                                    {{ __('Adressen') }}
                                </x-nav-link>
                            @endif
                            @if(session()->has('Medische-GegevensDone'))
                                <x-nav-link :active="$category=='medische-gegevens'" class="flex-1 items-center justify-center text-center bg-green-100">
                                    {{ __('Medische gegevens') }}
                                </x-nav-link>
                            @endif
                            @if(!session()->has('Medische-GegevensDone'))
                                <x-nav-link :active="$category=='medische-gegevens'" class="flex-1 items-center justify-center text-center">
                                    {{ __('Medische gegevens') }}
                                </x-nav-link>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-b-lg">
                <!-- Validation Errors -->
                <x-auth-validation-errorsv2 class="pb-0" :errors="$errors" />
                <div class="pb-6 p-2 bg-white border-b border-gray-200">
                    @if ($category == "algemeen")
                        <x-gezforms-category.gezform-create-algemeen />
                    @endif
                    @if ($category == "adressen")
                        <x-gezforms-category.gezform-create-adressen />
                    @endif
                    @if ($category == "medische-gegevens")
                        <x-gezforms-category.gezform-create-medische-gegevens />
                    @endif
                    @if ($category == "opslaan")
                        <x-gezforms-category.gezform-create-opslaan />
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
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
                            <x-nav-link :href="route('gezforms.edit', ['id' => $id, 'category' => 'algemeen'])" :active="$category=='algemeen'" class="flex-1 items-center justify-center">
                                {{ __('Algemeen') }}
                            </x-nav-link>
                            <x-nav-link :href="route('gezforms.edit', ['id' => $id, 'category' => 'adressen'])" :active="$category=='adressen'" class="flex-1 items-center justify-center">
                                {{ __('Adressen') }}
                            </x-nav-link>
                            <x-nav-link :href="route('gezforms.edit', ['id' => $id, 'category' => 'medische-gegevens'])" :active="$category=='medische-gegevens'" class="flex-1 items-center justify-center text-center">
                                {{ __('Medische gegevens') }}
                            </x-nav-link>
                            <x-nav-link :href="route('gezforms.edit', ['id' => $id, 'category' => 'overige'])" :active="$category=='overige'" class="flex-1 items-center justify-center text-center">
                                {{ __('Overige') }}
                            </x-nav-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-b-lg">
                <!-- Validation Errors -->
                <x-auth-validation-errorsv2 class="pb-0" :errors="$errors" />
                <div class="pb-6 p-2 bg-white border-b border-gray-200">
                    @if ($category == "algemeen")
                        <x-gezforms-category.gezform-edit-algemeen :data="$data" />
                    @endif
                    @if ($category == "adressen")
                        <x-gezforms-category.gezform-edit-adressen :data="$data" />
                    @endif
                    @if ($category == "medische-gegevens")
                        <x-gezforms-category.gezform-edit-medische-gegevens :data="$data" />
                    @endif
                    @if ($category == "overige")
                        <x-gezforms-category.gezform-edit-overige :data="$data" />
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
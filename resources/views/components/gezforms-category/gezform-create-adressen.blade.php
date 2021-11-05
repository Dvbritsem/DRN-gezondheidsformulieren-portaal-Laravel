<div class="space-y-4 w-full text-gray-500 items-center">
    <form method="POST" action="adressen">
        <div class="inline-flex flex-1 w-full flex-wrap justify-evenly">
            <div class="flex-grow md:max-w-input mt-4 mx-2">
                @csrf
                <!-- Id -->
                <input type="hidden" name="id" value="{{Auth::user()->id}}" />
                <h2 class="pb-2 text-gray-600 text-xl">Eerste waarschuwingsadres:</h2>
                <!-- Voornaam -->
                <div>
                    <x-label for="voornaam1" :value="__('Voornaam')" />
                    <x-input id="voornaam1" class="block mt-1 w-full" type="text" name="voornaam1" required />
                </div>
                <!-- Achternaam -->
                <div class="mt-4">
                    <x-label for="achternaam1" :value="__('Achternaam')" />
                    <x-input id="achternaam1" class="block mt-1 w-full" type="text" name="achternaam1" required />
                </div>
                <!-- Relatie tot kind -->
                <div class="mt-4">
                    <x-label for="relatie_kind1" :value="__('Relatie tot kind')" />
                    <x-input id="relatie_kind1" class="block mt-1 w-full" type="text" name="relatie_kind1" required />
                </div>
                <!-- Adres -->
                <div class="mt-4">
                    <x-label for="adres1" :value="__('Adres')" />
                    <x-input id="adres1" class="block mt-1 w-full" type="text" name="adres1" required />
                </div>
                <!-- Woonplaats -->
                <div class="mt-4">
                    <x-label for="woonplaats1" :value="__('Woonplaats')" />
                    <x-input id="woonplaats1" class="block mt-1 w-full" type="text" name="woonplaats1" required />
                </div>
                <!-- Vast telefoon nummer -->
                <div class="mt-4">
                    <x-label for="vast_tel_nummer1" :value="__('Vast telefoon nummer')" />
                    <x-input id="vast_tel_nummer1" class="block mt-1 w-full" type="tel" name="vast_tel_nummer1" required />
                </div>
                <!-- Mobiel telefoon nummer -->
                <div class="mt-4">
                    <x-label for="mobiel_tel_nummer1" :value="__('Vast telefoon nummer')" />
                    <x-input id="mobiel_tel_nummer1" class="block mt-1 w-full" type="tel" name="mobiel_tel_nummer1" required />
                </div>
            </div>
            <div class="flex-grow md:max-w-input mt-4 mx-2">
                <h2 class="pb-2 text-gray-600 text-xl">Tweede waarschuwingsadres:</h2>
                <!-- Voornaam -->
                <div>
                    <x-label for="voornaam2" :value="__('Voornaam')" />
                    <x-input id="voornaam2" class="block mt-1 w-full" type="text" name="voornaam2" required />
                </div>
                <!-- Achternaam -->
                <div class="mt-4">
                    <x-label for="achternaam2" :value="__('Achternaam')" />
                    <x-input id="achternaam2" class="block mt-1 w-full" type="text" name="achternaam2" required />
                </div>
                <!-- Relatie tot kind -->
                <div class="mt-4">
                    <x-label for="relatie_kind2" :value="__('Relatie tot kind')" />
                    <x-input id="relatie_kind2" class="block mt-1 w-full" type="text" name="relatie_kind2" required />
                </div>
                <!-- Adres -->
                <div class="mt-4">
                    <x-label for="adres2" :value="__('Adres')" />
                    <x-input id="adres2" class="block mt-1 w-full" type="text" name="adres2" required />
                </div>
                <!-- Woonplaats -->
                <div class="mt-4">
                    <x-label for="woonplaats2" :value="__('Woonplaats')" />
                    <x-input id="woonplaats2" class="block mt-1 w-full" type="text" name="woonplaats2" required />
                </div>
                <!-- Vast telefoon nummer -->
                <div class="mt-4">
                    <x-label for="vast_tel_nummer2" :value="__('Vast telefoon nummer')" />
                    <x-input id="vast_tel_nummer2" class="block mt-1 w-full" type="tel" name="vast_tel_nummer2" required />
                </div>
                <!-- Mobiel telefoon nummer -->
                <div class="mt-4">
                    <x-label for="mobiel_tel_nummer2" :value="__('Vast telefoon nummer')" />
                    <x-input id="mobiel_tel_nummer2" class="block mt-1 w-full" type="tel" name="mobiel_tel_nummer2" required />
                </div>
            </div>
        </div>

        <div>
            <div class="flex items-center justify-end mt-5 pr-4">
                @if (session()->has('newgezform'))
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="green" width="30px">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                @endif
                <x-button class="ml-3 bg-blue-400 hover:bg-blue-700 active:bg-blue-900">
                    {{ __('Volgende') }}
                </x-button>
                <a onclick="return confirm('Zeker weten?')" href="{{route('gezforms.afbreken')}}" class="ml-3 bg-red-400 hover:bg-red-700 active:bg-red-900 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Afbreken</a>
            </div>
        </div>
    </form>
</div>
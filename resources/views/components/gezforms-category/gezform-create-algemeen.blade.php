<div class="space-y-4 w-full text-gray-500 items-center">
    <form method="POST" action="algemeen">
        <div class="inline-flex flex-1 w-full flex-wrap justify-evenly">
            <div class="flex-grow md:max-w-input mt-4 mx-2">
                @csrf
                <!-- Id -->
                <input type="hidden" name="id" value={{Auth::user()->id}} />
                <!-- Voornaam -->
                <div>
                    <x-label for="voornaam" :value="__('Voornaam')" />
                    <x-input id="voornaam" class="block mt-1 w-full" type="text" name="voornaam" required />
                </div>
                <!-- Achternaam -->
                <div class="mt-4">
                    <x-label for="achternaam" :value="__('Achternaam')" />
                    <x-input id="achternaam" class="block mt-1 w-full" type="text" name="achternaam" required />
                </div>
                <!-- Geboortedatum -->
                <div class="mt-4">
                    <x-label for="geboortedatum" :value="__('Geboortedatum')" />
                    <x-input id="geboortedatum" class="block mt-1 w-full" type="date" name="geboortedatum" required />
                </div>
                <!-- Speltak -->
                <div class="mt-4">
                    <x-label for="speltak" :value="__('Speltak')" />
                    <select name="speltak" id="speltak" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="Bevers">Bevers</option>
                        <option value="Welpen">Welpen</option>
                        <option value="Zeeverkenners">Zeeverkenners</option>
                        <option value="Wilde vaart">Wilde vaart</option>
                        <option value="Vrijwilliger">Vrijwilliger</option>
                    </select>
                </div>
                <!-- Mag zwemmen -->
                <div class="mt-4">
                    <x-label for="magzwemmen" :value="__('Mag uw kind zwemmen?')" />
                    <select name="magzwemmen" id="magzwemmen" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="Ja">Ja</option>
                        <option value="Nee">Nee</option>
                    </select>
                </div>
                <!-- Zwemdiploma's -->
                <div class="mt-4">
                    <x-label for="zwemdiplomas" :value="__('Zwemdiploma\'s')" />
                    <select name="zwemdiplomas" id="zwemdiplomas" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="Geen">Geen</option>
                        <option value="A">A</option>
                        <option value="AB">AB</option>
                        <option value="ABC">ABC</option>
                        <option value="ABC+">ABC+</option>
                    </select>
                </div>
            </div>
            <div class="flex-grow md:max-w-input mt-4 mx-2">
                <!-- Heimwee -->
                <div>
                    <x-label for="heimwee" :value="__('Heeft uw kind last van heimwee?')" />
                    <select name="heimwee" id="heimwee" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="Ja">Ja</option>
                        <option selected value="Nee">Nee</option>
                    </select>
                </div>
                <!-- Tandarts naam -->
                <div class="mt-4">
                    <x-label for="tandarts_naam" :value="__('Tandarts naam')" />
                    <x-input id="tandarts_naam" class="block mt-1 w-full" type="text" name="tandarts_naam" required />
                </div>
                <!-- Tandarts nummer -->
                <div class="mt-4">
                    <x-label for="tandarts_nummer" :value="__('Tandarts nummer')" />
                    <x-input id="tandarts_nummer" class="block mt-1 w-full" type="tel" name="tandarts_nummer" required />
                </div>
                <!-- Ziektekostenverzekering maatschappij -->
                <div class="mt-4">
                    <x-label for="ziektekostenverzekering_maatschappij" :value="__('Ziektekostenverzekering maatschappij')" />
                    <x-input id="ziektekostenverzekering_maatschappij" class="block mt-1 w-full" type="text" name="ziektekostenverzekering_maatschappij" required />
                </div>
                <!-- Ziektekostenverzekering polisnummer -->
                <div class="mt-4">
                    <x-label for="ziektekostenverzekering_polisnummer" :value="__('Ziektekostenverzekering polisnummer')" />
                    <x-input id="ziektekostenverzekering_polisnummer" class="block mt-1 w-full" type="text" name="ziektekostenverzekering_polisnummer" required />
                </div>
                <!-- Opmerkingen -->
                <div class="mt-4">
                    <x-label for="opmerkingen" :value="__('Zijn er dingen waar wij rekening mee moeten houden?')" />
                    <x-input id="opmerkingen" class="block mt-1 w-full" type="text" name="opmerkingen" value="" placeholder="Nee" />
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
@props(['data'])

<div class="space-y-4 w-full text-gray-500 items-center">
    <form method="POST" action="algemeen">
        <div class="inline-flex flex-1 w-full flex-wrap justify-evenly">
            <div class="flex-grow md:max-w-input mt-4 mx-2">
                @csrf
                <!-- Voornaam -->
                <div>
                    <x-label for="voornaam" :value="__('Voornaam')" />
                    <x-input id="voornaam" class="block mt-1 w-full" type="text" name="voornaam" value="{{$data->voornaam}}" required />
                </div>
                <!-- Achternaam -->
                <div class="mt-4">
                    <x-label for="achternaam" :value="__('Achternaam')" />
                    <x-input id="achternaam" class="block mt-1 w-full" type="text" name="achternaam" value="{{$data->achternaam}}" required />
                </div>
                <!-- Geboortedatum -->
                <div class="mt-4">
                    <x-label for="geboortedatum" :value="__('Geboortedatum')" />
                    <x-input id="geboortedatum" class="block mt-1 w-full" type="date" name="geboortedatum" value="{{$data->geboortedatum}}" required />
                </div>
                <!-- Speltak -->
                <div class="mt-4">
                    <x-label for="speltak" :value="__('Speltak')" />
                    <select name="speltak" id="speltak" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option @if($data->speltak=="Bevers") selected @endif value="Bevers">Bevers</option>
                        <option @if($data->speltak=="Welpen") selected @endif value="Welpen">Welpen</option>
                        <option @if($data->speltak=="Zeeverkenners") selected @endif value="Zeeverkenners">Zeeverkenners</option>
                        <option @if($data->speltak=="Wilde vaart") selected @endif value="Wilde vaart">Wilde vaart</option>
                        <option @if($data->speltak=="Vrijwilliger") selected @endif value="Vrijwilliger">Vrijwilliger</option>
                    </select>
                </div>
                <!-- Mag zwemmen -->
                <div class="mt-4">
                    <x-label for="magzwemmen" :value="__('Mag uw kind zwemmen?')" />
                    <select name="magzwemmen" id="magzwemmen" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option @if($data->magzwemmen=="Ja") selected @endif value="Ja">Ja</option>
                        <option @if($data->magzwemmen=="Nee") selected @endif value="Nee">Nee</option>
                    </select>
                </div>
                <!-- Zwemdiploma's -->
                <div class="mt-4">
                    <x-label for="zwemdiplomas" :value="__('Zwemdiploma\'s')" />
                    <select name="zwemdiplomas" id="zwemdiplomas" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option @if($data->zwemdiplomas=="Geen") selected @endif value="Geen">Geen</option>
                        <option @if($data->zwemdiplomas=="A") selected @endif value="A">A</option>
                        <option @if($data->zwemdiplomas=="AB") selected @endif value="AB">AB</option>
                        <option @if($data->zwemdiplomas=="ABC") selected @endif value="ABC">ABC</option>
                        <option @if($data->zwemdiplomas=="ABC+") selected @endif value="ABC+">ABC+</option>
                    </select>
                </div>
            </div>
            <div class="flex-grow md:max-w-input mt-4 mx-2">
                <!-- Heimwee -->
                <div>
                    <x-label for="heimwee" :value="__('Heeft uw kind last van heimwee?')" />
                    <select name="heimwee" id="heimwee" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option @if($data->heimwee=="Ja") selected @endif value="Ja">Ja</option>
                        <option @if($data->heimwee=="Nee") selected @endif value="Nee">Nee</option>
                    </select>
                </div>
                <!-- Tandarts naam -->
                <div class="mt-4">
                    <x-label for="tandarts_naam" :value="__('Tandarts naam')" />
                    <x-input id="tandarts_naam" class="block mt-1 w-full" type="text" name="tandarts_naam" value="{{$data->tandarts_naam}}" required />
                </div>
                <!-- Tandarts nummer -->
                <div class="mt-4">
                    <x-label for="tandarts_nummer" :value="__('Tandarts nummer')" />
                    <x-input id="tandarts_nummer" class="block mt-1 w-full" type="tel" name="tandarts_nummer" value="{{$data->tandarts_nummer}}" required />
                </div>
                <!-- Ziektekostenverzekering maatschappij -->
                <div class="mt-4">
                    <x-label for="ziektekostenverzekering_maatschappij" :value="__('Ziektekostenverzekering maatschappij')" />
                    <x-input id="ziektekostenverzekering_maatschappij" class="block mt-1 w-full" type="text" name="ziektekostenverzekering_maatschappij" value="{{$data->ziektekostenverzekering_maatschappij}}" required />
                </div>
                <!-- Ziektekostenverzekering polisnummer -->
                <div class="mt-4">
                    <x-label for="ziektekostenverzekering_polisnummer" :value="__('Ziektekostenverzekering polisnummer')" />
                    <x-input id="ziektekostenverzekering_polisnummer" class="block mt-1 w-full" type="text" name="ziektekostenverzekering_polisnummer" value="{{$data->ziektekostenverzekering_polisnummer}}" required />
                </div>
                <!-- Opmerkingen -->
                <div class="mt-4">
                    <x-label for="opmerkingen" :value="__('Zijn er dingen waar wij rekening mee moeten houden?')" />
                    <x-input id="opmerkingen" class="block mt-1 w-full" type="text" name="opmerkingen" value="{{$data->opmerkingen}}" placeholder="Nee" />
                </div>
            </div>
        </div>

        <div>
            <div class="flex items-center justify-end mt-5 pr-4">
                @if (session()->has('newgezformdata'))
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="green" width="30px">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                @endif
                <x-button class="ml-3 bg-blue-400 hover:bg-blue-700 active:bg-blue-900">
                    {{ __('Opslaan') }}
                </x-button>
                <a href="{{route('gezforms')}}" class="ml-3 bg-red-400 hover:bg-red-700 active:bg-red-900 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Terug naar overzicht</a>
            </div>
        </div>
    </form>
</div>
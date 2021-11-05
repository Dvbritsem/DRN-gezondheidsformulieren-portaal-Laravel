@props(['data'])

<div class="space-y-4 w-full text-gray-500 items-center">
    <form method="POST" action="medische-gegevens">
        <div class="inline-flex flex-1 w-full flex-wrap justify-evenly">
            <div class="flex-grow md:max-w-input mt-4 mx-2">
                @csrf
                <!-- Allergieën -->
                <div>
                    <x-label for="allergieën" :value="__('Overgevoeligheid of allergieën')" />
                    <x-input id="allergieën" class="block mt-1 w-full" type="text" name="allergieën" value="{{$data->allergieën}}" placeholder="Nee" />
                </div>
                <!-- Medicijnen gebruik -->
                <div class="mt-4">
                    <x-label for="medicijnen_gebruik" :value="__('Gebruikt uw kind medicijnen? Zo ja, welke? (Wanneer en welke dosis?)')" />
                    <x-input id="medicijnen_gebruik" class="block mt-1 w-full" type="text" name="medicijnen_gebruik" value="{{$data->medicijnen_gebruik}}" placeholder="Nee" />
                </div>
                <!-- Medicijnen niet -->
                <div class="mt-4">
                    <x-label for="medicijnen_niet" :value="__('Zijn er medicijnen die Uw kind niet mag gebruiken? Zo ja, welke?')" />
                    <x-input id="medicijnen_niet" class="block mt-1 w-full" type="text" name="medicijnen_niet" value="{{$data->medicijnen_niet}}" placeholder="Nee" />
                </div>
            </div>
            <div class="flex-grow md:max-w-input mt-4 mx-2">
                <!-- Dieet -->
                <div>
                    <x-label for="dieet" :value="__('Volgt uw kind een bepaald dieet? Zo ja, welk?')" />
                    <x-input id="dieet" class="block mt-1 w-full" type="text" name="dieet" value="{{$data->dieet}}" placeholder="Nee" />
                </div>
                <!-- Vaccinatie -->
                <div class="mt-4">
                    <x-label for="vaccinatie" :value="__('Is uw kind gevaccineerd volgens het Rijksvaccinatieprogramma?')" />
                    <select name="vaccinatie" id="vaccinatie" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option @if($data->vaccinatie=="Ja") selected @endif value="Ja">Ja</option>
                        <option @if($data->vaccinatie=="Nee") selected @endif value="Nee">Nee</option>
                    </select>
                </div>
                <!-- Syndroom -->
                <div class="mt-4">
                    <x-label for="syndroom" :value="__('Heeft uw kind last van bijv.: Astma, ADHD, Epilepsie, Ect?')" />
                    <x-input id="syndroom" class="block mt-1 w-full" type="text" name="syndroom" value="{{$data->syndroom}}" placeholder="Nee" />
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
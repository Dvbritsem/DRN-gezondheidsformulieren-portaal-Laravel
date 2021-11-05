@props(['data'])

<div class="space-y-4 w-full text-gray-500 items-center">
        <div class="inline-flex flex-1 w-full flex-wrap justify-evenly">
            <div class="flex-grow md:max-w-input mt-4 mx-2">
                <!-- Handtekening -->
                <div>
                    <x-label for="signature" :value="__('Handtekening')" />
                    <img class="border rounded-md mt-1" src="{{route('file', ['file_name' => 'gezform-id='.$data->id.'.png'])}}" alt="Handtekening">
                </div>
                <!-- Created at -->
                <div class="mt-4">
                    <x-label for="created_at" :value="__('Datum van ondertekenen')" />
                    <x-input readonly id="created_at" class="block mt-1 w-full" type="text" name="created_at" value="{{$data->created_at}}" />
                </div>
                <!-- Updated at -->
                <div class="mt-4">
                    <x-label for="updated_at" :value="__('Laatste keer bewerkt')" />
                    <x-input readonly id="updated_at" class="block mt-1 w-full" type="text" name="updated_at" value="{{$data->updated_at}}" />
                </div>
            </div>
        </div>

        <div>
            <div class="flex items-center justify-end mt-5 pr-4">
                <a href="{{route('gezforms')}}" class="ml-3 bg-red-400 hover:bg-red-700 active:bg-red-900 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Terug naar overzicht</a>
            </div>
        </div>
    </form>
</div>
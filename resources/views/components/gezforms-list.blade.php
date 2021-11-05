@props(['users', 'errors', 'speltak', 'name'])

<div {{ $attributes }}>
    <!-- Delete success -->
    <x-auth-delete-success class="pb-0" :errors="$errors" />
    <div class="p-6 bg-white border-b border-gray-200">
        <h2 class="pb-4 pl-3 font-bold text-gray-800 text-xl">Alle formulieren:</h2>

        <form method="POST" action="gezforms">
            <div class="flex-grow flex-row md:flex md:max-w-xl pb-4">
                @csrf
                <!-- Geboortedatum -->
                <div class="md:w-filterName">
                    <x-label for="name" :value="__('Naam')" />
                    <x-input id="name" class="block mt-1 w-full md:max-w-filterName" type="text" name="name" value="{{$name}}" />
                </div>
                <!-- Speltak -->
                <div class="md:w-filterSpeltak md:px-4 py-3 md:py-0">
                    <x-label for="speltak" :value="__('Speltak')" />
                    <select name="speltak" id="speltak" class="block mt-1 w-full md:max-w-filterSpeltak rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option @if($speltak=='') selected @endif value="">Alle</option>
                        <option @if($speltak=='Bevers') selected @endif value="Bevers">Bevers</option>
                        <option @if($speltak=='Welpen') selected @endif value="Welpen">Welpen</option>
                        <option @if($speltak=='Zeeverkenners') selected @endif value="Zeeverkenners">Zeeverkenners</option>
                        <option @if($speltak=='Wilde vaart') selected @endif value="Wilde vaart">Wilde vaart</option>
                        <option @if($speltak=='Vrijwilliger') selected @endif value="Vrijwilliger">Vrijwilliger</option>
                    </select>
                </div>
                <div class="flex items-end pb-1">
                    <x-button name="filter" class="bg-blue-400 hover:bg-blue-700 active:bg-blue-900">
                        {{ __('Filter') }}
                    </x-button>
                </div>
            </div>
        </form>

        <table class="border-collapse w-full">
            <thead>
                <tr>
                    <th class="p-3 font-bold uppercase bg-blue-200 text-gray-600 border border-gray-300 hidden md:table-cell">Voornaam</th>
                    <th class="p-3 font-bold uppercase bg-blue-200 text-gray-600 border border-gray-300 hidden md:table-cell">Achternaam</th>
                    <th class="p-3 font-bold uppercase bg-blue-200 text-gray-600 border border-gray-300 hidden md:table-cell">Speltak</th>
                    <th class="p-3 font-bold uppercase bg-blue-200 text-gray-600 border border-gray-300 hidden md:table-cell">Laatst bewerkt</th>
                    @can ('editGezForm', Auth::user())
                        <th class="p-3 font-bold uppercase bg-blue-200 text-gray-600 border border-gray-300 hidden md:table-cell">Acties</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="bg-white md:hover:bg-gray-100 flex md:table-row flex-row md:flex-row flex-wrap md:flex-no-wrap mb-10 md:mb-0 border-2 border-gray-300 md:border-0 md:border-gray-200">
                        <td class="w-full md:w-auto p-3 text-gray-800 text-center border border-b text-center block md:table-cell relative md:static">
                            <span class="md:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Voornaam</span>
                            {{$user->voornaam}}
                        </td>
                        <td class="w-full md:w-auto p-3 text-gray-800 text-center border border-b text-center block md:table-cell relative md:static">
                            <span class="md:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Achternaam</span>
                            {{$user->achternaam}}
                        </td>
                        <td class="w-full md:w-auto p-3 text-gray-800 text-center border border-b text-center block md:table-cell relative md:static">
                            <span class="md:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Speltak</span>
                            {{$user->speltak}}
                        </td>
                        <td class="w-full md:w-auto p-3 text-gray-800 text-center border border-b block md:table-cell relative md:static">
                            <span class="md:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Laatst bewerkt</span>
                            @if (date('Y', strtotime($user->updated_at)) < now()->year)
                                <span class="rounded bg-red-400 py-1 px-3 text-xs font-bold">{{date('Y', strtotime($user->updated_at))}}</span>
                            @else
                                <span class="rounded bg-green-400 py-1 px-3 text-xs font-bold">{{date('Y', strtotime($user->updated_at))}}</span>
                            @endif
                        </td>
                        @can ('editGezForm', Auth::user())
                            <td class="w-full md:w-auto p-3 text-gray-800 text-center border border-b text-center block md:table-cell relative md:static">
                                <span class="md:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Acties</span>
                                <a href="{{ route('gezforms.edit', ['id' => $user->id, 'category' => "algemeen"]) }}" class="text-blue-400 hover:text-blue-600 underline">Edit</a>
                                <a onclick="return confirm('Zeker weten?')" href="{{route('gezforms.delete', $user->id)}}" class="text-blue-400 hover:text-blue-600 underline pl-6">Remove</a>
                            </td>
                        @endcan 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

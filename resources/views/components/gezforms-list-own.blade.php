@props(['gezforms', 'errors'])

<div {{ $attributes }}>
    <!-- Create success -->
    <x-auth-create-success class="pb-0" />
    <!-- Delete success -->
    <x-auth-delete-success class="pb-0" :errors="$errors" />
    <div class="p-6 bg-white border-b border-gray-200">
        <h2 class="pb-4 pl-3 font-bold text-gray-800 text-xl">Formulieren:</h2>
        <table class="border-collapse w-full">
            <thead>
                <tr>
                    <th class="p-3 font-bold uppercase bg-blue-200 text-gray-600 border border-gray-300 hidden md:table-cell">Voornaam</th>
                    <th class="p-3 font-bold uppercase bg-blue-200 text-gray-600 border border-gray-300 hidden md:table-cell">Achternaam</th>
                    <th class="p-3 font-bold uppercase bg-blue-200 text-gray-600 border border-gray-300 hidden md:table-cell">Speltak</th>
                    <th class="p-3 font-bold uppercase bg-blue-200 text-gray-600 border border-gray-300 hidden md:table-cell">Laatst bewerkt</th>
                    <th class="p-3 font-bold uppercase bg-blue-200 text-gray-600 border border-gray-300 hidden md:table-cell">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gezforms as $gezform)
                    <tr class="bg-white md:hover:bg-gray-100 flex md:table-row flex-row md:flex-row flex-wrap md:flex-no-wrap mb-10 md:mb-0 border-2 border-gray-300 md:border-0 md:border-gray-200">
                        <td class="w-full md:w-auto p-3 text-gray-800 text-center border border-b text-center block md:table-cell relative md:static">
                            <span class="md:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Voornaam</span>
                            {{$gezform->voornaam}}
                        </td>
                        <td class="w-full md:w-auto p-3 text-gray-800 text-center border border-b text-center block md:table-cell relative md:static">
                            <span class="md:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Achternaam</span>
                            {{$gezform->achternaam}}
                        </td>
                        <td class="w-full md:w-auto p-3 text-gray-800 text-center border border-b text-center block md:table-cell relative md:static">
                            <span class="md:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Speltak</span>
                            {{$gezform->speltak}}
                        </td>
                        <td class="w-full md:w-auto p-3 text-gray-800 text-center border border-b block md:table-cell relative md:static">
                            <span class="md:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Laatst bewerkt</span>
                            @if (date('Y', strtotime($gezform->updated_at)) < now()->year)
                                <span class="rounded bg-red-400 py-1 px-3 text-xs font-bold">{{date('Y', strtotime($gezform->updated_at))}}</span>
                                @if ($gezform->gezforms_count > 1)
                                    <a onclick="return confirm('Zeker weten?')" href="{{route('gezforms.updateSame', $gezform->id)}}" class="text-blue-400 hover:text-blue-600 underline pl-6">Zelfde gegevens gebruiken als vorig jaar</a>
                                @endif
                            @else
                                <span class="rounded bg-green-400 py-1 px-3 text-xs font-bold">{{date('Y', strtotime($gezform->updated_at))}}</span>
                            @endif
                        </td>
                        <td class="w-full md:w-auto p-3 text-gray-800 text-center border border-b text-center block md:table-cell relative md:static">
                            <span class="md:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Acties</span>
                            <a href="{{ route('gezforms.edit', ['id' => $gezform->id, 'category' => "algemeen"]) }}" class="text-blue-400 hover:text-blue-600 underline">Edit</a>
                            <a onclick="return confirm('Zeker weten?')" href="{{route('gezforms.delete', $gezform->id)}}" class="text-blue-400 hover:text-blue-600 underline pl-6">Remove</a>
                        </td>
                    </tr>
                @endforeach
                <tr class="bg-blue-50 md:hover:bg-blue-100 flex md:table-row flex-row md:flex-row flex-wrap md:flex-no-wrap mb-10 md:mb-0 border-2 border-gray-300 md:border-0 md:border-gray-200">
                    <td colspan="4" class="w-full md:w-auto p-3 text-gray-800 text-center border border-b text-center block md:table-cell relative md:static">
                        <h2 class="font-bold text-gray-800 text-base">Voeg een gezondheidsformulier toe.</h2>
                    </td>
                    <td class="w-full md:w-auto p-3 text-gray-800 text-center border border-b text-center block md:table-cell relative md:static">
                        <button onclick="location.href='/gezforms/nieuw/algemeen'" class="text-green-500 hover:text-green-600 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 inline-flex items-center justify-center">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
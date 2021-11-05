<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gebruikers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @can ('viewRoles', Auth::user())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- Delete success -->
                    <x-auth-delete-success class="pb-0" :errors="$errors" />
                    <!-- Role change success -->
                    <x-auth-create-success class="pb-0" />
                    <div class="p-6 bg-white border-b border-gray-200">
                        <table class="border-collapse w-full">
                            <thead>
                                <tr>
                                    <th class="p-3 font-bold uppercase bg-blue-200 text-gray-600 border border-gray-300 hidden md:table-cell">Naam</th>
                                    <th class="p-3 font-bold uppercase bg-blue-200 text-gray-600 border border-gray-300 hidden md:table-cell">Email</th>
                                    <th class="p-3 font-bold uppercase bg-blue-200 text-gray-600 border border-gray-300 hidden md:table-cell">Rol</th>
                                    @can ('editRoles', Auth::user())
                                        <th class="p-3 font-bold uppercase bg-blue-200 text-gray-600 border border-gray-300 hidden md:table-cell">Acties</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="bg-white md:hover:bg-gray-100 flex md:table-row flex-row md:flex-row flex-wrap md:flex-no-wrap mb-10 md:mb-0 border-2 border-gray-300 md:border-0 md:border-gray-200">
                                        <td class="w-full md:w-auto p-3 text-gray-800 text-center border border-b block md:table-cell relative md:static">
                                            <span class="md:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Naam</span>
                                            {{$user->name}}
                                        </td>
                                        <td class="w-full md:w-auto p-3 text-gray-800 text-center border border-b text-center block md:table-cell relative md:static">
                                            <span class="md:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Email</span>
                                            {{$user->email}}
                                        </td>
                                        <td class="w-full md:w-auto p-3 text-gray-800 text-center border border-b text-center block md:table-cell relative md:static">
                                            <span class="md:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Rol</span>
                                            @if (Auth::user()->can('editRoles', Auth::user()))
                                                <form method="POST" action="{{route('gebruikers.edit.role', $user->id)}}">
                                                    @csrf
                                                    <select name="role" id="role" onchange="this.form.submit()"
                                                    @if($user->role == "admin")class="rounded bg-green-400 py-1 pl-2 pr-6 text-xs text-center font-bold"@endif
                                                    @if($user->role == "mod")class="rounded bg-yellow-400 py-1 pl-2 pr-6 text-xs text-center font-bold"@endif
                                                    @if($user->role == "user")class="rounded bg-red-400 py-1 pl-2 pr-6 text-xs text-center font-bold"@endif>
                                                        <option class="bg-green-400" @if($user->role=="admin") selected @endif value="admin">Admin</option>
                                                        <option class="bg-yellow-400" @if($user->role=="mod") selected @endif value="mod">Mod</option>
                                                        <option class="bg-red-400" @if($user->role=="user") selected @endif value="user">User</option>
                                                    </select>
                                                </form>
                                            @else
                                                <span 
                                                @if($user->role == "admin")class="rounded bg-green-400 py-1 px-3 text-xs text-center font-bold"@endif
                                                @if($user->role == "mod")class="rounded bg-yellow-400 py-1 px-3 text-xs text-center font-bold"@endif
                                                @if($user->role == "user")class="rounded bg-red-400 py-1 px-3 text-xs text-center font-bold"@endif
                                                >{{$user->role}}</span>
                                            @endif
                                        </td>
                                        @can ('editRoles', Auth::user())
                                            <td class="w-full md:w-auto p-3 text-gray-800 text-center border border-b text-center block md:table-cell relative md:static">
                                                <span class="md:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Acties</span>
                                                <a href="{{ route('gebruikers.edit', ['id' => $user->id]) }}" class="text-blue-400 hover:text-blue-600 underline">Edit</a>
                                                <a onclick="return confirm('Zeker weten?')" href="{{route('gebruikers.delete', $user->id)}}" class="text-blue-400 hover:text-blue-600 underline pl-6">Remove</a>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endcan
        </div>
        
        @can ('editRoles', Auth::user())
            @if (Route::is('gebruikers.edit') && !empty($userToEdit))
                <div class="max-w-md mx-auto sm:px-6 lg:px-8 mt-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="text-lg">Pas de gegevens aan:</h2>
                            <div class="space-y-4 w-full pt-4 text-gray-500 items-center">
                                <form method="POST" action="saved">
                                    @csrf
                                    <!-- Id -->
                                    <input type="hidden" value="{{$userToEdit->id}}" name="id">
                                    <!-- Naam -->
                                    <div>
                                        <x-label for="name" :value="__('Naam')" />
                                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required value="{{$userToEdit->name}}" />
                                    </div>
                                    <!-- Email -->
                                    <div class="mt-4">
                                        <x-label for="email" :value="__('Email')" />
                                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required value="{{$userToEdit->email}}"/>
                                    </div>
                                    <!-- Rol -->
                                    <div class="mt-4">
                                        <x-label for="role" :value="__('Rol')" />
                                        <select name="role" id="role" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            <option @if($userToEdit->role=="admin") selected @endif value="admin">Admin</option>
                                            <option @if($userToEdit->role=="mod") selected @endif value="mod">Mod</option>
                                            <option @if($userToEdit->role=="user") selected @endif value="user">User</option>
                                        </select>
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
                                        <a class="ml-3 bg-red-400 hover:bg-red-700 active:bg-red-900 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" onclick="return confirm('Zeker weten?')" href="{{route('gebruikers.delete', $userToEdit->id)}}">Delete</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endcan
    </div>
</x-app-layout>

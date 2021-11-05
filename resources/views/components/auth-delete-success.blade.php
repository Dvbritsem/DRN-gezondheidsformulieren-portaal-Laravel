@props(['errors'])

@if ($errors->any())
    <div class="p-6 -mb-6">
        <div class="bg-green-200 px-6 py-4 rounded-md text-lg flex items-center w-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>

            <span class="text-green-800">
                <div {{ $attributes }}>
                    <div class="font-medium text-green-600">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                </div>
            </span>
        </div>
    </div>
@endif
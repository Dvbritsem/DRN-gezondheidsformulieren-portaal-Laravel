<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

<div class="space-y-4 w-full text-gray-500 items-center">
    <form method="POST" action="opslaan">
        <div class="flex justify-center">
            <div class="w-2/3">
                <x-label for="signature" class="text-xl" :value="__('Handtekening')" />
                <div id="sig" class="w-full h-32 relative border border-gray-700">
                    <button id="clear" class="absolute bottom-0 right-0 bg-red-400 hover:bg-red-700 active:bg-red-900 inline-flex items-center px-2 py-1 border border-transparent font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Clear</button>
                </div>
                <textarea id="signature" name="signed" style="display: none" class="w-full h-32 relative border border-gray-700"></textarea>
            </div>
        </div>
        <div class="flex items-center justify-center mt-5 pr-4">
            @csrf
            <x-button class="ml-3 bg-blue-400 hover:bg-blue-700 active:bg-blue-900">
                {{ __('Opslaan') }}
            </x-button>
            <a onclick="return confirm('Zeker weten?')" href="{{route('gezforms.afbreken')}}" class="ml-3 bg-red-400 hover:bg-red-700 active:bg-red-900 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Afbreken</a>
        </div>
    </form>
</div>

<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature', syncFormat: 'PNG'});
    $('#clear').click(function (e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>
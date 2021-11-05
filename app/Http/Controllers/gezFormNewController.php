<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\GezForm;
use App\Models\GezWarnadres;
use App\Models\GezMedischeGegevens;

class GezFormNewController extends Controller
{
    public function view($category) {
        if (session()->has('AlgemeenDone') && !session()->has('AdressenDone')) {
            if ($category != "adressen") {
                $category = "adressen";
                return redirect("/gezforms/nieuw/{$category}");
            }

            return view('pages.gezforms-create', [
                'category' => 'adressen',
            ]);
        }
        if (session()->has('AdressenDone') && !session()->has('Medische-GegevensDone')) {
            if ($category != "medische-gegevens") {
                $category = "medische-gegevens";
                return redirect("/gezforms/nieuw/{$category}");
            }

            return view('pages.gezforms-create', [
                'category' => 'medische-gegevens',
            ]);
        }
        if (session()->has('Medische-GegevensDone')) {
            if ($category != "opslaan") {
                $category = "opslaan";
                return redirect("/gezforms/nieuw/{$category}");
            }

            return view('pages.gezforms-create', [
                'category' => 'opslaan',
            ]);
        }
                
        return view('pages.gezforms-create', [
            'category' => 'algemeen',
        ]);
    }

    public function cancel() {
        session()->forget([
            'GezformAlgemeen',
            'AlgemeenDone',
            'GezformAdressen1',
            'GezformAdressen2',
            'AdressenDone',
            'GezformMedischeGegevens',
            'Medische-GegevensDone',
        ]);

        return redirect()->route('gezforms');
    }

    public function createAlgemeen(Request $request) {
        if ($request->input('opmerkingen') == null) {
            $opmerking = "";
        }
        else {
            $opmerking = $request->input('opmerkingen');
        }

        $newGezform = [
            'user_id' => $request->input('id'),
            'voornaam' => $request->input('voornaam'),
            'achternaam' => $request->input('achternaam'),
            'speltak' => $request->input('speltak'),
            'geboortedatum' => $request->input('geboortedatum'),
            'magzwemmen' => $request->input('magzwemmen'),
            'zwemdiplomas' => $request->input('zwemdiplomas'),
            'heimwee' => $request->input('heimwee'),
            'magzwemmen' => $request->input('magzwemmen'),
            'tandarts_naam' => $request->input('tandarts_naam'),
            'tandarts_nummer' => $request->input('tandarts_nummer'),
            'ziektekostenverzekering_maatschappij' => $request->input('ziektekostenverzekering_maatschappij'),
            'ziektekostenverzekering_polisnummer' => $request->input('ziektekostenverzekering_polisnummer'),
            'opmerkingen' => $opmerking,
        ];

        session([
            'GezformAlgemeen' => $newGezform,
            'AlgemeenDone' => 'Done',
        ]);

        $category = "adressen";
        return redirect("/gezforms/nieuw/{$category}");
    }

    public function createAdressen(Request $request) {
        $newGezformAdres1 = [
            'nummer' => '1',
            'voornaam' => $request->input('voornaam1'),
            'achternaam' => $request->input('achternaam1'),
            'relatie_kind' => $request->input('relatie_kind1'),
            'adres' => $request->input('adres1'),
            'woonplaats' => $request->input('woonplaats1'),
            'achternaam' => $request->input('achternaam1'),
            'vast_tel_nummer' => $request->input('vast_tel_nummer1'),
            'mobiel_tel_nummer' => $request->input('mobiel_tel_nummer1'),
        ];

        $newGezformAdres2 = [
            'nummer' => '2',
            'voornaam' => $request->input('voornaam2'),
            'achternaam' => $request->input('achternaam2'),
            'relatie_kind' => $request->input('relatie_kind2'),
            'adres' => $request->input('adres2'),
            'woonplaats' => $request->input('woonplaats2'),
            'achternaam' => $request->input('achternaam2'),
            'vast_tel_nummer' => $request->input('vast_tel_nummer2'),
            'mobiel_tel_nummer' => $request->input('mobiel_tel_nummer2'),
        ];

        session([
            'GezformAdressen1' => $newGezformAdres1,
            'GezformAdressen2' => $newGezformAdres2,
            'AdressenDone' => 'Done',
        ]);

        $category = "medische-gegevens";
        return redirect("/gezforms/nieuw/{$category}");
    }

    public function createMedischegegevens(Request $request) {
        $newInputs = [];

        foreach ($request->input() as $input => $value) {
            if (!$value) {
                $value = "";
            }
            $newInputs[$input] = $value;
        }

        $newGezformMedischeGegevens = [
            'allergieën' => $newInputs['allergieën'],
            'medicijnen_gebruik' => $newInputs['medicijnen_gebruik'],
            'medicijnen_niet' => $newInputs['medicijnen_niet'],
            'dieet' => $newInputs['dieet'],
            'vaccinatie' => $newInputs['vaccinatie'],
            'syndroom' => $newInputs['syndroom'],
        ];

        session([
            'GezformMedischeGegevens' => $newGezformMedischeGegevens,
            'Medische-GegevensDone' => 'Done',
        ]);

        $category = "opslaan";
        return redirect("/gezforms/nieuw/{$category}");
    }

    public function store(Request $request) {
        $medischegegevens = session('GezformMedischeGegevens');
        $adres1 = session('GezformAdressen1');
        $adres2 = session('GezformAdressen2');
        $algemeen = session('GezformAlgemeen');

        $gezform = GezForm::create($algemeen);
    
        $adres1['gez_form_id'] = $gezform->id;
        $adres2['gez_form_id'] = $gezform->id;

        $gezformAdres1 = GezWarnadres::create($adres1);
        $gezformAdres2 = GezWarnadres::create($adres2);

        $medischegegevens['gez_form_id'] = $gezform->id;

        $gezformMedischeGegevens = GezMedischeGegevens::create($medischegegevens);

        $folderPath = storage_path('signatures/');
        $image_parts = explode(";base64,", $request->signed);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . 'gezform-id=' . $gezform->id . '.' . $image_type;
        file_put_contents($file, $image_base64);

        $newCount = User::find(Auth::user()->id, ['gezforms_count']);
        $newGezformCount = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'gezforms_count' => $newCount->gezforms_count + 1,
            ]);

        session()->forget([
            'GezformAlgemeen',
            'AlgemeenDone',
            'GezformAdressen1',
            'GezformAdressen2',
            'AdressenDone',
            'GezformMedischeGegevens',
            'Medische-GegevensDone',
        ]);

        return redirect()->route('gezforms')->with('success', 'gezondheidsformulier is aangemaakt.');
    }
}

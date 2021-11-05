<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\GezForm;
use App\Models\GezWarnadres;
use App\Models\GezMedischeGegevens;

class GezFormEditController extends Controller
{
    public function view($id, $category) {
        $checkId = DB::table('gez_forms')
            ->select('id')
            ->where('id', $id)
            ->get();
        if ($checkId->count() === 0) {
            abort(404);
        }

        $checkIfOwnId = DB::table('gez_forms')
            ->select('user_id')
            ->where('id', $id)
            ->get();
        if (Auth::user()->cannot('editGezForm', Auth::user()) && $checkIfOwnId[0]->user_id !== Auth::user()->id) {
            abort(403);
        }

        if ($category != "algemeen" && $category != "adressen" && $category != "medische-gegevens" && $category != "overige") {
            $category = "algemeen";
            return redirect("/gezforms/edit/{$id}/{$category}");
        }

        if ($category == "algemeen") {
            $data = DB::table('gez_forms')
                ->where('id', $id)
                ->get();
        }
        if ($category == "adressen") {
            $data[0] = DB::table('gez_warnadres')
                ->where('gez_form_id', $id)
                ->get();
        }
        if ($category == "medische-gegevens") {
            $data = DB::table('gez_medische_gegevens')
                ->where('gez_form_id', $id)
                ->get();
        }
        if ($category == "overige") {
            $data = DB::table('gez_forms')
                ->select('id', 'created_at', 'updated_at')
                ->where('id', $id)
                ->get();
        }

        return view('pages.gezforms-edit', [
            'id' => $id,
            'category' => $category,
            'data' => $data[0],
        ]);
    }

    public function editAlgemeen(Request $request, $id) {
        if ($request->input('opmerkingen') == null) {
            $opmerking = "";
        }
        else {
            $opmerking = $request->input('opmerkingen');
        }

        $newAlgemeen = DB::table('gez_forms')
            ->where('id', $id)
            ->update([
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
            ]);

        GezForm::find($id)->touch();

        return redirect()->route('gezforms.edit', [$id, 'algemeen'])->with('newgezformdata', 'gelukt');
    }

    public function editAdressen(Request $request, $id) {
        $newAdres1 = DB::table('gez_warnadres')
            ->where('gez_form_id', $id)
            ->where('nummer', '1')
            ->update([
                'voornaam' => $request->input('voornaam1'),
                'achternaam' => $request->input('achternaam1'),
                'relatie_kind' => $request->input('relatie_kind1'),
                'adres' => $request->input('adres1'),
                'woonplaats' => $request->input('woonplaats1'),
                'achternaam' => $request->input('achternaam1'),
                'vast_tel_nummer' => $request->input('vast_tel_nummer1'),
                'mobiel_tel_nummer' => $request->input('mobiel_tel_nummer1'),
            ]);

        $newAdres2 = DB::table('gez_warnadres')
            ->where('gez_form_id', $id)
            ->where('nummer', '2')
            ->update([
                'voornaam' => $request->input('voornaam2'),
                'achternaam' => $request->input('achternaam2'),
                'relatie_kind' => $request->input('relatie_kind2'),
                'adres' => $request->input('adres2'),
                'woonplaats' => $request->input('woonplaats2'),
                'achternaam' => $request->input('achternaam2'),
                'vast_tel_nummer' => $request->input('vast_tel_nummer2'),
                'mobiel_tel_nummer' => $request->input('mobiel_tel_nummer2'),
            ]);

        GezForm::find($id)->touch();

        return redirect()->route('gezforms.edit', [$id, 'adressen'])->with('newgezformdata', 'gelukt');
    }

    public function editMedischegegevens(Request $request, $id) {
        $newInputs = [];

        foreach ($request->input() as $input => $value) {
            if (!$value) {
                $value = "";
            }
            $newInputs[$input] = $value;
        }

        $newMedischeGegevens = DB::table('gez_medische_gegevens')
            ->where('gez_form_id', $id)
            ->update([
                'allergieën' => $newInputs['allergieën'],
                'medicijnen_gebruik' => $newInputs['medicijnen_gebruik'],
                'medicijnen_niet' => $newInputs['medicijnen_niet'],
                'dieet' => $newInputs['dieet'],
                'vaccinatie' => $newInputs['vaccinatie'],
                'syndroom' => $newInputs['syndroom'],
            ]);

        GezForm::find($id)->touch();

        return redirect()->route('gezforms.edit', [$id, 'medische-gegevens'])->with('newgezformdata', 'gelukt');
    }

    public function delete($id) {
        $checkId = DB::table('gez_forms')
            ->select('id')
            ->where('id', $id)
            ->get();
        if ($checkId->count() === 0) {
            abort(404);
        }

        $checkIfOwnId = DB::table('gez_forms')
            ->select('user_id')
            ->where('id', $id)
            ->get();
        if (Auth::user()->cannot('editGezForm', Auth::user()) && $checkIfOwnId[0]->user_id !== Auth::user()->id) {
            abort(403);
        }

        $deleteAlgemeen = DB::table('gez_forms')
            ->where('id', $id)
            ->delete();

        $deleteAdres1 = DB::table('gez_warnadres')
            ->where('gez_form_id', $id)
            ->where('nummer', '1')
            ->delete();

        $deleteAdres2 = DB::table('gez_warnadres')
            ->where('gez_form_id', $id)
            ->where('nummer', '2')
            ->delete();

        $deleteMedischeGegevens = DB::table('gez_medische_gegevens')
            ->where('gez_form_id', $id)
            ->delete();

        if (Storage::disk('local_storage')->exists('gezform-id='.$id.'.png')) {
            $signature = Storage::disk('local_storage')->delete('gezform-id='.$id.'.png');
        }

        $newCount = User::find($checkIfOwnId[0]->user_id, ['gezforms_count']);
        $newGezformCount = DB::table('users')
            ->where('id', $checkIfOwnId[0]->user_id)
            ->update([
                'gezforms_count' => $newCount->gezforms_count - 1,
            ]);
        
        return redirect()->route('gezforms')->withErrors([
            'user' => ['Gezondheidsformulier verwijderd']
        ]);
    }
}

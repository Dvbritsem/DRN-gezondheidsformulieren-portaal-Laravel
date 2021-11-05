<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\GezForm;
use App\Models\GezWarnadres;

class GezFormController extends Controller
{
    public function view(Request $request) {
        if (Auth::user()->can('viewGezForm', Auth::user())) {
            $users = DB::table('users')
                ->join('gez_forms', 'users.id', '=', 'gez_forms.user_id')
                ->select('gez_forms.id', 'gez_forms.updated_at', 'users.name', 'gez_forms.voornaam', 'gez_forms.achternaam', 'gez_forms.speltak')
                ->get();

            $filter = [
                'name' => '',
                'speltak' => '',
            ];
            if ($request->has('filter')) {
                if ($request->input('speltak')) {
                    $users = collect($users)->where('speltak', $request->input('speltak'))->all();
                }
                if ($request->input('name')) {
                    $users = collect($users)->filter(function ($user) use ($request) {
                        return Str::contains($user->voornaam, $request->input('name')) || Str::contains($user->achternaam, $request->input('name'));
                    })->all();
                }
                $filter = [
                    'name' => $request->input('name'),
                    'speltak' => $request->input('speltak'),
                ];
            }

            $gezforms = DB::table('users')
                ->join('gez_forms', 'users.id', '=', 'gez_forms.user_id')
                ->select('gez_forms.id', 'users.gezforms_count', 'gez_forms.updated_at', 'gez_forms.voornaam', 'gez_forms.achternaam', 'gez_forms.speltak')
                ->where('users.id', Auth::user()->id)
                ->get();

            return view('pages.gezforms', [
                'users' => $users,
                'gezforms' => $gezforms,
            ])->with($filter);
        }
        else {
            $gezforms = DB::table('users')
                ->join('gez_forms', 'users.id', '=', 'gez_forms.user_id')
                ->select('gez_forms.id', 'users.gezforms_count', 'gez_forms.updated_at', 'gez_forms.voornaam', 'gez_forms.achternaam', 'gez_forms.speltak')
                ->where('users.id', Auth::user()->id)
                ->get();

            if (!$gezforms->count() > 0) {
                $gezforms = [];
            }

            return view('pages.gezforms', [
                'gezforms' => $gezforms,
            ]);
        }
    }

    public function updateSame($id) {
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

        GezForm::find($id)->touch();

        return redirect()->route('gezforms')->withErrors([
            'user' => ['Gezondheidsformulier is gecontroleerd!']
        ]);
    }
}

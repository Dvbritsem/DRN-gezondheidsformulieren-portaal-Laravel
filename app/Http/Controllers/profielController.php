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

class profielController extends Controller
{
    public function show() {
        $user = DB::table('users')
            ->select('name', 'email')
            ->where('id', Auth::user()->id)
            ->limit(1)
            ->get();

        return view('pages.profiel', [
            'user' => $user[0],
        ]);
    }

    public function store(Request $request) {
        $user = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'name' => $request->input('name'),
                'email' => $request->input('email')
            ]);

        return redirect()->back()->with('newuserdata', 'gelukt');
    }

    public function newPassword(Request $request) {
        if (!Hash::check($request->input('oldpassword'), Auth::user()->password)) {
            return back()->withErrors([
                'password' => ['Wachtwoord klopt niet!']
            ]);
        }

        $request->validate([
            'newpassword' => 'string|min:4',
        ]);

        $request->user()->fill([
            'password' => Hash::make($request->input('newpassword'))
        ])->save();

        return redirect()->back()->with('newpassword', 'gelukt');
    }

    public function delete() {
        // Delete gezforms from user //
        //* Nog doen *//

        $user = DB::table('users')
            ->where('id', Auth::user()->id)
            ->delete();

        Auth::logout();

        return redirect(url('login'));
    }
}

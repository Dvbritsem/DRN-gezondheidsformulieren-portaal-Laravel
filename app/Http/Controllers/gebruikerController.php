<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class gebruikerController extends Controller
{
    public function view() {
        if (Auth::user()->cannot('viewRoles', Auth::user())) {
            abort(403);
        }

        $users = DB::table('users')
            ->select('id', 'name', 'email', 'role')
            ->get();

        return view('pages.gebruikers', [
            'users' => $users,
        ]);
    }

    public function viewEdit($id) {
        if (Auth::user()->cannot('editRoles', Auth::user())) {
            abort(403);
        }

        $users = DB::table('users')
            ->select('id', 'name', 'email', 'role')
            ->get();

        $userToEdit = DB::table('users')
            ->select('id', 'name', 'email', 'role')
            ->where('id', $id)
            ->get();

        return view('pages.gebruikers', [
            'users' => $users,
            'userToEdit' => $userToEdit[0],
        ]);
    }

    public function edit(Request $request) {
        if (Auth::user()->cannot('editRoles', Auth::user())) {
            abort(403);
        }

        $userToEdit = DB::table('users')
            ->where('id', $request->input('id'))
            ->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role' => $request->input('role')
            ]);

        return redirect()->back()->with('newuserdata', 'gelukt');
    }

    public function delete($id) {
        if (Auth::user()->cannot('editRoles', Auth::user())) {
            abort(403);
        }

        $userToDelete = DB::table('users')
            ->where('id', $id)
            ->delete();
        
        return redirect()->route('gebruikers')->withErrors([
            'user' => ['Gebruiker verwijderd']
        ]);
    }

    public function editRole(Request $request, $id) {
        if (Auth::user()->cannot('editRoles', Auth::user())) {
            abort(403);
        }

        $userToEdit = DB::table('users')
            ->where('id', $id)
            ->update([
                'role' => $request->input('role'),
            ]);

        $user = User::where('id', $id)->select('name', 'role')->get();

        if (Auth::user()->role == 'user') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('success', 'Rol van '.$user[0]->name.' is veranderd naar '.$user[0]->role.'.');
        }
    }
}

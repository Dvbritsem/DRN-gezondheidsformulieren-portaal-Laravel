<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class fileController extends Controller
{
    public function index($filePath) {
        if (Auth::user()->cannot('editGezForm', Auth::user())) {
            abort(403);
        }

        if (!Storage::disk('local_storage')->exists($filePath)) {
            abort('404');
        }

        return response()->file(storage_path('signatures'.DIRECTORY_SEPARATOR.($filePath)));
    }
}

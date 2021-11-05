<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class pdfController extends Controller
{
    public function gezformPdf($id) {
        if (Auth::user()->cannot('editGezForm', Auth::user())) {
            abort(403);
        }

        $gezform = DB::table('gez_forms')
            ->where('id', $id)
            ->get();

        $pdf = PDF::loadView('pdf.gezondheidsformulier', ['gezform' => $gezform[0]])->setPaper('a4', 'landscape');
        return $pdf->download('gezondheidsformulier_'.$gezform[0]->voornaam.$gezform[0]->achternaam.'.pdf');
    }
}

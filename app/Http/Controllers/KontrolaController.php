<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\KontrolniPregled;


class KontrolaController extends Controller
{

    public function store(Request $request) 
    { 
        $pregled = new KontrolniPregled();
        $pregled -> termin = $request->termin;
        $pregled -> trudnoca_id= $request->trudnoca_id;
        try {
            ($pregled->save());
            return redirect()->back()->with('success', 'Uspješno dodano!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }

    public function update(Request $request) 
    { 
        $idK = $request->idK;
        $hemoglobin = $request->hemoglobin;
        $estriol = $request->estriol; 
        $beta = $request->beta; 

        KontrolniPregled::where('kontrola_id', $idK)->update([
            'hemoglobin' => $hemoglobin,
            'estriol' => $estriol,
            'beta_hCG' => $beta,
        ]);
        return redirect()->back();
    } 
}

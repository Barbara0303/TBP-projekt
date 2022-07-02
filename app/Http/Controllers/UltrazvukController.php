<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ultrazvuk;

class UltrazvukController extends Controller
{

    public function store(Request $request) 
    { 
        $ultrazvuk = new Ultrazvuk();
        $ultrazvuk -> termin = $request->terminUZ;
        $ultrazvuk -> trudnoca_id= $request->trudnocaIDUZ;
        $ultrazvuk -> napomene = $request->napomene;
        try {
            ($ultrazvuk->save());
            return redirect()->back()->with('success', 'Uspješno dodano!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }
}

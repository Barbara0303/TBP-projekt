<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Trudnoca;
use App\Models\Dijete;
use App\Models\Trudnica;
use PhpParser\Node\Stmt\TryCatch;
use function PHPUnit\Framework\throwException;

class TrudnocaController extends Controller
{

    public function index($trudnoca_id)
    {
        $trudnoca = Trudnoca::where('trudnoca_id',$trudnoca_id)->first();
        $bebe = DB::select("select * from dijete where trudnoca_id = $trudnoca_id order by dijete desc");
        $krvneGrupe = DB::select('select * from krvna_grupa');
        $trudnica_id = DB::select("select trudnica_id from trudnoca where trudnoca_id = $trudnoca_id");
        $trudnica_id= json_decode( json_encode($trudnica_id), true);
        $trudnica = Trudnica::where('trudnica_id',$trudnica_id)->first();
        return view('bebe.index', ['trudnoca' => $trudnoca, 'bebe' => $bebe, 'krvneGrupe' => $krvneGrupe, 'trudnica' => $trudnica]);
    } 

    public function store(Request $request) 
    { 
        $trudnoca = new Trudnoca();
        $trudnoca -> trudnica_id = $request->idTr;
        if($request->pocetak) {
            $trudnoca->pocetak_trudnoce = $request->pocetak;
        }
        try {
            ($trudnoca->save());
            return redirect()->back()->with('success', 'Uspješno dodana trudnoća!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Nije moguće dodati novu trudnoću.');
        } 


    }
    public function add(Request $request) 
    { 
        $dijete = new Dijete();
        $dijete -> spol = $request->spol;
        $dijete -> duzina = $request->duzina;
        $dijete -> tezina = $request->tezina;
        $dijete -> genetske_anomalije = $request->genetskAnomalije;
        $dijete -> trudnoca_id = $request->trudId;
        try {
            ($dijete->save());
            return redirect()->back()->with('success', 'Uspješno dodano!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } 

    }

    public function update(Request $request) 
    { 
        $idDijete = $request->dijeteId;
        $spol = $request->spol;
        $tezina = $request->tezina; 
        $duzina = $request->duzina; 
        $genetske = $request->genetskeAnomalije; 
        $krvnaGrupa = $request->krvna_grupa; 

        try{
        Dijete::where('dijete_id', $idDijete)->update([
            'spol' => $spol,
            'tezina' => $tezina,
            'duzina' => $duzina,
            'genetske_anomalije' => $genetske,
            'krvna_grupa_id' => $krvnaGrupa,
        ]);
        return redirect()->back()->with('success', 'Uspješno ažurirano!');
    } catch (\Exception $e) {   return redirect()->back()->with('error', $e->getMessage()); };

    }
}

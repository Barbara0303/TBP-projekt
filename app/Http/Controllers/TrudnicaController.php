<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Trudnica;
use App\Models\Bolest;
use App\Models\BolestiTrudnice;
use App\Models\KrvnaGrupa;
use App\Models\Trudnoca;
use Illuminate\Support\Facades\Date;
use PhpParser\Node\Stmt\TryCatch;
use function PHPUnit\Framework\throwException;

class TrudnicaController extends Controller
{
    public function index()
    {
        $trudnice = DB::select('select * from trudnica');
        $krvneGrupe = DB::select('select * from krvna_grupa');
        return view('trudnica.index', ['trudnice' => $trudnice,'krvneGrupe' => $krvneGrupe]);
    }

    public function store(Request $request) 
    { 
        $trudnica = new Trudnica();
        $trudnica -> ime= $request->ime;
        $trudnica -> prezime = $request->prezime;
        $trudnica -> oib= $request->oib;
        $trudnica -> kontakt_broj= $request->kontaktBroj;
        $trudnica -> email= $request->email;
        $trudnica -> visina= $request->visina;
        $trudnica -> tezina= $request->tezina;
        $trudnica -> krvna_grupa_id= $request->krvna_grupa;
        $trudnica -> datum_rodenja= $request->datum;
        $trudnica -> zadnja_mjesecnica= $request->mjesecnica;
        $trudnica -> trajanje_ciklusa= $request->ciklus;
        $trudnica -> ginekolog_id= 1;
        try {
            ($trudnica->save());
            return redirect()->back()->with('success', 'Uspješno dodana pacijentica!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Krivi unos podataka.');
            
        } 
    }

    public function details($trudnica_id)
    {
        $trudnica = Trudnica::where('trudnica_id',$trudnica_id)->first();
        $trudnoca = Trudnoca::where('trudnica_id',$trudnica_id)->orderBy('trudnoca_id', 'desc')->first();
        $krvnaGrupa = KrvnaGrupa::where('id',$trudnica->krvna_grupa_id)->first();
        $bolestiTrudnice = DB::select("select naziv from bolesti b, bolesti_trudnice bt where bt.trudnica_id = $trudnica_id and b.bolest_id = bt.bolest_id");
        $bolesti = Bolest::all();
        $trudnoce = DB::select("select * from trudnoca where trudnica_id= $trudnica_id");
        if($trudnoca)  {
            $trudnoca_id = $trudnoca->trudnoca_id;
            $kontrolniPregledi = DB::select("select * from kontrolni_pregled where trudnoca_id = $trudnoca_id");
            $ultrazvuk = DB::select("select * from ultrazvuk where trudnoca_id= $trudnoca_id order by termin");
            return view('trudnica.details', ['trudnica' => $trudnica,
            'krvnaGrupa' => $krvnaGrupa, 'bolestiTrudnice' => $bolestiTrudnice,
            'bolesti' => $bolesti, 'trudnoca' => $trudnoce, 'kontrolniPregledi' => $kontrolniPregledi,
            'ultrazvuk' => $ultrazvuk]);
        } else {
            return view('trudnica.details', ['trudnica' => $trudnica,
            'krvnaGrupa' => $krvnaGrupa, 'bolestiTrudnice' => $bolestiTrudnice,
            'bolesti' => $bolesti, 'trudnoca' => $trudnoce]);
        }


    }
  
}

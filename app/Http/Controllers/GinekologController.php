<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Ginekolog;
use PhpParser\Node\Stmt\TryCatch;

use function PHPUnit\Framework\throwException;

class GinekologController extends Controller
{
    public function index()
    {
        $ginekolog = DB::select('select * from ginekolog');
        return view('welcome', ['ginekolog' => $ginekolog]);
    }

    public function store(Request $request)
    {
        $ginekolog = new Ginekolog();
        $ginekolog -> lozinka= $request->lozinka;
        $ginekolog -> ime = $request->ime;
        $ginekolog -> prezime= $request->prezime;
        $ginekolog -> email= $request->email;
        try {
            ($ginekolog->save());
            return redirect()->back();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }
  
}

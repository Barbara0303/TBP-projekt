<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bolest;
use App\Models\BolestiTrudnice;
use PhpParser\Node\Stmt\TryCatch;

use function PHPUnit\Framework\throwException;

class BolestiController extends Controller
{
    public function store(Request $request)
    {
        $bolest = new BolestiTrudnice();
        $bolest -> trudnica_id= $request->id;
        $bolest -> bolest_id= $request->bolest_id;

        try {
            ($bolest->save());
            return redirect()->back()->with('success', 'Uspješno dodano!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Nemoguće dodati navedenu dijagnozu!');
        }

    }
  
}

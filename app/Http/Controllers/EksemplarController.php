<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EksemplarController extends Controller
{
  
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
     $sql = "CALL ShowAllBukuOnlyIdAndJudul()";
     $kumpulanBuku = DB::select($sql);
     return view ('tambahEksemplar',compact('kumpulanBuku'));
  }

  public function tambahEksemplar(Request $request){
    $idBuku = $request->input('namaBuku');
    $kodeEksemplar = $request->input('kodeEksemplar');
    DB::select("CALL tambahEksemplar('$kodeEksemplar','$idBuku')");
    $sql = "CALL ShowAllBukuOnlyIdAndJudul()";
    $kumpulanBuku = DB::select($sql);
    return view ('tambahEksemplar',compact('kumpulanBuku'));
  }
}
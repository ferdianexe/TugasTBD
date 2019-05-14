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
     $success = FALSE;
     $error = FALSE;
     return view ('tambahEksemplar',compact('kumpulanBuku','success','error'));
  }

  public function tambahEksemplar(Request $request){
    $success = FALSE;
    $error = FALSE;
    if($request->has('namaBuku') && $request->has('kodeEksemplar')){
      $idBuku = $request->input('namaBuku');
      $kodeEksemplar = $request->input('kodeEksemplar');
      DB::select("CALL tambahEksemplar('$kodeEksemplar','$idBuku')");
      $success = TRUE ;
    }else{
      $error = TRUE;
    }
    $sql = "CALL ShowAllBukuOnlyIdAndJudul()";
    $kumpulanBuku = DB::select($sql);
    return view ('tambahEksemplar',compact('kumpulanBuku','success','error'));
  }
}
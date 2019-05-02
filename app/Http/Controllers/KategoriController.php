<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
class KategoriController extends Controller
{
  
    
  public function showAllCategory()
  {
    $kumpulanKategori = DB::select("CALL ShowAllCategory()");
    return view('tambahKategori', compact('kumpulanKategori'));;
  }

  public function insertKategori(Request $request)
  {
    $namaKategori = $request->input('kategoriBaru');
    $insert = DB::select("CALL insertKategori('$namaKategori')");
    return redirect()->route('tambahKategori');
  }

  public function showKategoriFavorit(){
    $isAdmin = FALSE;
    if(Auth::user()->hakStatus==1){
      $isAdmin = TRUE;  
    }
    $kumpulanKategori = DB::select("CALL TagTerfavorit()");
    return view ('TampilanKategoriFavorite',compact('kumpulanKategori','isAdmin'));
  }
}
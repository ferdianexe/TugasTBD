<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RekomendasiController extends Controller
{
  
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */


  function buatRekomendasi()
  {
    $isAdmin = FALSE;
    if(Auth::user()->hakStatus==1){
      $isAdmin = TRUE;
    }
    if($isAdmin){
      DB::select("CALL MakeRecommendation()");
    }
    return redirect()->route('pinjamanBuku');
  }

}
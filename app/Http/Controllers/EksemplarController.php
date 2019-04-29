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
}
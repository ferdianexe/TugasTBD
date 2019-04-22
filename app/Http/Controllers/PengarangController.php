<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class PengarangController extends Controller
{
  
    
  public function showAllPengarang()
  {
    $kumpulanPengarang = DB::select("CALL ShowAllPengarang()");
    return view('tambahPengarang',compact('kumpulanPengarang'));;
  }
}
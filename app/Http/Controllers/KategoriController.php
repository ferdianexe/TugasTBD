<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class KategoriController extends Controller
{
  
    
  public function showAllCategory()
  {
    $kumpulanKategori = DB::select("CALL ShowAllCategory()");
    return view('tambahKategori',compact('kumpulanKategori'));;
  }
}
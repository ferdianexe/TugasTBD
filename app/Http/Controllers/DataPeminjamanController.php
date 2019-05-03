<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;
class DataPeminjamanController extends Controller
{
  
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Request $request)
  {
    $isAdmin = FALSE;
    if(Auth::user()->hakStatus==1){
      $isAdmin = TRUE;  
    }
    $page = 0 ;
    if($request->has('page')){
      $page = $request->input('page');
    }
    
    if($isAdmin){
      $sql = "CALL ShowPeminjaman (0)";
      $sql2 = "CALL ShowPeminjamanWithOffset (0,'$page')";
    }else{
      $id = Auth::user()->id;
      $sql = "CALL ShowPeminjaman ('$id')";
      $sql2 = "CALL ShowPeminjamanWithOffset ('$id','$page')";
    }
    
    $kumpulanPeminjaman = DB::select($sql);
    $counter = ceil((count($kumpulanPeminjaman)*1.0)/10)-1;
    $paginationPage = array();
    $previousPage = array();
    $startVal = (int)($page/10);
    $continousPagination = ($page%10);
    for($i = 1 ; $i<10;$i++){
      if(($page-9+$i)>1){
        array_push ($previousPage,($page-9+$i));
      }
      if(($startVal+$continousPagination+$i)==1)continue;
      if(($startVal*10)+$continousPagination+$i>=$counter) continue;
        array_push ($paginationPage,(($startVal*10)+$continousPagination+$i));
      }
      if($page != $counter){
        array_push ($paginationPage, $counter);
      }
    $kumpulanPeminjaman = DB::select($sql2);
    return view('TampilanDataPeminjaman',compact('isAdmin','kumpulanPeminjaman','paginationPage','page','previousPage'));
  }
}
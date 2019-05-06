<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;
use Carbon\Carbon;
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
    
    $kumpulanPeminjaman = DB::select($sql); //cuman mau dapet totalbanyaknya buat dapet row
    $counter = ceil((count($kumpulanPeminjaman)*1.0)/10);
    $paginationPage = array(); //pagination tombol2 setelah page sekarang yang sedia
    $previousPage = array(); // pagination tombol2 page sebelum page yang sekarang
    $startVal = (int)($page/10); //mendapatkan nilai kelipatan sebagai pengali awal (page per 10 untuk sekarang)
    $continousPagination = ($page%10); //mendapatkan digit terakhirnya sebagai lanjutnya
    for($i = 1 ; $i<10;$i++){
      if(($page-9+$i)>1){
        array_push ($previousPage,($page-9+$i)); //masukan selama page tidak negatif
      }
      if(($startVal+$continousPagination+$i)==1)continue; // masukan selama page bukan 1 (1 ga masuk looping)
      if(($startVal*10)+$continousPagination+$i>=$counter) continue; // masukan selama masih tersedia didalam counter
        array_push ($paginationPage,(($startVal*10)+$continousPagination+$i));
      }
      if($page != $counter){ //jika page = counter tidak perlu dimasukan karena ujung page selalu di print
        array_push ($paginationPage, $counter);
      }
    $kumpulanPeminjaman = DB::select($sql2); //query sebenarnya yang mmenggunakan offset
    return view('TampilanDataPeminjaman',compact('isAdmin','kumpulanPeminjaman','paginationPage','page','previousPage'));
  }

  public function tambahPeminjaman(Request $request){
    $idUser = Auth::user()->id;
    $kodeEksemplar = $request->input('kodeEksemplar');
    $tglNow = Carbon::now()->format('Y-m-d');
    $tglJatuhTempo = Carbon::now()->addDays(7)->format('Y-m-d');
    $sql = "CALL tambahPeminjaman('$idUser','$tglJatuhTempo','$kodeEksemplar','$tglNow','0')";
    DB::select($sql);
    return redirect()->route('TampilanDetailBuku',['id' => $request->input('kodeBuku')]);
  }
}